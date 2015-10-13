<?php
/**
 * Custom search form used throughout site.
 *
 * While not required, this file gives the ability to customize the searchform.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package skeleton
 */
?>

<form role="search" method="get" name="articlesearchform" class="searchform" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">

	<input type="text" class="field" name="s"  id="s" placeholder="<?php _e( 'Search', 'otm-skeleton' ); ?>">
	<input type="submit" class="submit" name="submit" value="<?php _e( 'GO', 'otm-skeleton' ); ?>"/>

</form>