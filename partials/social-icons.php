<?php
/**
 * Display social icons fro the business.
 *
 * Used in header
 *
 * @package skeleton
 */
?>
 <p class="social">

 	<?php
 		$icons = array(
 			array(
 				'type'	=> 'facebook',
 				'link'	=> 'https://facebook.com',
 			),
 			array(
 				'type'	=> 'twitter',
 				'link'	=> 'https://twitter.com',
 			),
 		);

 		$social = new ThemeIcons;
 		echo $social->assemble_icons( $icons );
 	?>

 </p>
