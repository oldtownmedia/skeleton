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
			<?php wp_list_categories( 'hide_empty=1&title_li=' );?>
		</ul>

	</aside>
</div>
