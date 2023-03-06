<?php
/**
 * pricer functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package pricer
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'pricer_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function pricer_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on pricer, use a find and replace
		 * to change 'pricer' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'pricer', get_template_directory() . '/languages' );

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

    // Theme options page ACF
    if( function_exists('acf_add_options_page') ) {
      acf_add_options_page(array(
        'page_title' 	=> 'Theme General Settings',
        'menu_title'	=> 'Theme Settings',
        'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
      ));
    }





		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'pricer_custom_background_args',
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

  register_nav_menus([
    'header_menu' => 'Header menu',
    'footer_menu_column1' => 'Footer column 1',
    'footer_menu_column2' => 'Footer column 2',
    'footer_menu_column3' => 'Footer column 3'
  ]);


endif;
add_action( 'after_setup_theme', 'pricer_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pricer_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pricer_content_width', 640 );
}
add_action( 'after_setup_theme', 'pricer_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pricer_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'pricer' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'pricer' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'pricer_widgets_init' );

/**
 * Enqueue scripts.
 */
function pricer_scripts() {
  wp_enqueue_script( 'pricer-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

  wp_enqueue_script('pricer-js-libs', get_template_directory_uri() . '/assets/js/libs.min.js', array('jquery'), null, true);
  wp_enqueue_script('pricer-main-scripts', get_template_directory_uri() . '/assets/js/index.js', array('jquery'), null, true);
	if(is_page(975)) {
		wp_enqueue_script('pricer-script-remodal', get_template_directory_uri() . '/assets-vendors/js/remodal.js', array('jquery'), null, true);
		wp_enqueue_script('pricer-script-vendor', get_template_directory_uri() . '/assets-vendors/js/scripts.js', array('jquery'), null, true);
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/**
 * Enqueue styles.
 */

function pricer_styles(){
//  wp_enqueue_style( 'pricer-style', get_stylesheet_uri(), array(), _S_VERSION );
  wp_enqueue_style('pricer-main-styles', get_template_directory_uri() . '/assets/css/main.css', array(), null);
	if(is_page(array('for-vendors'))) {
		wp_enqueue_style('pricer-vendors-slick', get_template_directory_uri() . '/assets-vendors/css/slick.css', array(), null);
		wp_enqueue_style('pricer-vendors-remodal-theme', get_template_directory_uri() . '/assets-vendors/css/remodal-default-theme.css', array(), null);
		wp_enqueue_style('pricer-vendors-remodal', get_template_directory_uri() . '/assets-vendors/css/remodal.css', array(), null);
		wp_enqueue_style('pricer-vendors-styles', get_template_directory_uri() . '/assets-vendors/css/style.css', array(), null);
	}
}

add_action( 'wp_enqueue_scripts', 'pricer_scripts' );
add_action( 'wp_enqueue_scripts', 'pricer_styles' );

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

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * disable admin bar on frontend.
 */
//show_admin_bar(false);




