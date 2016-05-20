<?php
/*
 * Template Name: Blog
 *
 * Template for looping through the blog posts (alternative to using the posts
 * for greater control).
*/

get_header(); ?>

<div <?php post_class( 'content' ); ?>>
	<main>

	    <div class="main" role="main">

	        <?php if ( have_posts() ) while ( have_posts() ) : the_post();

			echo "<header>";
		        echo "<h1>".esc_attr( get_the_title() )."</h1>";
			echo "</header>";

	        the_content();

	        endwhile;

	        rewind_posts();

            $temp = $wp_query;
            $wp_query = null;
            $wp_query = new WP_Query();
            $wp_query->query( array(
            	'showposts'	=> 5,
            	'paged'		=> $paged
            ) );

        	while (have_posts()) : the_post();

				get_template_part( 'partials/content', 'post' );

            endwhile;

	        otm_paging_nav();

	        wp_reset_query(); ?>

	    </div>

	    <?php get_sidebar( 'blog' ); ?>

	</main>
</div>

<?php get_footer(); ?>
