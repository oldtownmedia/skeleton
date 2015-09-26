<?php

add_action( 'wp_enqueue_scripts', 'load_styles');
add_action( 'init', 'editor_styles');
add_filter( 'style_loader_tag', 'style_remove');
add_action( 'wp_enqueue_scripts', 'otm_theme_scripts');
add_action( 'init', 'otm_my_init');

/**
 * Build a Google Web Fonts link.
 *
 * @return compiled font link
 */
function otm_google_web_fonts(){

	$fonts = "Source+Sans+Pro";
	$font_link = 'https://fonts.googleapis.com/css?family='.$fonts;
	$font_link = str_replace( ',', '%2C', $font_link );
	$font_link .= '&subset=latin,latin-ext';

	return $font_link;

}

/**
 * Load any necessary stylesheets.
 *
 * @return	void
 */
function load_styles(){

    wp_register_style( 'style', get_template_directory_uri() . '/styles/main.css', array(), '', 'all' );
    wp_register_style( 'fonts', $this->otm_google_web_fonts(), array(), '1', 'all' );

    wp_enqueue_style( 'style' );
    wp_enqueue_style( 'fonts' );
}

/**
 * Load backend editor styles.
 *
 * @return	void
 */
function editor_styles(){

	add_editor_style( get_template_directory_uri() . '/styles/editor-styles.css' );
    add_editor_style( $this->otm_google_web_fonts() );

}

/**
 * Remove 'text/css' from our enqueued stylesheet.
 *
 * @return	string Cleaned style tag
 */
function style_remove( $tag ){
    return preg_replace( '~\s+type=["\'][^"\']++["\']~', '', $tag );
}

/**
 * Load theme javascript.
 *
 * @return	void
 */
function otm_theme_scripts(){

    if ( !is_admin() ){
        wp_register_script( 'otm_theme', get_template_directory_uri() . '/js/scripts.min.js', array( 'jquery' ), '' );
        wp_enqueue_script( 'otm_theme' );
    }

}

/**
 * Load a custom version of jQuery from the Google CDN Network &
 * block the existing version from loading
 */
function otm_my_init() {
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', false, '1.11.3', false);
		wp_enqueue_script('jquery');
	}
}