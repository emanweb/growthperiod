#!/usr/bin/env bash
set -euo pipefail

usage() {
  cat <<'EOF'
Usage:
  ./scripts/deploy-theme-modified.sh [--dry-run]

Configured defaults in script:
  STAGING_SSH_HOST     20.163.8.61
  STAGING_SSH_USER     azureuser
  STAGING_THEME_PATH   /var/www/stage.growthperiod.com/htdocs/wp-content/themes/growthperiod

Optional env vars (override defaults):
  STAGING_SSH_HOST     SSH host
  STAGING_SSH_USER     SSH user
  STAGING_THEME_PATH   Absolute path to theme on server

Optional env vars:
  STAGING_SSH_PORT     SSH port (default: 22)

Options:
  -n, --dry-run        Show what would be uploaded without copying files
  -h, --help           Show this help
EOF
}

DEFAULT_STAGING_SSH_HOST="20.163.8.61"
DEFAULT_STAGING_SSH_USER="azureuser"
DEFAULT_STAGING_THEME_PATH="/var/www/stage.growthperiod.com/htdocs/wp-content/themes/growthperiod"

DRY_RUN=0
while (($#)); do
  case "$1" in
    -n|--dry-run)
      DRY_RUN=1
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

STAGING_SSH_HOST="${STAGING_SSH_HOST:-$DEFAULT_STAGING_SSH_HOST}"
STAGING_SSH_USER="${STAGING_SSH_USER:-$DEFAULT_STAGING_SSH_USER}"
STAGING_THEME_PATH="${STAGING_THEME_PATH:-$DEFAULT_STAGING_THEME_PATH}"
STAGING_SSH_PORT="${STAGING_SSH_PORT:-22}"

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

# Build a unique list of modified files from unstaged, staged, and untracked changes.
CHANGED_FILES=()
while IFS= read -r changed_file; do
  [[ -n "$changed_file" ]] || continue
  CHANGED_FILES+=("$changed_file")
done < <(
  {
    git diff --name-only --diff-filter=ACMRTUXB
    git diff --name-only --cached --diff-filter=ACMRTUXB
    git ls-files --others --exclude-standard
  } | awk 'NF' | sort -u
)

if ((${#CHANGED_FILES[@]} == 0)); then
  echo "No modified files to deploy."
  exit 0
fi

echo "Found ${#CHANGED_FILES[@]} file(s) to deploy."

for file in "${CHANGED_FILES[@]}"; do
  if [[ ! -f "$file" ]]; then
    echo "Skipping non-file path: $file"
    continue
  fi

  remote_dir="${STAGING_THEME_PATH}/$(dirname "$file")"
  remote_file="${STAGING_THEME_PATH}/${file}"

  if ((DRY_RUN)); then
    echo "[dry-run] ssh -p ${STAGING_SSH_PORT} ${TARGET} mkdir -p '${remote_dir}'"
    echo "[dry-run] scp -P ${STAGING_SSH_PORT} '${file}' '${TARGET}:${remote_file}'"
    continue
  fi

  ssh -p "$STAGING_SSH_PORT" "$TARGET" "mkdir -p '$remote_dir'"
  scp -P "$STAGING_SSH_PORT" "$file" "$TARGET:$remote_file"
  echo "Uploaded: $file"
done

echo "Deploy complete."
