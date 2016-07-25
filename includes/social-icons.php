<?php

/**
 * ThemeIcons class.
 *
 * This class allows easy and convenient calls of custom social media icons in
 * the theme. Icons are called as SVGs to avoid loading in an extra icon font
 * or images. Icons can easily be added into $this->icon_paths for more flexibility.
 *
 * @package skeleton
 */

class ThemeIcons{

	/**
	 * Build icons through an array fed in.
	 *
	 * @see $this->build_icon
	 *
	 * @param 	array Icons to build HTML for
	 * @param	string Unique identifier for this set of icons
	 * @return	string html assembly of icons
	 */
	public function assemble_icons( $icons = array(), $instance = '-base' ) {
		$html = '';

		// Check that the data exists and is a proper array
		if ( !is_array( $icons ) && empty( $icons ) ) {
			return;
		}

		// Loop through the icons and then fetch the HTML for each
		foreach ( $icons as $icon ) {

			$html .= $this->build_icon( $icon, $instance );

		}

		return $html;

	}


	/**
	 * Print a single icon instead of a complex array.
	 *
	 * @see $this->build_icon
	 *
	 * @param 	array Icon to build HTML for
	 * @param	string Unique identifier for this set of icons
	 * @return	string HTML assembly of icons
	 */
	public function single_icon( $icon = array(), $instance = '-base' ) {

		// Check that the data exists and is a proper array
		if ( !is_array( $icon ) && empty( $icon ) ) {
			return;
		}

		// Fetch and return the HTML for this icon
		return $this->build_icon( $icon, $instance );

	}


	/**
	 * Assemble the html for each icon fed into assemble_icons.
	 *
	 * @see $this->icon_paths
	 *
	 * @access 	private
	 * @param 	array Icons to build HTML for
	 * @param	string Unique identifier for this set of icons
	 * @return 	string html for each icon
	 */
	private function build_icon( $icon_data, $instance ) {

		$html = $prehtml = '';

		// Check that the data exists and is a proper array
		if ( !is_array( $icon_data ) && empty( $icon_data ) ) {
			return;
		}

		// If we have a link, insert it and otherwise insert an anchor tag (for
		// consistency) but without the href.
		if ( isset( $icon_data['link'] ) ) {
			$html .= "<a href='" . esc_url( $icon_data['link'] ) . "' target='_blank' class='"  . esc_attr( $icon_data['type'] ) . "' aria-label='" . esc_attr( ucwords( $icon_data['type'] ) ) . " link'>";
		} else {
			$html .= "<span class='" . esc_attr( $icon_data['type'] ) . "' aria-label='" . esc_attr( ucwords( $icon_data['type'] ) ) . " icon'>";
		}

		// Get our icons unique paths & dimensions
		$icon_paths = $this->icon_paths( $icon_data );

		// Build a separate SVG object for reference only.
		$html .= "<svg xmlns='http://www.w3.org/2000/svg' style='display: none;'>";
			$html .= '<symbol id="icon-' . esc_attr( $icon_data['type'] . $instance ) . '" viewBox="0 0 ' . esc_attr( $icon_paths['dimensions'] ) . '">';
				$html .= '<title>' . esc_html( ucwords( $icon_data['type'] ) ) . '</title>';
				$html .= wp_kses( $icon_paths['paths'], array(
					'path' => array(
						'class'	=> array(),
						'id'	=> array(),
						'd'		=> array(),
				    ),
					'g' => array(
						'class'	=> array(),
						'id'	=> array(),
					),
				) );
			$html .= '</symbol>';
		$html .= "</svg>";

		// This is our main SVG used for presentation
		$html .= '<svg class="icon icon-' . esc_attr( $icon_data['type'] ) . '"><use xlink:href="#icon-' . esc_attr( $icon_data['type'] . $instance ) . '"></use></svg>';

		if ( isset( $icon_data['link'] ) ) {
			$html .= "</a>";
		} else {
			$html .= "</span>";
		}

		// Return both hidden & visual SVGs
		return $prehtml . $html;

	}


	/**
	 * Return the SVG path & dimensions for each icon available.
	 *
	 * @access 	private
	 * @param 	array Icons to build HTML for
	 * @return 	array SVG paths for each icon & dimension data
	 */
	private function icon_paths( $icon_data ) {

		$icon = array();

		switch( $icon_data['type'] ) {

			// Dropbox logo
			case 'dropbox' :

				$icon['paths'] 		= '<path class="svg-main-color" d="M229.714 404l282.286 174.286-195.429 162.857-280-182.286zM793.143 721.143v61.714l-280 167.429v0.571l-0.571-0.571-0.571 0.571v-0.571l-279.429-167.429v-61.714l84 54.857 195.429-162.286v-1.143l0.571 0.571 0.571-0.571v1.143l196 162.286zM316.571 67.429l195.429 162.857-282.286 173.714-193.143-154.286zM794.286 404l193.143 154.857-279.429 182.286-196-162.857zM708 67.429l279.429 182.286-193.143 154.286-282.286-173.714z"></path>';

			break;

			// Letter
			case 'email' :

				$icon['paths'] 		= '<path class="svg-main-color" d="M512.48 603.552l-130.304-106.976-283.584 334.816h828.032l-283.616-338.144-130.528 110.304zM957.632 192.608h-890.080l445.056 374.336 445.024-374.336zM662.56 476.384l297.312 354.688v-606.464l-297.312 251.776zM64.128 224.608v606.464l297.312-354.688-297.312-251.776z"></path>';

			break;

			// Facebook logo
			case 'facebook' :

				$icon['dimensions'] = '585 1024';
				$icon['paths'] 		= '<path class="svg-main-color" d="M548 6.857v150.857h-89.714q-49.143 0-66.286 20.571t-17.143 61.714v108h167.429l-22.286 169.143h-145.143v433.714h-174.857v-433.714h-145.714v-169.143h145.714v-124.571q0-106.286 59.429-164.857t158.286-58.571q84 0 130.286 6.857z"></path>';

			break;

			// FLick logo
			case 'flickr' :

				$icon['paths'] 		= '<path class="svg-main-color" d="M0 544c0-123.712 100.288-224 224-224s224 100.288 224 224c0 123.712-100.288 224-224 224s-224-100.288-224-224zM576 544c0-123.712 100.288-224 224-224s224 100.288 224 224c0 123.712-100.288 224-224 224s-224-100.288-224-224z"></path>';

			break;

			// Github logo
			case 'github' :

				$icon['paths'] 		= '<path class="svg-main-color" d="M877.714 512q0 143.429-83.714 258t-216.286 158.571q-15.429 2.857-22.571-4t-7.143-17.143v-120.571q0-55.429-29.714-81.143 32.571-3.429 58.571-10.286t53.714-22.286 46.286-38 30.286-60 11.714-86q0-69.143-45.143-117.714 21.143-52-4.571-116.571-16-5.143-46.286 6.286t-52.571 25.143l-21.714 13.714q-53.143-14.857-109.714-14.857t-109.714 14.857q-9.143-6.286-24.286-15.429t-47.714-22-49.143-7.714q-25.143 64.571-4 116.571-45.143 48.571-45.143 117.714 0 48.571 11.714 85.714t30 60 46 38.286 53.714 22.286 58.571 10.286q-22.857 20.571-28 58.857-12 5.714-25.714 8.571t-32.571 2.857-37.429-12.286-31.714-35.714q-10.857-18.286-27.714-29.714t-28.286-13.714l-11.429-1.714q-12 0-16.571 2.571t-2.857 6.571 5.143 8 7.429 6.857l4 2.857q12.571 5.714 24.857 21.714t18 29.143l5.714 13.143q7.429 21.714 25.143 35.143t38.286 17.143 39.714 4 31.714-2l13.143-2.286q0 21.714 0.286 50.857t0.286 30.857q0 10.286-7.429 17.143t-22.857 4q-132.571-44-216.286-158.571t-83.714-258q0-119.429 58.857-220.286t159.714-159.714 220.286-58.857 220.286 58.857 159.714 159.714 58.857 220.286z"></path>';


			break;

			// Github logo
			case 'github-alt' :

				$icon['dimensions'] = '951 1024';
				$icon['paths'] 		= '<path class="svg-main-color" d="M365.714 694.857q0 22.857-7.143 46.857t-24.571 43.429-41.429 19.429-41.429-19.429-24.571-43.429-7.143-46.857 7.143-46.857 24.571-43.429 41.429-19.429 41.429 19.429 24.571 43.429 7.143 46.857zM731.429 694.857q0 22.857-7.143 46.857t-24.571 43.429-41.429 19.429-41.429-19.429-24.571-43.429-7.143-46.857 7.143-46.857 24.571-43.429 41.429-19.429 41.429 19.429 24.571 43.429 7.143 46.857zM822.857 694.857q0-68.571-39.429-116.571t-106.857-48q-23.429 0-111.429 12-40.571 6.286-89.714 6.286t-89.714-6.286q-86.857-12-111.429-12-67.429 0-106.857 48t-39.429 116.571q0 50.286 18.286 87.714t46.286 58.857 69.714 34.286 80 16.857 85.143 4h96q46.857 0 85.143-4t80-16.857 69.714-34.286 46.286-58.857 18.286-87.714zM950.857 594.286q0 118.286-34.857 189.143-21.714 44-60.286 76t-80.571 49.143-97.143 27.143-98 12.571-95.429 2.571q-44.571 0-81.143-1.714t-84.286-7.143-87.143-17.143-78.286-29.429-69.143-46.286-49.143-65.714q-35.429-70.286-35.429-189.143 0-135.429 77.714-226.286-15.429-46.857-15.429-97.143 0-66.286 29.143-124.571 61.714 0 108.571 22.571t108 70.571q84-20 176.571-20 84.571 0 160 18.286 60-46.857 106.857-69.143t108-22.286q29.143 58.286 29.143 124.571 0 49.714-15.429 96 77.714 91.429 77.714 227.429z"></path>';

			break;

			// Google + logo
			case 'google-plus' :

				$icon['dimensions'] = '951 1024';
				$icon['paths'] 		= '<path class="svg-main-color" d="M420 454.857q0 20.571 18.286 40.286t44.286 38.857 51.714 42 44 59.429 18.286 81.143q0 51.429-27.429 98.857-41.143 69.714-120.571 102.571t-170.286 32.857q-75.429 0-140.857-23.714t-98-78.571q-21.143-34.286-21.143-74.857 0-46.286 25.429-85.714t67.714-65.714q74.857-46.857 230.857-57.143-18.286-24-27.143-42.286t-8.857-41.714q0-20.571 12-48.571-26.286 2.286-38.857 2.286-84.571 0-142.571-55.143t-58-139.714q0-46.857 20.571-90.857t56.571-74.857q44-37.714 104.286-56t124.286-18.286h238.857l-78.857 50.286h-74.857q42.286 36 64 76t21.714 91.429q0 41.143-14 74t-33.714 53.143-39.714 37.143-34 35.143-14 37.714zM336.571 400q21.714 0 44.571-9.429t37.714-24.857q30.286-32.571 30.286-90.857 0-33.143-9.714-71.429t-27.714-74-48.286-59.143-66.857-23.429q-24 0-47.143 11.143t-37.429 30q-26.857 33.714-26.857 91.429 0 26.286 5.714 55.714t18 58.857 29.714 52.857 42.857 38.286 55.143 14.857zM337.714 898.857q33.143 0 63.714-7.429t56.571-22.286 41.714-41.714 15.714-62.286q0-14.286-4-28t-8.286-24-15.429-23.714-16.857-20-22-19.714-20.857-16.571-23.714-17.143-20.857-14.857q-9.143-1.143-27.429-1.143-30.286 0-60 4t-61.429 14.286-55.429 26.286-39.143 42.571-15.429 60.286q0 40 20 70.571t52.286 47.429 68 25.143 72.857 8.286zM800.571 398.286h121.714v61.714h-121.714v125.143h-60v-125.143h-121.143v-61.714h121.143v-124h60v124z"></path>';

			break;

			// Houzz logo
			case 'houzz' :

				$icon['dimensions'] = '1325 1024';
				$icon['paths'] 		= '<path class="svg-main-color" d="M692.706 984.010l280.596-164.141v-319.080l-280.596 164.141z"></path>
					<path class="svg-main-color" d="M692.706 343.843l280.596 156.946v-320.92z"></path>
					<path class="black" d="M692.706 343.843v321.088l280.596-164.141z"></path>
					<path class="svg-main-color" d="M411.775 508.486v321.088l280.596-164.141z"></path>
					<path class="svg-main-color" d="M692.371 15.226l-280.596 164.141v329.119l280.596-163.974z"></path>
					<path class="white" d="M692.371 344.512l-280.596 163.974 280.596 156.946z"></path>';

			break;

			// Instagram logo
			case 'instagram' :

				$icon['paths'] 		= '<path class="svg-main-color" d="M778.286 814.857v-370.286h-77.143q11.429 36 11.429 74.857 0 72-36.571 132.857t-99.429 96.286-137.143 35.429q-112.571 0-192.571-77.429t-80-187.143q0-38.857 11.429-74.857h-80.571v370.286q0 14.857 10 24.857t24.857 10h610.857q14.286 0 24.571-10t10.286-24.857zM616 510.286q0-70.857-51.714-120.857t-124.857-50q-72.571 0-124.286 50t-51.714 120.857 51.714 120.857 124.286 50q73.143 0 124.857-50t51.714-120.857zM778.286 304.571v-94.286q0-16-11.429-27.714t-28-11.714h-99.429q-16.571 0-28 11.714t-11.429 27.714v94.286q0 16.571 11.429 28t28 11.429h99.429q16.571 0 28-11.429t11.429-28zM877.714 185.714v652.571q0 46.286-33.143 79.429t-79.429 33.143h-652.571q-46.286 0-79.429-33.143t-33.143-79.429v-652.571q0-46.286 33.143-79.429t79.429-33.143h652.571q46.286 0 79.429 33.143t33.143 79.429z"></path>';

			break;

			// LinkedIn logo
			case 'linkedin' :

				$icon['paths'] 		= '<path class="svg-main-color" d="M199.429 357.143v566.286h-188.571v-566.286h188.571zM211.429 182.286q0.571 41.714-28.857 69.714t-77.429 28h-1.143q-46.857 0-75.429-28t-28.571-69.714q0-42.286 29.429-70t76.857-27.714 76 27.714 29.143 70zM877.714 598.857v324.571h-188v-302.857q0-60-23.143-94t-72.286-34q-36 0-60.286 19.714t-36.286 48.857q-6.286 17.143-6.286 46.286v316h-188q1.143-228 1.143-369.714t-0.571-169.143l-0.571-27.429h188v82.286h-1.143q11.429-18.286 23.429-32t32.286-29.714 49.714-24.857 65.429-8.857q97.714 0 157.143 64.857t59.429 190z"></path>';

			break;

			// Map icon - similar to Google maps
			case 'map' :

				$icon['paths'] 		= '<path class="svg-main-color" d="M512 0c-176.732 0-320 143.268-320 320 0 320 320 704 320 704s320-384 320-704c0-176.732-143.27-320-320-320zM512 512c-106.040 0-192-85.96-192-192s85.96-192 192-192 192 85.96 192 192-85.96 192-192 192z"></path>';

			break;

			// Landline phone icon
			case 'phone' :

				$icon['dimensions'] = '805 1024';
				$icon['paths'] 		= '<path class="svg-main-color" d="M804.571 708.571q0 15.429-5.714 40.286t-12 39.143q-12 28.571-69.714 60.571-53.714 29.143-106.286 29.143-15.429 0-30-2t-32.857-7.143-27.143-8.286-31.714-11.714-28-10.286q-56-20-100-47.429-73.143-45.143-151.143-123.143t-123.143-151.143q-27.429-44-47.429-100-1.714-5.143-10.286-28t-11.714-31.714-8.286-27.143-7.143-32.857-2-30q0-52.571 29.143-106.286 32-57.714 60.571-69.714 14.286-6.286 39.143-12t40.286-5.714q8 0 12 1.714 10.286 3.429 30.286 43.429 6.286 10.857 17.143 30.857t20 36.286 17.714 30.571q1.714 2.286 10 14.286t12.286 20.286 4 16.286q0 11.429-16.286 28.571t-35.429 31.429-35.429 30.286-16.286 26.286q0 5.143 2.857 12.857t4.857 11.714 8 13.714 6.571 10.857q43.429 78.286 99.429 134.286t134.286 99.429q1.143 0.571 10.857 6.571t13.714 8 11.714 4.857 12.857 2.857q10.286 0 26.286-16.286t30.286-35.429 31.429-35.429 28.571-16.286q8 0 16.286 4t20.286 12.286 14.286 10q14.286 8.571 30.571 17.714t36.286 20 30.857 17.143q40 20 43.429 30.286 1.714 4 1.714 12z"></path>';

			break;

			// Pinterest logo
			case 'pinterest' :

				$icon['paths'] 		= '<path class="svg-main-color" d="M877.714 512q0 119.429-58.857 220.286t-159.714 159.714-220.286 58.857q-63.429 0-124.571-18.286 33.714-53.143 44.571-93.714 5.143-19.429 30.857-120.571 11.429 22.286 41.714 38.571t65.143 16.286q69.143 0 123.429-39.143t84-107.714 29.714-154.286q0-65.143-34-122.286t-98.571-93.143-145.714-36q-60 0-112 16.571t-88.286 44-62.286 63.143-38.286 74-12.286 76.571q0 59.429 22.857 104.571t66.857 63.429q17.143 6.857 21.714-11.429 1.143-4 4.571-17.714t4.571-17.143q3.429-13.143-6.286-24.571-29.143-34.857-29.143-86.286 0-86.286 59.714-148.286t156.286-62q86.286 0 134.571 46.857t48.286 121.714q0 97.143-39.143 165.143t-100.286 68q-34.857 0-56-24.857t-13.143-59.714q4.571-20 15.143-53.429t17.143-58.857 6.571-43.143q0-28.571-15.429-47.429t-44-18.857q-35.429 0-60 32.571t-24.571 81.143q0 41.714 14.286 69.714l-56.571 238.857q-9.714 40-7.429 101.143-117.714-52-190.286-160.571t-72.571-241.714q0-119.429 58.857-220.286t159.714-159.714 220.286-58.857 220.286 58.857 159.714 159.714 58.857 220.286z"></path>';

			break;

			// Twitter logo
			case 'twitter' :

				$icon['dimensions'] = '951 1024';
				$icon['paths'] 		= '<path class="svg-main-color" d="M925.714 233.143q-38.286 56-92.571 95.429 0.571 8 0.571 24 0 74.286-21.714 148.286t-66 142-105.429 120.286-147.429 83.429-184.571 31.143q-154.857 0-283.429-82.857 20 2.286 44.571 2.286 128.571 0 229.143-78.857-60-1.143-107.429-36.857t-65.143-91.143q18.857 2.857 34.857 2.857 24.571 0 48.571-6.286-64-13.143-106-63.714t-42-117.429v-2.286q38.857 21.714 83.429 23.429-37.714-25.143-60-65.714t-22.286-88q0-50.286 25.143-93.143 69.143 85.143 168.286 136.286t212.286 56.857q-4.571-21.714-4.571-42.286 0-76.571 54-130.571t130.571-54q80 0 134.857 58.286 62.286-12 117.143-44.571-21.143 65.714-81.143 101.714 53.143-5.714 106.286-28.571z"></path>';

			break;

			// Tumblr logo
			case 'tumblr' :

				$icon['dimensions'] = '585 1024';
				$icon['paths'] 		= '<path class="svg-main-color" d="M539.429 759.429l45.714 135.429q-13.143 20-63.429 37.714t-101.143 18.286q-59.429 1.143-108.857-14.857t-81.429-42.286-54.286-60.571-31.714-68.571-9.429-67.429v-310.857h-96v-122.857q41.143-14.857 73.714-39.714t52-51.429 33.143-58.286 19.429-56.571 8.571-50.571q0.571-2.857 2.571-4.857t4.286-2h139.429v242.286h190.286v144h-190.857v296q0 17.143 3.714 32t12.857 30 28.286 23.714 46.571 8q44.571-1.143 76.571-16.571z"></path>';

			break;

			// Vimeo logo
			case 'vimeo' :

				$icon['paths'] 		= '<path class="svg-main-color" d="M0 308.37l41.594 54.544c0 0 85.77-67.608 114.36-33.802 28.588 33.802 137.736 441.956 174.17 517.246 31.8 66.030 119.518 153.32 215.714 90.982 96.136-62.34 415.84-335.286 473.066-657.616 57.18-322.226-384.72-254.726-431.53 26.010 116.99-70.236 179.436 28.538 119.57 140.372-59.758 111.724-114.36 184.592-142.952 184.592-28.538 0-50.49-74.768-83.188-205.446-33.798-135.102-33.592-378.46-174.116-350.87-132.518 26.012-306.688 233.988-306.688 233.988z"></path>';

			break;

			// Yelp logo
			case 'yelp' :

				$icon['paths'] 		= '<path class="svg-main-color" d="M441.714 753.714v72.571q-0.571 166.857-3.429 174.286-6.857 18.286-29.143 22.857-30.857 5.143-103.714-21.714t-92.857-50.857q-7.429-8.571-9.714-20.571-0.571-6.857 2.286-14.857 2.286-5.714 19.429-26.857t103.429-123.429q0.571 0 34.286-40 8.571-10.857 22.571-14t28.286 2q13.714 5.714 21.429 16.571t7.143 24zM356.571 610.286q-1.714 31.429-29.714 40l-68.571 22.286q-157.143 50.286-166.857 50.286-20-1.143-30.857-20.571-6.857-14.286-9.714-42.857-4.571-43.429 0.571-95.143t17.143-71.143 32-18.286q7.429 0 115.429 44 40 16.571 65.714 26.857l48 19.429q13.143 5.143 20.286 17.429t6.571 27.714zM828.571 780q-4 30.857-52.286 92t-77.429 72.571q-21.143 8-36-4-8-5.714-105.143-164l-26.857-44q-8-12-6.571-26.286t11.143-26.286q20-24.571 47.429-14.857 0.571 0.571 68 22.857 116 37.714 138.286 45.429t26.857 11.714q16 12.571 12.571 34.857zM444.571 418.857q2.857 58.286-30.857 69.714-33.143 9.714-65.143-40.571l-216-341.714q-4.571-20 10.857-35.429 23.429-24.571 118.571-51.143t128.286-18q22.857 5.714 28 25.714 1.714 10.286 12.571 174.571t13.714 216.857zM822.857 480.571q1.714 22.286-14.857 33.714-8.571 5.714-188 49.143-38.286 8.571-52 13.143l0.571-1.143q-13.143 3.429-26.286-2.286t-21.143-18.286q-17.143-26.857 0-49.714 0.571-0.571 42.857-58.286 71.429-97.714 85.714-116.571t19.429-22.286q16-10.857 37.143-1.143 27.429 13.143 70.286 76.286t46.286 95.714v1.714z"></path>';

			break;

			// Yahoo logo
			case 'yahoo' :

				$icon['paths'] 		= '<path class="svg-main-color" d="M848 640l-14.858-416.020c-0.628-17.59 13.258-31.98 30.858-31.98h128c17.6 0 29.468 14.176 26.376 31.502l-74.376 416.498zM960 776c0 30.8-25.2 56-56 56h-16c-30.8 0-56-25.2-56-56v-16c0-30.8 25.2-56 56-56h16c30.8 0 56 25.2 56 56v16zM384 192c-212.078 0-384 143.268-384 320 0 176.73 171.922 320 384 320s384-143.27 384-320c0-176.732-171.922-320-384-320zM640 448h-74.262l-117.738 117.74v74.26h96v64h-256v-64h96v-74.26l-181.74-181.74h-42.062v-64h191.606v64h-42.064l106.26 106.26 32-32v-74.26h192v64z"></path>';

			break;

			// YouTube logo
			case 'youtube' :

				$icon['paths'] 		= '<path class="svg-main-color" d="M554.857 710.857v120.571q0 38.286-22.286 38.286-13.143 0-25.714-12.571v-172q12.571-12.571 25.714-12.571 22.286 0 22.286 38.286zM748 711.429v26.286h-51.429v-26.286q0-38.857 25.714-38.857t25.714 38.857zM196 586.857h61.143v-53.714h-178.286v53.714h60v325.143h57.143v-325.143zM360.571 912h50.857v-282.286h-50.857v216q-17.143 24-32.571 24-10.286 0-12-12-0.571-1.714-0.571-20v-208h-50.857v223.429q0 28 4.571 41.714 6.857 21.143 33.143 21.143 27.429 0 58.286-34.857v30.857zM605.714 827.429v-112.571q0-41.714-5.143-56.571-9.714-32-40.571-32-28.571 0-53.143 30.857v-124h-50.857v378.857h50.857v-27.429q25.714 31.429 53.143 31.429 30.857 0 40.571-31.429 5.143-15.429 5.143-57.143zM798.857 821.714v-7.429h-52q0 29.143-1.143 34.857-4 20.571-22.857 20.571-26.286 0-26.286-39.429v-49.714h102.286v-58.857q0-45.143-15.429-66.286-22.286-29.143-60.571-29.143-38.857 0-61.143 29.143-16 21.143-16 66.286v98.857q0 45.143 16.571 66.286 22.286 29.143 61.714 29.143 41.143 0 61.714-30.286 10.286-15.429 12-30.857 1.143-5.143 1.143-33.143zM451.429 300v-120q0-39.429-24.571-39.429t-24.571 39.429v120q0 40 24.571 40t24.571-40zM862.286 729.143q0 133.714-14.857 200-8 33.714-33.143 56.571t-58.286 26.286q-105.143 12-317.143 12t-317.143-12q-33.143-3.429-58.571-26.286t-32.857-56.571q-14.857-64-14.857-200 0-133.714 14.857-200 8-33.714 33.143-56.571t58.857-26.857q104.571-11.429 316.571-11.429t317.143 11.429q33.143 4 58.571 26.857t32.857 56.571q14.857 64 14.857 200zM292 0h58.286l-69.143 228v154.857h-57.143v-154.857q-8-42.286-34.857-121.143-21.143-58.857-37.143-106.857h60.571l40.571 150.286zM503.429 190.286v100q0 46.286-16 67.429-21.143 29.143-60.571 29.143-38.286 0-60-29.143-16-21.714-16-67.429v-100q0-45.714 16-66.857 21.714-29.143 60-29.143 39.429 0 60.571 29.143 16 21.143 16 66.857zM694.857 97.714v285.143h-52v-31.429q-30.286 35.429-58.857 35.429-26.286 0-33.714-21.143-4.571-13.714-4.571-42.857v-225.143h52v209.714q0 18.857 0.571 20 1.714 12.571 12 12.571 15.429 0 32.571-24.571v-217.714h52z"></path>';

			break;

		}

		if ( !isset( $icon['dimensions'] ) ) {
			$icon['dimensions'] = '1024 1024';
		}

		return $icon;

	}

}
