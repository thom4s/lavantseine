

jQuery(function($) {
	$(document).ready(function() {


		// Walker Menu Navigation
		var $itemsWithChildren = $('.menu-item-has-children > a');
		var $subMenu = $('.sub-nav-shadow');

		$itemsWithChildren.on('click', function(event) {

			event.preventDefault();
			
			$subMenu.each(function() {
				var wrap = $(this);
				wrap.hide();
			});

			$(this).parent().find('.sub-nav-shadow').toggle();
		});
		

		// Display Event distribution & mentions
		$('#display-entry-mentions a').on('click', function(event) {
			event.preventDefault();
			$('#inner-entry-mentions').toggle('fast');
		});

		// Slide Home
		// https://github.com/wandoledzep/bxslider-4
		$('.bxslider-no-controls').bxSlider({
		  pager: false,
		  controls: false,
		  auto: true,
		  adaptiveHeight: true,
		  infiniteLoop: true
		});

		// Slide posts
		// https://github.com/wandoledzep/bxslider-4
		$('.bxslider-with-controls').bxSlider({
		  pager: false,
		  controls: true,
		  auto: false,
		  adaptiveHeight: false,
		  infiniteLoop: true,
		  nextText: ' > ', 
		  prevText: ' < '
		});

		$('.slide a').on('click', (function( event ) {
			event.preventDefault();
		}));

	});
});



/**
 * Social Share Buttons Scripts
 *
 */
//Facebook
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

//Twitter
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');


//GooglePlus
window.___gcfg = {lang: 'fr'};
(function() {
   var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
   po.src = 'https://apis.google.com/js/platform.js';
   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
 })();



/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */
( function() {
	var container, button, menu;

	container = document.getElementById( 'site-navigation' );
	if ( ! container )
		return;

	button = container.getElementsByTagName( 'h1' )[0];
	if ( 'undefined' === typeof button )
		return;

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	if ( -1 === menu.className.indexOf( 'nav-menu' ) )
		menu.className += ' nav-menu';

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) )
			container.className = container.className.replace( ' toggled', '' );
		else
			container.className += ' toggled';
	};
} )();



/**
 * skip-link-focus.js
 *
 * Skip link focus (_s package)
 */

( function() {
	var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
	    is_opera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
	    is_ie     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

	if ( ( is_webkit || is_opera || is_ie ) && 'undefined' !== typeof( document.getElementById ) ) {
		var eventMethod = ( window.addEventListener ) ? 'addEventListener' : 'attachEvent';
		window[ eventMethod ]( 'hashchange', function() {
			var element = document.getElementById( location.hash.substring( 1 ) );

			if ( element ) {
				if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) )
					element.tabIndex = -1;

				element.focus();
			}
		}, false );
	}
})();


