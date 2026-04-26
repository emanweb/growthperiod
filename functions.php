<?php
/**
 * growthperiod functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package growthperiod
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.14' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function growthperiod_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on growthperiod, use a find and replace
		* to change 'growthperiod' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'growthperiod', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'growthperiod' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'growthperiod_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'growthperiod_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function growthperiod_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'growthperiod_content_width', 640 );
}
add_action( 'after_setup_theme', 'growthperiod_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function growthperiod_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'growthperiod' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'growthperiod' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'growthperiod_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function growthperiod_scripts() {
	wp_enqueue_style( 'growthperiod-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'growthperiod-main-style', get_template_directory_uri() . '/css/main.min.css', array(), _S_VERSION);
	//wp_enqueue_style( 'growthperiod-custom_main-style', get_template_directory_uri() . '/css/custom_main.css', array(), '');
	//wp_enqueue_script('jquery');
	//https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js
	wp_enqueue_script( 'growthperiod-jquery-js', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'growthperiod-appear-js', get_template_directory_uri() . '/js/appear.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'growthperiod-aos-js', get_template_directory_uri() . '/js/aos.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'growthperiod-swiper-js', get_template_directory_uri() . '/js/swiper-bundle.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'growthperiod-splide-js', get_template_directory_uri() . '/js/splide.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'growthperiod-splide-auto-scroll-js', get_template_directory_uri() . '/js/splide-extension-auto-scroll.min.js', array('growthperiod-splide-js'), _S_VERSION, true );
	wp_enqueue_script( 'growthperiod-imagesloaded-js', get_template_directory_uri() . '/js/imagesloaded.pkgd.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'growthperiod-vimeo-player-js', get_template_directory_uri() . '/js/player.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'growthperiod-readmore-js', get_template_directory_uri() . '/js/readmore.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'growthperiod-simplebar-js', get_template_directory_uri() . '/js/simplebar.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'growthperiod-main-js', get_template_directory_uri() . '/js/main.min.js', array(
		'growthperiod-appear-js',
		'growthperiod-aos-js',
		'growthperiod-swiper-js',
		'growthperiod-splide-auto-scroll-js',
		'growthperiod-imagesloaded-js',
		'growthperiod-vimeo-player-js',
		'growthperiod-readmore-js',
		'growthperiod-simplebar-js'
	), _S_VERSION, true );
	/* if(is_page(10) || is_page(12) || is_category()){
	    wp_enqueue_script( 'growthperiod-custom_main-js', get_template_directory_uri() . '/js/custom_main.js', array(), _S_VERSION, true );
	} */
	?>
	<script type="text/javascript">
		var ca_ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
	</script>
	<?php
}
add_action( 'wp_enqueue_scripts', 'growthperiod_scripts' );

//SVG 
function growthperiod_myme_types($mime_types){
    $mime_types['svg'] = 'image/svg+xml'; //Adding svg extension
    return $mime_types;
}
add_filter('upload_mimes', 'growthperiod_myme_types', 1, 1);
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/customizer-acf.php';
require get_template_directory() . '/inc/customizer-filter.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function remove_width_and_height_attribute( $html ) {
   return preg_replace( '/(height|width)="\d*"\s/', "", $html );
}
/**
 * @param array $attachment
 * @param string $size
 * @param array $attrs
 *
 * @return string
 */
function getImageHTMLCodeWebp(array $attachment, string $size = 'large', array $attrs = []): string {
	$attachmentId = $attachment['id'];
	// SEO support
	$attrs = array_merge($attrs, ['alt' => $attachment['title']]);
	return remove_width_and_height_attribute(wp_get_attachment_image($attachmentId, $size, null, $attrs));
}

add_filter('wpcf7_autop_or_not', '__return_false');

add_filter( 'post_thumbnail_html', 'growth_remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'growth_remove_width_attribute', 10 );
function growth_remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}

//  Limit Excerpt Length by number of Words
function excerpt_limit_growth( $limit ) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
	array_pop($excerpt);
	$excerpt = implode(" ",$excerpt).'...';
	} else {
	$excerpt = implode(" ",$excerpt);
	}
	$excerpt = preg_replace('`[[^]]*]`','',$excerpt);
	return $excerpt;
}

if ( function_exists( 'add_theme_support' ) ) {
    // additional image sizes
    // delete the next line if you do not need additional image sizes
    add_image_size( 'casestudy-thumb', 264, 322, true );
    add_image_size( 'giving-thumb', 264, 322, true );
 }
 
function get_client_ip() {
     $ipaddress = '';
     if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
     else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
     else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
     else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
     else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
     else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
     else
        $ipaddress = 'UNKNOWN';

     return $ipaddress;
}

function check_using_ip_address(){
	static $mode = null;
	if ( null !== $mode ) {
		return $mode;
	}

    global $wpdb;
	$ip_address = trim((string) get_client_ip());
	if ( strpos($ip_address, ',') !== false ) {
		$ip_parts = explode(',', $ip_address);
		$ip_address = trim($ip_parts[0]);
	}

	if ( empty($ip_address) || ! filter_var($ip_address, FILTER_VALIDATE_IP) ) {
		$mode = 'popup';
		return $mode;
	}

    $table = $wpdb->prefix . 'db7_forms';
	$like_ip = '%' . $wpdb->esc_like($ip_address) . '%';
	$query = $wpdb->prepare(
		"SELECT 1 FROM {$table} WHERE `form_value` LIKE %s LIMIT 1",
		$like_ip
	);
	$result = $wpdb->get_var($query);

	$mode = !empty($result) ? 'link' : 'popup';
	return $mode;
}
/* ERC: Removed so we could display posts in their own URL/webpage 
add_action( 'template_redirect', 'redirect_cpt_singular_posts_growtg' );
function redirect_cpt_singular_posts_growtg() {
  if ( is_singular('post') ) {
    wp_redirect( home_url(), 302 );
    exit;
  }
} */

add_action( 'template_redirect', 'growthperiod_weekly_updates_listing_route', 0 );
function growthperiod_weekly_updates_listing_route() {
	if ( is_admin() ) {
		return;
	}

	$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? (string) $_SERVER['REQUEST_URI'] : '';
	$request_path = trim( (string) parse_url( $request_uri, PHP_URL_PATH ), '/' );
	$home_path = trim( (string) parse_url( home_url( '/' ), PHP_URL_PATH ), '/' );

	if ( '' !== $home_path && 0 === strpos( $request_path, $home_path . '/' ) ) {
		$request_path = substr( $request_path, strlen( $home_path ) + 1 );
	}

	if ( 'weekly-updates' !== $request_path ) {
		return;
	}

	status_header( 200 );
	nocache_headers();
	include get_template_directory() . '/archive-weekly_updates.php';
	exit;
}