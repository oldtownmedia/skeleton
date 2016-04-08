<?php
/*
 * Template used by all default pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package skeleton
 */
get_header(); ?>

    <div <?php post_class( 'content' ); ?>>

        <div class="main">

            <?php if ( have_posts() ) while ( have_posts() ) : the_post();

	            echo "<article>";

	            	echo "<header>";
		                echo "<h1>".esc_attr( get_the_title() )."</h1>";
					echo "</header>";

	                the_content();

	             echo "</article>";

			 endwhile; ?>

        </div>

        <?php get_sidebar(); ?>

    </div>

<?php get_footer(); ?>