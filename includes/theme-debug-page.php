<?php

/**
 * Theme Debug Information Page.
 *
 * @package	skeleton
 */
class ThemeDebugPage{

	/**
	 * Hooks function to run all of our WP hooks.
	 *
	 * This serves as a pseudo-constructor, WP style.
	 */
	public function hooks() {

		add_action( 'admin_menu' , array( $this, 'add_menu_item' ) );
		add_filter( 'otm-skeleton-theme-errors', array( $this, 'missing_favicon_file' ) );

	}

	/**
	 * Add the admin-side menu item for creating & deleting test data.
	 *
	 * @see add_submenu_page
	 */
	public function add_menu_item() {

		$page = add_submenu_page(
			'themes.php',
			__( 'Theme Information', 'otm-skeleton' ),
			__( 'Theme Information', 'otm-skeleton' ),
			'manage_options',
			'theme-info',
			array( $this, 'admin_page' )
		);

	}


	/**
	 * Gets all of the registered custom image sizes available on the site.
	 *
	 * @access private
	 *
	 * @see get_intermediate_image_sizes
	 * @global array $_wp_additional_image_sizes All registered sizes.
	 *
	 * @return array All sizes & info.
	 */
	private function get_image_sizes() {
		global $_wp_additional_image_sizes;

		$sizes = array();

		foreach ( get_intermediate_image_sizes() as $_size ) {
			if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
				$sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
				$sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
				$sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
			} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
				$sizes[ $_size ] = array(
					'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
					'height' => $_wp_additional_image_sizes[ $_size ]['height'],
					'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
				);
			}
		}

		return $sizes;

	}


	/**
	 * Print out our admin page with theme debug info
	 */
	public function admin_page() {

		$html = '<div class="wrap" id="options_editor">' . "\n";

			$html .= '<h2>' . esc_html__( 'Theme Information' , 'otm-skeleton' ) . '</h2>' . "\n";

			// Loop through all available image sizes
			$html .= "<h3>" . esc_html__( 'Image Sizes', 'otm-skeleton' ) . "</h3>\n";
			$html .= $this->build_image_crops();

			// Loop through all template files
			$html .= "<h3>" . esc_html__( 'Available Page Templates', 'otm-skeleton' ) . "</h3>\n";
			$html .= $this->build_template_files();

			// Look for specific issues or errors
			$html .= "<h3>".__( 'Theme Errors', 'otm-skeleton' )."</h3>\n";
			$html .= $this->build_errors();

		echo $html;

	}


	/**
	 * Print out all image crops defined.
	 *
	 * @return string HTML of errors
	 */
	private function build_image_crops() {

		$html = '';
		$sizes = $this->get_image_sizes();

		if ( !empty( $sizes ) ) {

			$html .= "<table class='wp-list-table widefat striped plugins'>\n";

				$html .= "<thead>";
					$html .= "<tr>";
						$html .= "<td>" . esc_html__( 'ID', 'otm-skeleton' ) . "</td>";
						$html .= "<td>" . esc_html__( 'Width', 'otm-skeleton' ) . "</td>";
						$html .= "<td>" . esc_html__( 'Height', 'otm-skeleton' ) . "</td>";
						$html .= "<td>" . esc_html__( 'Hard crop?', 'otm-skeleton' ) . "</td>";
					$html .= "</tr>\n";
				$html .= "</thead>\n";

				$html .= "<tbody>\n";

				foreach ( $sizes as $size => $information ) {

					$html .= "<tr>";
						$html .= "<td>" . esc_attr( $size ) . "</td>";
						$html .= "<td>" . esc_attr( $information['width'] ) . "</td>";
						$html .= "<td>" . esc_attr( $information['height'] ) . "</td>";
						$html .= "<td>" . esc_attr( $this->boolean_to_yes( $information['crop'] ) ) . "</td>";
					$html .= "</tr>\n";

				}

				$html .= "<tbody>\n";

			$html .= "</table>\n";

		}

		return $html;

	}


	/**
	 * Print out all template files defined.
	 *
	 * @return string HTML of errors
	 */
	private function build_template_files() {

		$html = '';
		$all_templates = wp_get_theme()->get_page_templates();

		if ( !empty( $all_templates ) ) {

			$html .= "<table class='wp-list-table widefat striped plugins'>\n";

				$html .= "<thead>\n";
					$html .= "<tr>";
						$html .= "<td>" . esc_html__( 'Name', 'otm-skeleton' ) . "</td>";
						$html .= "<td>" . esc_html__( 'Path', 'otm-skeleton' ) . "</td>";
					$html .= "</tr>\n";
				$html .= "</thead>\n";

				$html .= "<tbody>\n";

				foreach ( $all_templates as $path => $name ) {
					$html .= "<tr>";
						$html .= "<td>" . $name . "</td>";
						$html .= "<td>" . $path . "</td>";
					$html .= "</tr>\n";
				}

				$html .= "</tbody>\n";

			$html .= "</table>\n";

		}

		return $html;

	}


	/**
	 * Print out errors found in the theme.
	 *
	 * @return string HTML of errors
	 */
	private function build_errors() {

		$html   = '';
		$errors = apply_filters( 'otm-skeleton-theme-errors', array() );

		if ( ! empty( $errors ) ) {
			foreach ( $errors as $error ) {

				if ( ! empty( $error['type'] ) && 'error' === $error['type'] ) {
					$color = 'red';
				} elseif ( ! empty( $error['type'] ) && 'notice' === $error['type'] ) {
					$color = 'yellow';
				}

				$html .= "<p class='" . esc_attr( $error['type'] ) . "' style='color:" . esc_attr( $color ) . ";'>";
					$html .= esc_html( $error['message'] );
				$html .= "</p>";

			}
		}

		return $html;

	}


	/**
	 * Print out our admin page with theme debug info
	 *
	 * @param array $errors Current errors
	 * @return array Possibly modified errors array
	 */
	public function missing_favicon_file( $errors ) {

		if ( ! file_exists( get_template_directory() . '/favicon.ico' ) ) {
			$errors[] = array(
				'id'      => 'favicon',
				'message' => __( 'Missing favicon.ico', 'otm-skeleton' ),
				'type'    => 'error',
			);
		}

		return $errors;

	}


	/**
	 * Convert a boolean or true integer to yes/no.
	 *
	 * @param mixes $value Value to check
	 * @return string Yes or No
	 */
	public function boolean_to_yes( $value ) {

		if ( true === $value || 1 === $value ) {
			return 'yes';
		}

		return 'no';
	}

}

// Run our class by default
$theme_page = new ThemeDebugPage();
$theme_page->hooks();
