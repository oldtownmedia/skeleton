<?php
/**
 * The template for displaying the site header.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package skeleton
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link href="<?php echo esc_url( get_template_directory_uri() . '/favicon.ico' ); ?>" rel="shortcut icon">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div class="site-container">

	<a id="menu-toggle" href="#mobile-nav" class="nav-icon trigger"><span></span></a>

    <header class="site-header">

        <div class="logo" itemscope itemtype="http://schema.org/Organization">

            <a itemprop="url" href="<?php echo esc_attr( site_url() ); ?>">
            	<img itemprop="logo" src="<?php echo esc_url( get_template_directory_uri() . '/images/logo.png' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
            </a>

        </div>

        <div class="contactinfo">

        	<?php get_template_part( 'partials/social-icons' ); ?>

        </div>

    </header>

    <nav>
    	<div class="nav">

        	<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>

		</div>
    </nav>

  	<div class="banner">

  		<?php

	  	if ( is_front_page() ) {
  			if ( function_exists( 'soliloquy' ) ) { soliloquy( '25' ); }
  		} else {
  			if ( get_the_post_thumbnail() != '' && !is_single() && !is_category() ) {
  	        	the_post_thumbnail();
  	        }
  		}

  		?>

  	</div>
