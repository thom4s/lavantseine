<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package lavantseine
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>

	<header id="masthead" class="site-header" role="banner">


		<div class="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img class="site-logo" src="<?php bloginfo( 'template_url' ); ?>/img/home_logo_avant_seine.png" alt="<?php bloginfo( 'name' ); ?>" title=""></a>
		</div><!-- .site-branding -->


		<div id="" class="navigation-group" role="navigation">

			<ul class="home-link picto">
				<li class="go-home"></li>
			</ul><!-- #shortcut-navigation -->

			<nav id="shortcut-navigation" class="shortcut-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>
			</nav><!-- #shortcut-navigation -->

			<ul class="social-link picto" role="navigation">
				<li class="go-facebook"></li>
				<li class="go-twitter"></li>
				<li class="go-googleplus"></li>
				<li class="go-instagram"></li>
				<li class="go-youtube"></li>
				<li class="go-rss"></li>
			</ul><!-- .social-navigation -->

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<h1 class="menu-toggle"><?php _e( 'Menu', 'lavantseine' ); ?></h1>
				<!-- <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'lavantseine' ); ?></a> -->
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #site-navigation -->

		</div><!-- .shortcut-navigation-group -->


	</header><!-- #masthead -->
	<div id="content" class="site-content">
