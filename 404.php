<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package skeleton
 */
get_header(); ?>

    <div class="content">

        <div class="main" role="main">

            <header>
	            <h1><?php esc_html_e( 'Oops! That page can\'t be found.', 'otm-skeleton' ); ?></h1>
            </header>

            <p>
                <?php esc_html_e( 'Looks like something\'s not where it\'s supposed to be. You might try the main menu to find what you need.', 'otm-skeleton' ); ?>
            </p>

        </div>

        <?php get_sidebar(); ?>

    </div>

<?php get_footer(); ?>
