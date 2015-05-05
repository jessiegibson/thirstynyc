<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'thirsty' );
define( 'CHILD_THEME_URL', 'http://www.thirstynyc.com/' );
define( 'CHILD_THEME_VERSION', '2.1.2' );

//* Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );
function genesis_sample_google_fonts() {

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700', array(), CHILD_THEME_VERSION );

}
/* ********************************************************************************
Adding all of the Theme Support
*/
//* Add HTML5 markup structure
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
//* Add viewport meta tag for mobile browsers
    add_theme_support( 'genesis-responsive-viewport' );
//* Add support for custom background
    add_theme_support( 'custom-background' );
//* Add support for the After Entry Widget Area
		add_theme_support( 'genesis-after-entry-widget-area' );
//* Add support for 3-column footer widgets
    add_theme_support( 'genesis-footer-widgets', 4 );
//* Add support for custom header
    add_theme_support( 'genesis-custom-header', array(
	'width' => 400,
	'height' => 140
) );
//* Removes the things that we don't want.
    unregister_sidebar( 'header-right' );//* Unregistering/Removes the Header Widget
    remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
function custom_excerpt_length( $length ) {// Changing the length of the Excerpt
	return 75;

}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


// ARRANGING THE IMAGES  //
add_image_size('feature', 1024, 576, TRUE);
add_image_size('inside-blog', 640, 640, TRUE);

// Add Read More Link to Excerpts
    add_filter('excerpt_more', 'get_read_more_link');
    add_filter( 'the_content_more_link', 'get_read_more_link' );

function get_read_more_link() {
   return '<br /><a class="readMoreLink" href="' . get_permalink() . '">Read&nbsp;More</a>';
}

add_filter( 'wp_nav_menu_items', 'theme_menu_extras', 10, 2 );


/**
 * Filter menu items, appending either a search form or today's date.

 */
function theme_menu_extras( $menu, $args ) {

//* Change 'primary' to 'secondary' to add extras to the secondary navigation menu
	if ( 'primary' !== $args->theme_location )
		return $menu;

			ob_start();
			get_search_form();
			$search = ob_get_clean();
			$menu  .= '<li class="right search">' . $search . '</li>';

	return $menu;
}

add_action( 'genesis_entry_header', 'single_post_featured_image', 5 );

function single_post_featured_image() {

	if ( ! is_singular() )
		return;

	$img = genesis_get_image( array( 'format' => 'html', 'size' => genesis_get_option( 'image_size' ), 'attr' => array( 'class' => 'post-image' ) ) );
	printf( '<a href="%s" title="%s">%s</a>', get_permalink(), the_title_attribute( 'echo=0' ), $img );

}


add_filter( 'genesis_post_meta', 'dmp_post_meta_filter' );
	function dmp_post_meta_filter($post_meta) {
		if (!is_page()) {
			$post_meta = '[post_categories sep=" " before="Feature: "] [post_tags sep=" " before="Tags: "]';
			return $post_meta;
		}
}
