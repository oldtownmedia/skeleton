<?php
/**
 * The template for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package skeleton
 */
get_header(); ?>

    <div <?php post_class( 'content' ); ?>>

        <div class="main" role="main">

            <?php if ( have_posts() ) while ( have_posts() ) : the_post();

            echo "<article>";

            	echo "</header>";
	                echo "<h1>".get_the_title()."</h1>";
				echo "</header>";

                the_content();

            echo "</article>";

			echo "<a href='".site_url( '/blog/' )."' class='button back' role='button'>Back to Blog</a>";

            endwhile; ?>

        </div>

        <?php get_sidebar( 'blog' ); ?>

    </div>

<?php get_footer(); ?>