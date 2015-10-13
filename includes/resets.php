<?php
/*
 * Resets unnecessary WordPress functionality or defaults.
 *
 * @package: skeleton
 */

// Hooks for reset functions
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );
add_filter( 'the_category', 'remove_category_rel_from_category_list' );
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
add_filter( 'the_generator', 'remove_wp_version' );
add_action( 'admin_init', 'imagelink_setup', 10 );
add_filter( 'wp_title', 'otm_wp_title', 10, 2 );
add_action('template_redirect', 'otm_single_result' );

// Functionless resets
add_filter( 'widget_text', 'do_shortcode' );
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

// Remove unnecessary actions
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

/**
 * Remove the <div> surrounding the dynamic navigation to cleanup markup.
 *
 * @return	array Modified list of argument
 */
function my_wp_nav_menu_args($args = ''){

	$args['container'] = false;
	return $args;

}

/**
 * Remove invalid rel attribute values in the categorylist.
 *
 * @return	string Modified category tag
 */
function remove_category_rel_from_category_list( $thelist ){

	return str_replace( 'rel="category tag"', 'rel="tag"', $thelist );

}

/**
 * Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail.
 *
 * @return	string Modified image tag
 */
function remove_thumbnail_dimensions( $html ){

	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	return $html;

}

/**
 * Hide WordPress version # from prying eyes.
 *
 * @return	void
 */
function remove_wp_version (){

	return '';

}

/**
 * Disable image auto-linking.
 * Because it's the most annoying thing. Ever.
 *
 * #return	void
 */
function imagelink_setup(){

	$image_set = get_option( 'image_default_link_type' );

	if ( $image_set !== 'none' ){
		update_option( 'image_default_link_type', 'none' );
	}

}

/**
 * Builds a nice, clean WordPress title.
 * Originated from Tom McFarlin
 *
 * @param	string $title Title tag text
 * @param	string $sep Seperator text
 * @return	string clean title
 */
function otm_wp_title( $title, $sep ){
	global $paged, $page;

	if ( is_feed() ){
		return $title;
	} // end if

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ){
		$title = "$title $sep $site_description";
	} // end if

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ){
		$title = sprintf( __( 'Page %s', 'otm-skeleton' ), max( $paged, $page ) ) . " $sep $title";
	} // end if

	return $title;

}

/**
 * Redirect to a single post if only one results is returned on search page
 */
function otm_single_result() {

	if ( is_search() ) {
		global $wp_query;
		if ( $wp_query->post_count == 1 ) {
			wp_redirect( get_permalink( $wp_query->posts['0']->ID ) );
		}
	}

}