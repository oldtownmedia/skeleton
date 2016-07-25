<?php
/**
 * The template for displaying looped posts.
 *
 * Used in archive, search, page-templates/blog
 *
 * @package skeleton
 */

echo "<article class='blog'>";

	echo "<header>";
    	echo "<h2><a href='" . esc_url( get_permalink() ) . "'>" . esc_html( get_the_title() ) . "</a></h2>";
    echo "</header>";

    echo "<p><time datetime='" . esc_attr( get_the_time( 'Y-m-d' ) ) . "' pubdate='pubdate'>" . esc_html( get_the_time( 'l, F j, Y' ) ) . "</time></p>";

    the_post_thumbnail();

    echo apply_filters( 'the_content', wp_trim_words( get_the_content(), '50' ) );

    echo "<a href='" . esc_url( get_permalink() ) . "' class='button' role='button'>Read More</a>";

echo "</article>";
