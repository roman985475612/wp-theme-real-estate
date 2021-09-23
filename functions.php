<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

require __DIR__ . '/tools.php';
require __DIR__ . '/inc/posttypes.php';
require __DIR__ . '/inc/taxonomy.php';
require __DIR__ . '/inc/form_handler.php';
require __DIR__ . '/inc/custom_columns/city-edit-form.php';
require __DIR__ . '/inc/custom_columns/real_estate-edit-form.php';
require __DIR__ . '/inc/widgets/class-rmn-widget-cities.php';
require __DIR__ . '/inc/widgets/class-rmn-widget-new-real_estate.php';

add_action( 'init', 'rmn_create_post_types' );
add_action( 'init', 'rmn_create_taxonomy' );
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );
add_action( 'widgets_init', 'rmn_widgets_init' );

add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
add_filter( 'use_widgets_block_editor', '__return_false' );

function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}

function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    wp_localize_script( 
		'child-understrap-scripts', 
		'rmnVars', 
		[ 
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'rmn_nonce' ), 
		] 
	);
}

function add_child_theme_textdomain() {
    load_child_theme_textdomain( 'rmn', get_stylesheet_directory() . '/languages' );
}

function rmn_widgets_init() {
    register_widget( 'RMN_Cities_Widget' );
    register_widget( 'RMN_New_Real_Estate_Widget' );
}
