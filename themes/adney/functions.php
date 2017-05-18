<?php
/**
 * adney functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package adney
 */

if ( ! function_exists( 'adney_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function adney_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on adney, use a find and replace
	 * to change 'adney' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'adney', get_template_directory() . '/languages' );

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
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'adney' ),
		'footer'  => esc_html__( 'Footer', 'adney' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'gallery',
		'caption',
	) );


	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'adney_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

    /*
	 * Set up the custom logo upload feature
	 */
    add_theme_support( 'custom-logo' );

	/*
	 * Add Portfolio Support
	 */
	add_theme_support('xylus_themes_portfolio_support');

	/*
	 * Add Testimonial Support
	 */
	add_theme_support('xylus_themes_testimonial_support');

	/*
	 * Add Client Support
	 */
	add_theme_support('xylus_themes_client_support');

	/*
	 * Add Team Support
	 */
	add_theme_support('xylus_themes_team_support');

	/*
	 * Add Service Support
	 */
	add_theme_support('xylus_themes_service_support');

	/*
	 * Add Slider Support
	 */
	add_theme_support('xylus_themes_slider_support');

}
endif;
add_action( 'after_setup_theme', 'adney_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function adney_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'adney_content_width', 640 );
}
add_action( 'after_setup_theme', 'adney_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function adney_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'adney' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget_title">',
		'after_title'   => '</div>',
	) );

	register_sidebar( array(
			'name'          => esc_html__( 'CTA Section Sidebar', 'adney' ),
			'id'            => 'cta-sidebar',
			'description'   => '',
			'before_widget' => '<div class="white-section" style="padding:20px">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widget_title">',
			'after_title'   => '</div>',
	) );
}
add_action( 'widgets_init', 'adney_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function adney_scripts() {

	wp_enqueue_style( 'adney-google-fonts-montserrat', '//fonts.googleapis.com/css?family=Montserrat:400,700', false );

	wp_enqueue_style( 'adney-google-fonts-ubuntu', '//fonts.googleapis.com/css?family=Ubuntu:400,300,500,700', false );

	wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.css', array(),'','all');

	wp_enqueue_style( 'animsition', get_template_directory_uri() . '/assets/css/animsition.min.css', array(),'','all');

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(),'','all');

	wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/assets/css/flexslider.css', array(),'','all');

	wp_enqueue_style( 'ionicons', get_template_directory_uri() . '/assets/css/ionicons.min.css', array(),'','all');

	wp_enqueue_style( 'adney-style', get_stylesheet_uri() );

	wp_enqueue_style( 'adney-red', get_template_directory_uri() . '/assets/css/red.css', array(),'','all');

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '', true );

	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', array('jquery'), '', true );

	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/assets/js/jquery.flexslider.js', array('jquery'), '', true );

	wp_enqueue_script( 'animsition', get_template_directory_uri() . '/assets/js/jquery.animsition.min.js', array('jquery'), '', true );

	wp_enqueue_script( 'wow', get_template_directory_uri() . '/assets/js/wow.min.js', array('jquery'), '', true );

	wp_enqueue_script( 'adney-main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '', true );

	wp_enqueue_script( 'adney-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'adney_scripts' );
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Script for Plugin Recommend
 */
require get_template_directory() . '/inc/plugin-suggest.php';
