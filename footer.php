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

<?php get_sidebar(); ?>

	<footer id="mastfooter" class="site-footer transparent-background" role="contentinfo">
		<?php get_sidebar( 'footer-widgets' ); ?>
		<div class="clearfix"></div>
	</footer><!-- #mastfooter -->
	
</div><!-- #page -->

<?php wp_footer(); ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46361582-1', 'lavant-seine.com');
  ga('send', 'pageview');

</script>

</body>
</html>