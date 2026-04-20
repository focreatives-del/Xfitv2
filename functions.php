<?php
/**
 * Trainopro Neon functions and definitions
 */

if ( ! function_exists( 'trainopro_neon_setup' ) ) {
    function trainopro_neon_setup() {
        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        // Let WordPress manage the document title.
        add_theme_support( 'title-tag' );

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support( 'post-thumbnails' );

        // Register navigation menus
        register_nav_menus(
            array(
                'menu-1' => esc_html__( 'Primary Menu', 'trainopro-neon' ),
                'footer' => esc_html__( 'Footer Menu', 'trainopro-neon' ),
            )
        );

        // Switch default core markup to output valid HTML5.
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

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );
    }
}
add_action( 'after_setup_theme', 'trainopro_neon_setup' );

/**
 * Enqueue scripts and styles.
 */
function trainopro_neon_scripts() {
    // Google Fonts
    wp_enqueue_style( 'trainopro-neon-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Sora:wght@400;600;700;800&display=swap', array(), null );

    // Main Stylesheet
    wp_enqueue_style( 'trainopro-neon-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

    // Main custom CSS
    wp_enqueue_style( 'trainopro-neon-main-css', get_template_directory_uri() . '/assets/css/main.css', array('trainopro-neon-style'), wp_get_theme()->get( 'Version' ) );

    // Main JS
    wp_enqueue_script( 'trainopro-neon-main-js', get_template_directory_uri() . '/assets/js/main.js', array(), wp_get_theme()->get( 'Version' ), true );
}
add_action( 'wp_enqueue_scripts', 'trainopro_neon_scripts' );
