<?php get_header(); ?>

    <div <?php post_class('content'); ?>>
        <div class="main" role="main">
        	<article>

            <?php if ( have_posts() ) while ( have_posts() ) : the_post();

            	echo "<header>";
	                echo "<h1>".get_the_title()."</h1>";
				echo "</header>";

                the_content();

            endwhile; ?>

            </article>

        </div>

        <?php get_sidebar(); ?>

    </div>

<?php get_footer(); ?>