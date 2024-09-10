<?php
/**
 * portfolioMax functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package portfolioMax
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
function portfoliomax_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on portfolioMax, use a find and replace
		* to change 'portfoliomax' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'portfoliomax', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'portfoliomax' ),
			'mobile-menu' => esc_html('Mobile', 'nathaliemota'),
			'footer-menu' => esc_html__('Footer', 'nathaliemota'),
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
			'portfoliomax_custom_background_args',
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
add_action( 'after_setup_theme', 'portfoliomax_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function portfoliomax_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'portfoliomax_content_width', 640 );
}
add_action( 'after_setup_theme', 'portfoliomax_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function portfoliomax_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'portfoliomax' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'portfoliomax' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'portfoliomax_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function portfoliomax_scripts() {
	wp_enqueue_style( 'portfoliomax-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'portfoliomax-style', 'rtl', 'replace' );
	wp_enqueue_style( 'portfoliomax-styleScss', get_template_directory_uri() . '/CSS/style.css', array(), _S_VERSION );

	wp_enqueue_script( 'portfoliomax-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'portfoliomax-animations', get_template_directory_uri() . '/js/animations.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'portfoliomax-burgermenu', get_template_directory_uri() . '/js/burgermenu.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'portfoliomax-globe', get_template_directory_uri() . '/js/globe.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'portfoliomax-slider', get_template_directory_uri() . '/js/slider.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'portfoliomax-ajax', get_template_directory_uri() . '/js/ajax.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'portfoliomax-particlesBg', get_template_directory_uri() . '/js/particles.js', array('jquery'), _S_VERSION, true );
	// Slider
	wp_enqueue_script( 'swiper-import', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');
	// Space bg
	wp_enqueue_script( 'particules-import', 'https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js');
	// Three.js for both space bg + github animation like. But here three.js is already imported in globe.js
	// wp_enqueue_script( 'threejs-import', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/0.168.0/three.module.min.js', array(), '0.168.0', true);
	wp_enqueue_script( 'globe', '//unpkg.com/globe.gl', [], null, true );

	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'portfoliomax_scripts' );

// Important function, that will precise it is a module that's imported for the three.js, which will avoid a syntax library error
// function add_type_attribute( $tag, $handle ) {
//     if ( 'threejs-import' !== $handle ) {
//         return $tag;
//     }
//     return str_replace( '<script ', '<script type="module" ', $tag );
// }
// add_filter( 'script_loader_tag', 'add_type_attribute', 10, 2 );

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

// Custom functions

function fetch_scallop_content() {
    if (isset($_POST['skilln'])) {
        $skill_name = sanitize_text_field($_POST['skilln']); // sanitize input

        // error_log('Received skilln: ' . $skill_name);

        $args = [
            'post_type' => 'scallop',
            'posts_per_page' => 1,
            'meta_key' => 'skillname',
            'meta_value' => $skill_name,
            'compare' => '='
        ];

        // error_log('Running query with skilln: ' . $skill_name);
        $scallop_query = new WP_Query($args);

        if ($scallop_query->have_posts()) {
            // Start output buffering to capture the content
            ob_start();
            while ($scallop_query->have_posts()) {
                $scallop_query->the_post();
                get_template_part('template-parts/styledScallop', null, array('skill' => $skill_name));
            }
            $content = ob_get_clean();
            // error_log('Generated content: ' . $content);
            echo $content;
        } else {
            // error_log('No posts found for skillname: ' . $skill_name);
            echo '<p>Pas de contenu trouvé pour la compétence suivante</p>';
        }

        wp_reset_postdata(); // Reset after query
    }
    wp_die(); // Stop further execution
}

add_action('wp_ajax_fetch_scallop_content', 'fetch_scallop_content');
add_action('wp_ajax_nopriv_fetch_scallop_content', 'fetch_scallop_content');