<?php get_header(); ?>

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