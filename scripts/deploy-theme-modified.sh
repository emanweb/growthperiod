#!/usr/bin/env bash
set -euo pipefail

usage() {
  cat <<'EOF'
Usage:
  ./scripts/deploy-theme-modified.sh [--dry-run] [--commit=<sha>]

Configured defaults in script:
  STAGING_SSH_HOST     20.163.8.61
  STAGING_SSH_USER     azureuser
  STAGING_THEME_PATH   /var/www/stage.growthperiod.com/htdocs/wp-content/themes/growthperiod
  STAGING_SSH_KEY      /Users/emanuelcosta/Desktop/SSH/WebServer20251021_key.pem

Optional env vars (override defaults):
  STAGING_SSH_HOST     SSH host
  STAGING_SSH_USER     SSH user
  STAGING_THEME_PATH   Absolute path to theme on server

Optional env vars:
  STAGING_SSH_PORT     SSH port (default: 22)
  STAGING_SSH_KEY      Path to SSH private key (example: ~/.ssh/staging_key.pem)
  STAGING_USE_SUDO     Use sudo for final file placement on server (0 or 1, default: 0)
  STAGING_CHOWN_TARGET Owner/group for final chown (default: www-data:www-data)

Options:
  -n, --dry-run        Show what would be uploaded without copying files
  -c, --commit <sha>   Deploy files changed in a specific commit
  -h, --help           Show this help
EOF
}

DEFAULT_STAGING_SSH_HOST="20.163.8.61"
DEFAULT_STAGING_SSH_USER="azureuser"
DEFAULT_STAGING_THEME_PATH="/var/www/stage.growthperiod.com/htdocs/wp-content/themes/growthperiod"
DEFAULT_PRODUCTION_THEME_PATH="/var/www/growthperiod.com/htdocs/wp-content/themes/growthperiod"
if [[ "$(uname -s)" == MINGW* || "$(uname -s)" == CYGWIN* || "$(uname -s)" == MSYS* ]]; then
  DEFAULT_STAGING_SSH_KEY="$HOME/OneDrive/Desktop/WebServer20251021_key.pem"
else
  DEFAULT_STAGING_SSH_KEY="/Users/emanuelcosta/Desktop/SSH/WebServer20251021_key.pem"
fi

DRY_RUN=0
COMMIT_REF=""
while (($#)); do
  case "$1" in
    -n|--dry-run)
      DRY_RUN=1
      ;;
    -c|--commit)
      if (($# < 2)); then
        echo "Missing value for $1" >&2
        usage >&2
        exit 1
      fi
      COMMIT_REF="$2"
      shift
      ;;
    --commit=*)
      COMMIT_REF="${1#*=}"
      if [[ -z "$COMMIT_REF" ]]; then
        echo "Missing value for --commit" >&2
        usage >&2
        exit 1
      fi
      ;;
    -h|--help)
      usage
      exit 0
      ;;
    *)
      echo "Unknown argument: $1" >&2
      usage >&2
      exit 1
      ;;
  esac
  shift
done

STAGING="${STAGING:-Yes}"
STAGING_NORMALIZED="$(printf '%s' "$STAGING" | tr '[:upper:]' '[:lower:]')"

case "$STAGING_NORMALIZED" in
  yes)
    DEFAULT_THEME_PATH="$DEFAULT_STAGING_THEME_PATH"
    ;;
  no)
    DEFAULT_THEME_PATH="$DEFAULT_PRODUCTION_THEME_PATH"
    ;;
  *)
    echo "STAGING must be Yes or NO (got: $STAGING)" >&2
    exit 1
    ;;
esac

STAGING_SSH_HOST="${STAGING_SSH_HOST:-$DEFAULT_STAGING_SSH_HOST}"
STAGING_SSH_USER="${STAGING_SSH_USER:-$DEFAULT_STAGING_SSH_USER}"
#STAGING_THEME_PATH="${STAGING_THEME_PATH:-$DEFAULT_STAGING_THEME_PATH}"
STAGING_THEME_PATH="${STAGING_THEME_PATH:-$DEFAULT_THEME_PATH}"
STAGING_SSH_PORT="${STAGING_SSH_PORT:-22}"
STAGING_SSH_KEY="${STAGING_SSH_KEY:-$DEFAULT_STAGING_SSH_KEY}"
STAGING_USE_SUDO="${STAGING_USE_SUDO:-0}"
STAGING_CHOWN_TARGET="${STAGING_CHOWN_TARGET:-www-data:www-data}"

if [[ "$STAGING_USE_SUDO" != "0" && "$STAGING_USE_SUDO" != "1" ]]; then
  echo "STAGING_USE_SUDO must be 0 or 1 (got: $STAGING_USE_SUDO)" >&2
  exit 1
fi

if ! command -v git >/dev/null 2>&1; then
  echo "git is required but was not found in PATH." >&2
  exit 1
fi
if ! command -v ssh >/dev/null 2>&1; then
  echo "ssh is required but was not found in PATH." >&2
  exit 1
fi
if ! command -v scp >/dev/null 2>&1; then
  echo "scp is required but was not found in PATH." >&2
  exit 1
fi

REPO_ROOT="$(git rev-parse --show-toplevel)"
cd "$REPO_ROOT"

TARGET="${STAGING_SSH_USER}@${STAGING_SSH_HOST}"

SSH_ARGS=(-p "$STAGING_SSH_PORT")
SCP_ARGS=(-P "$STAGING_SSH_PORT")
if [[ -n "$STAGING_SSH_KEY" ]]; then
  SSH_ARGS+=(-i "$STAGING_SSH_KEY")
  SCP_ARGS+=(-i "$STAGING_SSH_KEY")
fi

# Build the file list either from a specific commit or from local changes.
CHANGED_FILES=()
while IFS= read -r changed_file; do
  [[ -n "$changed_file" ]] || continue
  CHANGED_FILES+=("$changed_file")
done < <(
  if [[ -n "$COMMIT_REF" ]]; then
    if ! git rev-parse --verify "${COMMIT_REF}^{commit}" >/dev/null 2>&1; then
      echo "Commit not found: $COMMIT_REF" >&2
      exit 1
    fi

    git diff-tree --root --no-commit-id --name-only -r --diff-filter=ACMRTUXB "$COMMIT_REF"
  else
    {
      git diff --name-only --diff-filter=ACMRTUXB
      git diff --name-only --cached --diff-filter=ACMRTUXB
      git ls-files --others --exclude-standard
    }
  fi | awk 'NF' | sort -u
)

if ((${#CHANGED_FILES[@]} == 0)); then
  if [[ -n "$COMMIT_REF" ]]; then
    echo "No deployable files found for commit: $COMMIT_REF"
  else
    echo "No modified files to deploy."
  fi
  exit 0
fi

if [[ -n "$COMMIT_REF" ]]; then
  echo "Found ${#CHANGED_FILES[@]} file(s) changed in commit ${COMMIT_REF}."
else
  echo "Found ${#CHANGED_FILES[@]} modified file(s) to deploy."
fi

for file in "${CHANGED_FILES[@]}"; do
  if [[ ! -f "$file" ]]; then
    echo "Skipping non-file path: $file"
    continue
  fi

  remote_dir="${STAGING_THEME_PATH}/$(dirname "$file")"
  remote_file="${STAGING_THEME_PATH}/${file}"
  temp_remote_file="/tmp/growthperiod-deploy/${file}"
  temp_remote_dir="$(dirname "$temp_remote_file")"

  if ((DRY_RUN)); then
    if [[ "$STAGING_USE_SUDO" == "1" ]]; then
      if [[ -n "$STAGING_SSH_KEY" ]]; then
        echo "[dry-run] ssh -p ${STAGING_SSH_PORT} -i '${STAGING_SSH_KEY}' ${TARGET} mkdir -p '${temp_remote_dir}'"
        echo "[dry-run] scp -P ${STAGING_SSH_PORT} -i '${STAGING_SSH_KEY}' '${file}' '${TARGET}:${temp_remote_file}'"
        echo "[dry-run] ssh -p ${STAGING_SSH_PORT} -i '${STAGING_SSH_KEY}' ${TARGET} sudo -n mkdir -p '${remote_dir}' && sudo -n mv '${temp_remote_file}' '${remote_file}'"
      else
        echo "[dry-run] ssh -p ${STAGING_SSH_PORT} ${TARGET} mkdir -p '${temp_remote_dir}'"
        echo "[dry-run] scp -P ${STAGING_SSH_PORT} '${file}' '${TARGET}:${temp_remote_file}'"
        echo "[dry-run] ssh -p ${STAGING_SSH_PORT} ${TARGET} sudo -n mkdir -p '${remote_dir}' && sudo -n mv '${temp_remote_file}' '${remote_file}'"
      fi
    elif [[ -n "$STAGING_SSH_KEY" ]]; then
      echo "[dry-run] ssh -p ${STAGING_SSH_PORT} -i '${STAGING_SSH_KEY}' ${TARGET} mkdir -p '${remote_dir}'"
      echo "[dry-run] scp -P ${STAGING_SSH_PORT} -i '${STAGING_SSH_KEY}' '${file}' '${TARGET}:${remote_file}'"
    else
      echo "[dry-run] ssh -p ${STAGING_SSH_PORT} ${TARGET} mkdir -p '${remote_dir}'"
      echo "[dry-run] scp -P ${STAGING_SSH_PORT} '${file}' '${TARGET}:${remote_file}'"
    fi
    continue
  fi

  if [[ "$STAGING_USE_SUDO" == "1" ]]; then
    ssh "${SSH_ARGS[@]}" "$TARGET" "mkdir -p '$temp_remote_dir'"
    scp "${SCP_ARGS[@]}" "$file" "$TARGET:$temp_remote_file"
    ssh "${SSH_ARGS[@]}" "$TARGET" "sudo -n mkdir -p '$remote_dir' && sudo -n mv '$temp_remote_file' '$remote_file'"
  else
    ssh "${SSH_ARGS[@]}" "$TARGET" "mkdir -p '$remote_dir'"
    scp "${SCP_ARGS[@]}" "$file" "$TARGET:$remote_file"
  fi
  echo "Uploaded: $file"
done

if ((DRY_RUN)); then
  if [[ -n "$STAGING_SSH_KEY" ]]; then
    echo "[dry-run] ssh -p ${STAGING_SSH_PORT} -i '${STAGING_SSH_KEY}' ${TARGET} sudo -n chown -R '${STAGING_CHOWN_TARGET}' '${STAGING_THEME_PATH}'"
    echo "[dry-run] ssh -p ${STAGING_SSH_PORT} -i '${STAGING_SSH_KEY}' ${TARGET} sudo -n wo clean --all"
  else
    echo "[dry-run] ssh -p ${STAGING_SSH_PORT} ${TARGET} sudo -n chown -R '${STAGING_CHOWN_TARGET}' '${STAGING_THEME_PATH}'"
    echo "[dry-run] ssh -p ${STAGING_SSH_PORT} ${TARGET} sudo -n wo clean --all"
  fi
else
  ssh "${SSH_ARGS[@]}" "$TARGET" "sudo -n chown -R '$STAGING_CHOWN_TARGET' '$STAGING_THEME_PATH'"
  echo "Ownership updated: ${STAGING_CHOWN_TARGET} ${STAGING_THEME_PATH}"
  ssh "${SSH_ARGS[@]}" "$TARGET" "sudo -n wo clean --all"
  echo "Cache cleaned: wo clean --all"
fi

echo "Deploy complete."
