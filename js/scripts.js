

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


		// Search Form Filter
		var $filterform = $('.search-form-filter');
		var $checkbox = $filterform.find(':checkbox');
		var $url = document.location.href;

      $checkbox.on(
        'click',
        function(event) {
          $that = $(this);
          $input_value = $that.attr('value');
          document.location.href = $input_value;
      });


    // Toggle Menu 
    $('.menu-toggle').on('click', function() {
      $('#site-navigation').toggle('fast');
      $(this).find('img').toggleClass('rotate');
    });


    // Unchecked EventToCome
    $('#prog-filters form select').on('change', function() {
      if ( $('input[name=eventToCome]').is(':checked') ) {
        $('input[name=eventToCome]').attr('checked', false);
      }
    });

    // Sidebar & Footer Bug (on absolute position)
    $pageHeight = $('#page').height();
    $footerHeight = $('#mastfooter').height() + 75;
    $sidebarHeight = $('#secondary').height();
    $totalHeight = $sidebarHeight + $footerHeight;
    if ( ($pageHeight - $footerHeight + 75) <= $sidebarHeight ) {
      $('#page').height($totalHeight);
      $('#mastfooter').css('position','absolute').css('bottom', '0');
    }

    // Hide submit btn value for inline searchform
    $('.search-format-inline').find('input[type=submit]').attr('value', '');

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





    /* Caches the user-input data from the targeted form, stores it in the cookies 
     * and fetches back to the form when requested or needed. 
     */
    var formCache = (function() {
      var _form = null, 
            _formData = [],
            _strFormElements = "input[type='text']," + 
                        "input[type='checkbox']," + 
                        "input[type='radio']," + 
                        //"input[type='password']," +  //leave password field out 
                        "input[type='hidden']," + 
                        //"input[type='image']," + 
                        "input[type='file']," + 
                        "select," + 
                        "textarea";
        
        function _warn() {
            console.log('formCache is not initialized.');
        }
    
        return {
            /* Initializes the formCache with a target form (id). 
             * You can pass any container id for the formId parameter, formCache will 
             * still look for form elements inside the given container. If no form id 
             * is passed, it will target the first <form> element in the DOM. 
             */
            init: function(formId)
            {
                var f = (typeof(formId) === 'undefined' || formId === null || jQuery.trim(formId) === '') ? 
                    jQuery('form').first() :  jQuery('#' + formId);
                _form = f.length > 0 ? f : null;
                console.log(_form);
            },
            /* Saves form data to cookies.
             */
            save: function()
            {
                if (_form === null) { _warn(); return; }
                
                _form
                .find(_strFormElements)
                .each(function() {
                    _formData.push( jQuery(this).attr('id') + ':' + formCache.getFieldValue(jQuery(this)) );
                });
                docCookies.setItem('formData', _formData.join(), 31536e3); //1 year expiration (persistent)
                console.log('Cached form data:', _formData);
            },
            /* Fills out the form elements from the data previously stored in the cookies.
             */
            fetch: function()
            {
                var $url = document.location.href;
                $url = "" + $url;
                console.log($url);

                if (_form === null) { _warn(); return; }
                
                if (!docCookies.hasItem('formData')) return;
                var fd = _formData.length < 1 ? docCookies.getItem('formData').split(',') : _formData;

                if( $url.indexOf('/rdv/') != -1 || $url.indexOf('/discipline/') != -1) {
                } else {
                  jQuery('#awpqsf_id_btn').click();
                }

                jQuery.each(fd, function(i, item)
                {
                    var s = item.split(':');
                    var elem = $('#' + s[0]);
                    formCache.setFieldValue(elem, s[1]);
                });
 

            },
            /* Sets the value of the specified form field from previously stored data.
             */
            setFieldValue: function(elem, value)
            {
                if (_form === null) { _warn(); return; }
                
                if (elem.is('input:text') || elem.is('input:hidden') || elem.is('input:image') ||
                        elem.is('input:file') || elem.is('textarea')) {
                    elem.val(value);
                } else if (elem.is('input:checkbox') || elem.is('input:radio')) {
                    elem.prop('checked', value);
                } else if (elem.is('select')) {
                    elem.prop('selectedIndex', value);
                }



            },
            /* Gets the previously stored value of the specified form field.
             */
            getFieldValue: function(elem)
            {
                if (_form === null) { _warn(); return; }
                
                if (elem.is('input:text') || elem.is('input:hidden') || elem.is('input:image') ||
                    elem.is('input:file') || elem.is('textarea')) {
                        return elem.val();
                    } else if (elem.is('input:checkbox') || elem.is('input:radio')) {
                        return elem.prop('checked');
                    } else if (elem.is('select')) {
                        return elem.prop('selectedIndex');
                    }
                else return null;
            },
            /* Clears the cache and removes the previously stored form data from cookies.
             */
            clear: function()
            {
                _formData = [];
                docCookies.removeItem('formData');
            },
            /* Clears all the form fields. 
             * This is different from form.reset() which only re-sets the fields 
             * to their initial values.
             */
            clearForm: function()
            {
                _form
                .find(_strFormElements)
                .each(function() {
                    var elem = $(this);
                    if (elem.is('input:text') || elem.is('input:password') || elem.is('input:hidden') || 
                        elem.is('input:image') || elem.is('input:file') || elem.is('textarea')) {
                        elem.val('');
                    } else if (elem.is('input:checkbox') || elem.is('input:radio')) {
                        elem.prop('checked', false);
                    } else if (elem.is('select')) {
                        elem.prop('selectedIndex', -1);
                    }
                });
            }
        };
    })();


jQuery(function($) {

    //Initialize and fetch form data (if exists) when we load the form-page back
    $(document).ready(function() {
        
        $("form").submit(function () {  }); // prevent form submit
        formCache.init('ajax_wpqsffrom_143');
        formCache.fetch();

        formCache.init('ajax_wpqsffrom_46');
        formCache.fetch();
        
    });
    
    //Save form data right before we unload the form-page
    $(window).bind('beforeunload', function() {
        formCache.save();
        //return false;
    });

});


//From Mozilla (https://developer.mozilla.org/en-US/docs/DOM/document.cookie)
var docCookies = {
  getItem: function (sKey) {
    if (!sKey || !this.hasItem(sKey)) { return null; }
    return unescape(document.cookie.replace(new RegExp("(?:^|.*;\\s*)" + escape(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=\\s*((?:[^;](?!;))*[^;]?).*"), "$1"));
  },
  setItem: function (sKey, sValue, vEnd, sPath, sDomain, bSecure) {
    if (!sKey || /^(?:expires|max\-age|path|domain|secure)$/i.test(sKey)) { return; }
    var sExpires = "";
    if (vEnd) {
      switch (vEnd.constructor) {
        case Number:
          sExpires = vEnd === Infinity ? "; expires=Tue, 19 Jan 2038 03:14:07 GMT" : "; max-age=" + vEnd;
          break;
        case String:
          sExpires = "; expires=" + vEnd;
          break;
        case Date:
          sExpires = "; expires=" + vEnd.toGMTString();
          break;
      }
    }
    document.cookie = escape(sKey) + "=" + escape(sValue) + sExpires + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "") + (bSecure ? "; secure" : "");
  },
  removeItem: function (sKey, sPath) {
    if (!sKey || !this.hasItem(sKey)) { return; }
    document.cookie = escape(sKey) + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT" + (sPath ? "; path=" + sPath : "");
  },
  hasItem: function (sKey) {
    return (new RegExp("(?:^|;\\s*)" + escape(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=")).test(document.cookie);
  },
  keys: /* optional method: you can safely remove it! */ function () {
    var aKeys = document.cookie.replace(/((?:^|\s*;)[^\=]+)(?=;|$)|^\s*|\s*(?:\=[^;]*)?(?:\1|$)/g, "").split(/\s*(?:\=[^;]*)?;\s*/);
    for (var nIdx = 0; nIdx < aKeys.length; nIdx++) { aKeys[nIdx] = unescape(aKeys[nIdx]); }
    return aKeys;
  }
};



jQuery(function($) {
  $(document).ready(function() {
      // Sidebar & Footer Bug (on absolute position)
      $pageHeight = $('#page').height();
      $footerHeight = $('#mastfooter').height() + 75;
      $sidebarHeight = $('#secondary').height();
      $totalHeight = $sidebarHeight + $footerHeight;
      if ( ($pageHeight - $footerHeight + 75) <= $sidebarHeight ) {
        $('#page').height($totalHeight);
        $('#mastfooter').css('position','absolute').css('bottom', '0');
      }
  });
});


