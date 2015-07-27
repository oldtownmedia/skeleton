    <footer>
        <div class="footer">

            <nav>
                <?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
            </nav>

            <p>
                &copy; Copyright <?php echo date('Y'); ?> *** client *** | All Rights Reserved | Site by <a href="http://www.oldtownmediainc.com" target="_blank">Old Town Media, Inc.</a>
            </p>

        </div>
    </footer>
    
</div> <!-- End site-container -->

<?php
	wp_footer();
?>

</body>
</html>
