<?php
/*
 * Template Name: Full Width Page
 *
 * Template for a full-width main content area without the sidebar.
*/
get_header(); ?>

    <div <?php post_class( 'content' ); ?> role="main">

        <article>

        <?php if ( have_posts() ) while ( have_posts() ) : the_post();

			echo "<header>";
	            echo "<h1>".esc_attr( get_the_title() )."</h1>";
			echo "</header>";

            the_content();

        endwhile; ?>

        </article>

    </div>

<?php get_footer(); ?>