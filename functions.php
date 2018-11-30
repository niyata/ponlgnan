<?php

/**
 * Override seed_setup()
 */
function berry_setup() {
	add_theme_support( 'custom-logo', array(
		'width'       => 80, 
		'height'      => 80, 
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
 * Anim Enqueue scripts and styles.
 */
function berry_scripts() {

	wp_dequeue_style( 'seed-style');
	wp_enqueue_style( 'berry-style', get_stylesheet_uri() );
	wp_enqueue_script( 'berry-main', get_stylesheet_directory_uri() . '/js/main.js', array(), '2016-1', true );
	wp_enqueue_script( 'berry-main', get_stylesheet_directory_uri() . '/js/sketchfab-viewer-1.3.1.js', array(), '2016-1', true );

}
add_action( 'wp_enqueue_scripts', 'berry_scripts' , 20 );
/* iworn require ACF 5 */
define('ACF_EARLY_ACCESS','5');

/**
 * Put icon before the post title by iWorn
 * you can create custom field for icon field by category taxonomy
 * @see https://www.engagewp.com/how-to-add-icon-before-post-title-wordpress/ and @see https://www.wp-tweaks.com/put-image-before-the-post-title-wordpress/
 */
function anim_icon_before_title( $title, $id = null ) {

    if(get_post_meta($id, 'icon_before_title_url', true)) {
        $img_source = get_post_meta(get_the_ID(), 'icon_before_title_url', true);
        $title = '<img class="icon_title" src="'. $img_source .'" />' . $title;
   }

    return $title;
}
add_filter( 'the_title', 'anim_icon_before_title', 10, 2 ); /* end put icon */

/**
 * Anim function Allow SVG through WordPress Media Uploader
 */
function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
  }
  add_filter('upload_mimes', 'cc_mime_types');

  /**
   * ACF Anim Project Name - Add to Admin Column
   */
add_filter('manage_anim_posts_columns', 'anim_posts_columns', 4);
add_action('manage_anim_custom_column', 'anim_custom_columns', 4,2);

function anim_posts_columns($col_defaults){
	$col_defaults['anim_proj_name_col'] = __('ชื่อโปรเจ็ค');
	return $col_defaults;
}

function anim_posts_custom_columns($col_porj_name, $id){
	if($col_porj_name === 'anim_proj_name_col'){
		echo get_the_terms( 'anim_project_name' );
	}
}


   /**
	* iWorn Add Function Admin Column Thumbnail 
	*/
add_filter('manage_posts_columns', 'posts_columns', 5);
add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);

function posts_columns($defaults){
	$defaults['anim_post_thumbs'] = __('รูปปก');
	return $defaults;
}

function posts_custom_columns($column_name, $id){
	if($column_name === 'anim_post_thumbs'){
		echo the_post_thumbnail( 'featured-thumbnail' );
	}
}