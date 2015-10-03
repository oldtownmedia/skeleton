<?php
/*
 * Custom pagination functions & includes.
 *
 * @package: skeleton
 */


/**
 * Display navigation to next/previous pages when applicable.
 * Used within single posts.
 *
 * @return void
 */
function otm_paging_nav(){
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ){
		return;
	}
	?>
	<nav class="navigation paging-navigation">
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'otm-skeleton' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'otm-skeleton' ) ); ?></div>
			<?php endif; ?>

		</div>
	</nav>
	<?php
}

/**
 * Display navigation to next/previous pages when applicable.
 * Used on post listing pages.
 *
 * @return void
 */
function otm_post_nav(){

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ){
		return;
	}
	?>
	<nav class="navigation post-navigation">
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'otm-skeleton' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'otm-skeleton' ) );
			?>
		</div>
	</nav>
	<?php
}