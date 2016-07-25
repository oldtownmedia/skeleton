<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package skeleton
 */
get_header(); ?>

<div <?php post_class( 'content' ); ?>>

	<section>
		<div class="main">

			<header>
		        <h1>
					<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( 'Author: %s', 'otm-skeleton' ), '<span class="vcard">' . esc_html( get_the_author() ) . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'otm-skeleton' ), '<span>' . esc_html( get_the_date() ) . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'otm-skeleton' ), '<span>' . esc_html( get_the_date( _x( 'F Y', 'monthly archives date format', 'otm-skeleton' ) ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'otm-skeleton' ), '<span>' . esc_html( get_the_date( _x( 'Y', 'yearly archives date format', 'otm-skeleton' ) ) ) . '</span>' );

						else :
							esc_html_e( 'Archives', 'otm-skeleton' );

						endif;
					?>
		        </h1>
			</header>

	        <?php if ( have_posts() ) while ( have_posts() ) : the_post();

				get_template_part( 'partials/content', 'post' );

	        endwhile;

	        otm_paging_nav();

	        wp_reset_query(); ?>

	    </div>

		<?php get_sidebar( 'blog' ); ?>

    </section>

</div>

<?php get_footer(); ?>
