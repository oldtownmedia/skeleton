<?php
/* The main fallback for all other templates.
 *
 * As required by the template hierarchy, this template is the fallback for all
 * others. Designed to match page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package skeleton
 */
get_header(); ?>

    <div <?php post_class( 'content' ); ?>>

        <div class="main" role="main">

        	<article>

            <?php if ( have_posts() ) while ( have_posts() ) : the_post();

            	echo "<header>";
	                echo "<h1>" . esc_html( get_the_title() ) . "</h1>";
				echo "</header>";

                the_content();

            endwhile; ?>

            </article>

        </div>

        <?php get_sidebar(); ?>

    </div>

<?php get_footer(); ?>
