<?php
defined( 'ABSPATH' ) OR exit;

/**
 * Default Functions
 *
 * These simple functions ship with all WordPress themes from Old Town Media
 *
 * @package	WordPress
 * @author	Old Town Media, Inc.
 */
class DefaultFunctions{

	/**
	 * Constructor function.
	 *
	 * @access public
	 * @since 0.0.0
	 * @return void
	 */
	public function __construct(){

		// Base Actions
		add_action( 'after_setup_theme', array( $this, 'otm_theme_setup' ) );
		add_action( 'widgets_init', array( $this, 'otm_register_sidebars' ) );
		add_action( 'init', array( $this, 'otm_register_menus' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_styles' ) );
		add_action( 'init', array( $this, 'editor_styles' ) );
		add_action( 'init', array( $this, 'otm_theme_scripts' ) );
		add_action( 'admin_init', array( $this, 'imagelink_setup' ), 10 );

		// Base Filters
		add_filter( 'widget_text', 'do_shortcode' );
		add_filter( 'style_loader_tag', array( $this, 'style_remove' ) );
		add_filter( 'wp_nav_menu_args', array( $this, 'my_wp_nav_menu_args' ) );
		add_filter( 'the_category', array( $this, 'remove_category_rel_from_category_list' ) );
		add_filter( 'post_thumbnail_html', array( $this, 'remove_thumbnail_dimensions' ), 10 );
		add_filter( 'image_send_to_editor', array( $this, 'remove_thumbnail_dimensions' ), 10 );
		add_filter( 'the_generator', array( $this, 'remove_wp_version' ) );
		add_filter( 'wp_title', array( $this, 'otm_wp_title'), 10, 2 );
		add_filter( 'login_errors',create_function( '$a', "return null;" ) );
		add_filter( 'image_size_names_choose', array( $this, 'my_small_size' ) );
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

		// Register the theme max width
		if ( ! isset( $content_width ) ){
			$content_width = 1000;
		}

	}

	/**
	 * Setup default theme options.
	 *
	 * @access  public
	 * @return void
	 */
	public function otm_theme_setup(){

		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5', array(
			'search-form', 'gallery', 'caption',
		) );

		// Add a new, non-hard cropped thumbnail size
		add_image_size( 'small-no-crop', 150, 150 );

	}

	/**
	 * Registers sidebars (only register main - add others through the Custom Sidebars Plugin.
	 *
	 * @access public
	 * @return void
	 */
	public function otm_register_sidebars(){

		register_sidebar( array(
			'name'          => __( 'Main Sidebar', 'otm-skeleton' ),
			'id'            => 'main-sidebar',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

	}

	/**
	 * Register custom menus.
	 * Header Menu is only default defined menu. Add more as needed.
	 *
	 * @access public
	 * @return void
	 */
	public function otm_register_menus(){

	  register_nav_menus( array(
	  	'header-menu'	=> __( 'Header Menu', 'otm-skeleton' ),
	  ) );

	}

	/**
	 * Build a Google Web Fonts link.
	 *
	 * @access public
	 * @return compiled font link
	 */
	public function otm_google_web_fonts(){

		$fonts = "Source+Sans+Pro|Englebert|Sacramento";
		$font_link = 'https://fonts.googleapis.com/css?family='.$fonts;
		$font_link = str_replace( ',', '%2C', $font_link );
		$font_link .= '&subset=latin,latin-ext';

		return $font_link;

	}

	/**
	 * Load any necessary stylesheets.
	 *
	 * @access  public
	 * @return	void
	 */
	public function load_styles(){

	    wp_register_style( 'style', get_template_directory_uri() . '/styles/main.css', array(), '', 'all' );
	    wp_register_style( 'fonts', $this->otm_google_web_fonts(), array(), '1', 'all' );

	    wp_enqueue_style( 'style' );
	    wp_enqueue_style( 'fonts' );
	}

	/**
	 * Load backend editor styles.
	 *
	 * @access  public
	 * @return	void
	 */
	public function editor_styles(){

		add_editor_style( get_template_directory_uri() . '/styles/editor-styles.css' );
	    add_editor_style( $this->otm_google_web_fonts() );

	}

	/**
	 * Load theme javascript.
	 *
	 * @access  public
	 * @return	void
	 */
	public function otm_theme_scripts(){

	    if ( !is_admin() ){
	        wp_register_script( 'otm_theme', get_template_directory_uri() . '/js/scripts.min.js', array( 'jquery' ), '' );

	        wp_enqueue_script( 'otm_theme' );
	    }

	}

	/**
	 * Remove 'text/css' from our enqueued stylesheet.
	 *
	 * @access	public
	 * @return	string Cleaned style tag
	 */
	public function style_remove( $tag ){
	    return preg_replace( '~\s+type=["\'][^"\']++["\']~', '', $tag );
	}

	/**
	 * Remove the <div> surrounding the dynamic navigation to cleanup markup.
	 *
	 * @access  public
	 * @return	array Modified list of argument
	 */
	public function my_wp_nav_menu_args($args = ''){
	    $args['container'] = false;
	    return $args;
	}

	/**
	 * Remove invalid rel attribute values in the categorylist.
	 *
	 * @access  public
	 * @return	string Modified category tag
	 */
	public function remove_category_rel_from_category_list( $thelist ){
	    return str_replace( 'rel="category tag"', 'rel="tag"', $thelist );
	}

	/**
	 * Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail.
	 *
	 * @access  public
	 * @return	string Modified image tag
	 */
	public function remove_thumbnail_dimensions( $html ){
	    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	    return $html;
	}

	/**
	 * Hide WordPress version # from prying eyes.
	 *
	 * @access  public
	 * @return	void
	 */
	public function remove_wp_version (){
	    return '';
	}

	/**
	 * Disable image auto-linking.
	 * Because it's the most annoying thing. Ever.
	 *
	 * @access  public
	 * #return	void
	 */
	public function imagelink_setup(){
	    $image_set = get_option( 'image_default_link_type' );

	    if ( $image_set !== 'none' ){
	    	update_option( 'image_default_link_type', 'none' );
	    }
	}

	/**
	 * Builds a nice, clean WordPress title.
	 * Originated from Tom McFarlin
	 *
	 * @access  public
	 * @param	string $title Title tag text
	 * @param	string $sep Seperator text
	 * @return	string clean title
	 */
	public function otm_wp_title( $title, $sep ){
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
			$title = sprintf( __( 'Page %s', 'mayer' ), max( $paged, $page ) ) . " $sep $title";
		} // end if

		return $title;

	}

	/**
	 * Name custom image size with the media UI.
	 *
	 * @access  public
	 * $return	array Modified image size name array
	 */
	public function my_small_size( $sizes ){
	    return array_merge( $sizes, array(
	        'small-no-crop'	=> __( 'Small no-crop' ),
	    ) );
	}
}

// Run our class by default
$otm_default_functions = new DefaultFunctions();

/**
 * Display navigation to next/previous pages when applicable.
 * Used within single posts.
 *
 * @return void
 */
function otm_paging_nav(){
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ){
		return;
	}
	?>
	<nav class="navigation paging-navigation">
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'otm-skeleton' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'otm-skeleton' ) ); ?></div>
			<?php endif; ?>

		</div>
	</nav>
	<?php
}

/**
 * Display navigation to next/previous pages when applicable.
 * Used on post listing pages.
 *
 * @return void
 */
function otm_post_nav(){

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ){
		return;
	}
	?>
	<nav class="navigation post-navigation">
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'otm-skeleton' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'otm-skeleton' ) );
			?>
		</div>
	</nav>
	<?php
}

?>