<?php
/**
 * The template for displaying a custom front page.
 *
 * Not to be confused with the posts page, this will display on the selected
 * front page from the reading settings. Usually includes some highlight boxes,
 * banner as defined in header.php, and some content.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package skeleton
 */
get_header(); ?>

    <div <?php post_class('content'); ?>>
    	<article>
	        <div class="main" role="main">

	            <?php if ( have_posts() ) while ( have_posts() ) : the_post();

					echo "<header>";
			            echo "<h1>".get_the_title()."</h1>";
					echo "</header>";

		            the_content();

	            endwhile; ?>

	        </div>
    	</article>

        <?php get_sidebar(); ?>

    </div>

<?php get_footer(); ?>