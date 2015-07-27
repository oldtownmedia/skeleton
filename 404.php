<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 */
get_header(); ?>

    <div class="content">

        <div class="main" role="main">

            <header>
	            <h1>Oops! That page can't be found.</h1>
            </header>

            <p>
                Looks like something's not where it's supposed to be. You might try searching below.
            </p>

            <?php get_search_form(); ?>

        </div>

        <?php get_sidebar(); ?>

    </div>

<?php get_footer(); ?>