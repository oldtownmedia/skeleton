<?php

/**
 * Theme Setup.
 *
 * Setup theme, menus, and widgets.
 *
 * @package	skeleton
 */
class ThemeSetup{

	/**
	 * Hooks function to run all of our WP hooks.
	 *
	 * This serves as a pseudo-constructor, WP style.
	 */
	public function hooks(){

		// Base Actions
		add_action( 'after_setup_theme', array( $this, 'otm_theme_setup' ) );
		add_action( 'widgets_init', array( $this, 'otm_register_sidebars' ) );
		add_action( 'init', array( $this, 'otm_register_menus' ) );
		add_filter( 'image_size_names_choose', array( $this, 'my_small_size' ) );

		// Register the theme max width
		if ( ! isset( $content_width ) ){
			$content_width = 1200;
		}

	}

	/**
	 * Setup default theme options.
	 */
	public function otm_theme_setup(){

		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'html5', array(
			'search-form',
			'gallery',
			'caption'
		) );

		// Add a new, non-hard cropped thumbnail size
		add_image_size( 'small-no-crop', 150, 150 );

	}

	/**
	 * Registers sidebars (only register main - add others through the Custom Sidebars Plugin).
	 */
	public function otm_register_sidebars(){

		register_sidebar( array(
			'name'          => __( 'Main Sidebar', 'otm-skeleton' ),
			'id'            => 'main-sidebar',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>'
		) );

	}

	/**
	 * Register custom menus.
	 * Header Menu is only default defined menu. Add more as needed.
	 */
	public function otm_register_menus(){

		register_nav_menus( array(
			'header-menu'	=> __( 'Header Menu', 'otm-skeleton' ),
		) );

	}

	/**
	* Name custom image size with the media UI.
	*
	* @return	array Modified image size name array
	*/
	public function my_small_size( $sizes ){
		return array_merge( $sizes, array(
			'small-no-crop'	=> __( 'Small no-crop' ),
		) );
	}
}

// Run our class by default
$theme_setup = new ThemeSetup();
$theme_setup->hooks();
