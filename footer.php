<?php
/**
 * The template for displaying the site footer.
 *
 * Closes off the site and includes hooks for footer-called scripts & the admin bar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package skeleton
 */
?>
    <footer class="site-footer">

        <nav>
            <?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
        </nav>

        <p>
            &copy; Copyright <?php echo esc_html( date( 'Y' ) ); ?> *** client *** | All Rights Reserved | Site by <a href="https://oldtownmediainc.com" target="_blank">Old Town Media, Inc.</a>
        </p>

    </footer>

</div> <!-- End site-container -->

<div class="click-toggle-menu-off"></div>
<div class="offcanvas-nav">

	<?php
		wp_nav_menu( array( 'theme_location' => 'header-menu' ) );
	?>

</div>

<?php
	wp_footer();
?>

</body>
</html>
