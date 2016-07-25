<?php
/**
 * The template for displaying search results.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package skeleton
 */
get_header();

global $query_string;

$query_args = explode( "&", $query_string );
$search_query = array();

foreach( $query_args as $key => $string ) {
	$query_split = explode( "=", $string );
	$search_query[ $query_split[0] ] = urldecode( $query_split[1] );
}

$search = new WP_Query( $search_query );

?>

<div class="content">
	<div class="main" role="main">

	<?php if ( have_posts() ) :

		$title = get_the_title();
		$keys= explode( " ",$s );
		$title = preg_replace( '/( '.implode( '|', $keys ) .' )/iu', '<strong class="search-excerpt">\0</strong>', $title );

			echo "<header>";
	    		echo "<h1>";
					printf( esc_html__( 'Search Results for: %s', 'otm-skeleton' ), get_search_query() );
				echo "</h1>";
			echo "</header>";

			while ( have_posts() ) : the_post();

				get_template_part( 'content', 'post' );

		    endwhile;

		else :

            echo "<article>";

				echo "<h1>" . esc_html_e( 'Nothing Found', 'otm-skeleton' ) . "</h1>";

				echo "<p>" . esc_html_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'otm-skeleton' ) . "</p>";

			echo "</article>";

		endif;

		otm_paging_nav();
    ?>

	</div>

	<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>
