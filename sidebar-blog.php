<?php
/**
 * Sidebar called by post, category, and page-templates/blog.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package skeleton
 */
?>

<div class="sidebar">
	<aside>

		<h2>Categories</h2>

		<ul class='categories'>
			<?php
				$args = array(
					'hide_empty'	=> 1,
					'title_li'		=> ''
				);

				wp_list_categories( $args );
			?>
		</ul>

	</aside>
</div>
