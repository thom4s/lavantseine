<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package lavantseine
 */
?>

	</div><!-- #content -->

	<footer id="mastfooter" class="site-footer" role="contentinfo">
		<?php get_sidebar( 'footer-widgets' ); ?>

		<div id="inner-footer-branding" class="site-info">
			<ul>
				<li class="colombes-logo"></li>
				<li class="haut-de-seine-logo"></li>
			</ul>

		</div><!-- #inner-footer-branding -->
	</footer><!-- #mastfooter -->
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>