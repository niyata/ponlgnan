<?php

/**
 * Override seed_setup()
 */
function berry_setup() {
	add_theme_support( 'custom-logo', array(
		'width'       => 120,
		'height'      => 120,
		'flex-width' => true,
		) );
	set_post_thumbnail_size( 370, 237, TRUE );
}
add_action( 'after_setup_theme', 'berry_setup', 11);

/**
 * Remove / Unregister some sidebars
 */
function berry_remove_sidebar(){
	unregister_sidebar( 'rightbar' );
	unregister_sidebar( 'leftbar' );
	unregister_sidebar( 'shopbar' );
	unregister_sidebar( 'top-right' );
}
add_action( 'widgets_init', 'berry_remove_sidebar', 11 );

/**
 * Enqueue scripts and styles.
 */
function berry_scripts() {

	wp_dequeue_style( 'seed-style');

	wp_enqueue_style( 'berry-style', get_stylesheet_uri() );
	wp_enqueue_script( 'berry-main', get_stylesheet_directory_uri() . '/js/main.js', array(), '2016-1', true );

}
add_action( 'wp_enqueue_scripts', 'berry_scripts' , 20 );
/* iworn require ACF 5 */
define('ACF_EARLY_ACCESS','5');