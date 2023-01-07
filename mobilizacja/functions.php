<?php
/**
 * mobilizacja functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mobilizacja
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mobilizacja_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on mobilizacja, use a find and replace
		* to change 'mobilizacja' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'mobilizacja', get_template_directory() . '/languages' );

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
	add_theme_support( 'menus' );
	//function sellace_register_menus(){}
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'sellace' ),
			'menu-2' => esc_html__( 'Footer Menu', 'sellace' )
		)
	);

	add_filter( 'nav_menu_link_attributes', 'filter_nav_menu_link_attributes', 10, 3 );
	function filter_nav_menu_link_attributes( $atts, $item, $args ) {
		if ( $args->menu === 'Main' ) {
			$atts['class'] = 'menu__item';

			if ( $item->current ) {
				$atts['class'] .= ' menu__item-active';
			}
		};
		return $atts;
	}

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
			'mobilizacja_custom_background_args',
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
add_action( 'after_setup_theme', 'mobilizacja_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mobilizacja_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mobilizacja_content_width', 640 );
}
add_action( 'after_setup_theme', 'mobilizacja_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mobilizacja_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'mobilizacja' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'mobilizacja' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'mobilizacja_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mobilizacja_scripts() {
	wp_enqueue_style( 'mobilizacja-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'mobilizacja-style', 'rtl', 'replace' );

	wp_enqueue_script( 'mobilizacja-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'fontawesome-script', 'https://kit.fontawesome.com/09fafa4f89.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mobilizacja_scripts' );

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

add_action( 'init', 'create_post_type' );

function create_post_type() {

	register_post_type( 'services', [
		'label'       => null,
		'labels'      => [
			'name'          => 'Services',
			'singular_name' => 'Service',
			'add_new'       => 'Add Service',
		],
		'description' => '',
		'public'      => true,
		'menu_icon'   => 'dashicons-book',
		'supports'    => [
			'title',
			'editor',
			'thumbnail',
			'custom-fields',
		],
		'taxonomies'  => [],
		'has_archive' => false,
		'rewrite'     => true,
		'query_var'   => true,
	] );


}

if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page(
		array(
			'page_title'  => 'General',
			'menu_title'  => 'Theme Options',
			'menu_slug'   => 'theme-options',
			'capability'  => 'edit_posts',
			'parent_slug' => '',
			'icon_url'    => 'dashicons-admin-generic',
			'position'    => false,
			'redirect'    => false,
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => 'Header',
			'menu_title'  => 'Header',
			'menu_slug'   => 'theme-options-header',
			'capability'  => 'edit_posts',
			'parent_slug' => 'theme-options',
			'position'    => false,
			'icon_url'    => false,
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => 'Footer',
			'menu_title'  => 'Footer',
			'menu_slug'   => 'theme-options-footer',
			'capability'  => 'edit_posts',
			'parent_slug' => 'theme-options',
			'position'    => false,
			'icon_url'    => false,
		)
	);
}

