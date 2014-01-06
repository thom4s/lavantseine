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
<link rel="shortcut icon" href="<?php bloginfo( 'template_url' ); ?>/img/favicon.png" />
<!--[if (IE 7)|(IE 8)]>
	  <script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/selectivizr.js"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="fb-root"></div>

<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>

	<header id="masthead" class="site-header" role="banner">

		<div class="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img class="site-logo" src="<?php bloginfo( 'template_url' ); ?>/img/home_logo_avant_seine.png" alt="<?php bloginfo( 'name' ); ?>" title=""></a>
		</div><!-- .site-branding -->

		<div id="" class="navigation-group" role="navigation">

			<ul class="home-link picto">
				<a href="<?php bloginfo('url');  ?>"><li class="go-home"></li></a>
			</ul><!-- #shortcut-navigation -->

			<nav id="shortcut-navigation" class="shortcut-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>
			</nav><!-- #shortcut-navigation -->

			<ul class="social-link picto" role="navigation">
				<a href="<?php echo FB_URL; ?>" target="_blank"><li class="go-facebook"></li></a>
				<a href="<?php echo TWITTER_URL; ?>" target="_blank"><li class="go-twitter"></li></a>
				<a href="<?php echo GOOGLEPLUS_URL; ?>" target="_blank"><li class="go-googleplus"></li></a>
				<a href="<?php echo INSTAGRAM_URL; ?>" target="_blank"><li class="go-instagram"></li></a>
				<a href="<?php echo VIDEOCHANNEL_URL; ?>" target="_blank"><li class="go-youtube"></li></a>
				<a href="<?php bloginfo('rss2_url'); ?>"><li class="go-rss"></li></a>
			</ul><!-- .social-navigation -->

			<h1 class="menu-toggle"><img src="<?php bloginfo( 'template_url' ); ?>/img/arrow.png"><?php _e( 'au <b>Menu</b>', 'lavantseine' ); ?></h1>
			<?php wp_nav_menu( array(
				'theme_location' => 'primary',
				'items_wrap' => '<ul class="clearfix" id="main-nav-list">%3$s</ul>',
				'container' => 'nav',
				'container_id'    => 'site-navigation',
				'container_class' => 'main-nav',
				'walker'=> new lavantseine_Walker_Main_Menu(),
				'depth' => 0
				));
			?>
			<!-- #site-navigation -->
		</div><!-- .navigation-group -->


		<?php if ( is_home() ) : ?>
			<?php $showAlert = get_option('showAlert', ''); ?>
			<?php if ( $showAlert == 'checked' ) : ?>
				<div id="alert" class="message">
					<p><?php echo get_option('alerteMessage', ''); ?></p>
				</div>
			<?php endif; ?>		
		<?php endif; ?>		

	</header><!-- #masthead -->
	<div id="content" class="site-content">
