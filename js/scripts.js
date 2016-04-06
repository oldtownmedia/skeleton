(function($) {
	jQuery(document).ready(function() {

		// Open/close menu functions
		function openMenu( path ){
		    path.children('ul').css({
		    	'display': 'block',
				'visibility': 'visible',
				'opacity': '1',
				'z-index': '200'
		    });
		    path.children('ul').show();
		    path.addClass( 'open-parent' );
		}

		function closeMenu(path){
		    path.find('ul').css({
				'display': 'none',
				'visibility': 'hidden',
				'opacity': '0'
			});
		}


		/*
		 * Imitate hover effect when a parent manu item is clicked on a touch
		 * screen for the full-size menu. i.e.: Initiante drop-down
		 */

		if ( $(window).innerWidth() > 700 ){

			// detect touch
			if('ontouchstart' in window || (navigator.maxTouchPoints > 0) || (navigator.msMaxTouchPoints > 0)){
			    document.documentElement.className += ' touch';
			}

			// touch counters
			jQuery('.touch .menu-item-has-children').on('mouseenter', function(){
				jQuery(this).data('touch', 0);
			});

			jQuery('.touch .menu-item-has-children').on('click', function(){
				jQuery(this).data('touch', jQuery(this).data('touch') + 1);
				if(jQuery(this).data('touch') < 0){
			        return false;
			    }
			});

			jQuery('html').on('click', function(){
				jQuery('.touch .menu-item-has-children').data('touch', 0);
			});

			// menu events
			jQuery('.touch .menu-item-has-children').on('mouseenter', function(){
			    openMenu( jQuery(this) );
			});

			jQuery('.touch .menu-item-has-children').on('mouseleave', function(){
			    closeMenu( jQuery(this) );
			});

			jQuery('.touch .menu-item-has-children').on('click', function(e){
			    if(e.stopPropagation){
			        e.stopPropagation();
			    }else{
			        e.cancelBubble = true;
			    }
			});

			// Trigger events on load as a precaution
			jQuery('.touch .menu-item-has-children').trigger('mouseenter');
			jQuery('.touch .menu-item-has-children').trigger('mouseleave');

		}


		/*
		 * Open off-canvas responsive menu on small mobile screens
		 */
		jQuery('#menu-toggle').click(function (e) {
			jQuery('body').toggleClass('menu-shown');
			e.preventDefault();
	    });

	    jQuery('.click-toggle-menu-off').click(function(e){
		    jQuery( 'body' ).toggleClass('menu-shown');
		    e.preventDefault();
		});


		/*
		 * Prevent empty search field from being submitted
		 */
		jQuery(document).ready(function(){
		    jQuery('.searchform').submit(function(e) {
		        var s = jQuery( this ).find('#s');
		        if (!s.val()) {
		            e.preventDefault();
		            alert( themeInfo.searchStr );
		            jQuery('#s').focus();
		        }
		    });
		});

	});
})( jQuery );