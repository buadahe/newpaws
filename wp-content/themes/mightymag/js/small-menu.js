/**
 * Handles toggling the main navigation menu for small screens.
 */
 
jQuery( document ).ready( function( $ ) {
	var $masthead = $( '.nav-wrap' ),
	    timeout = false;

	$.fn.smallMenu = function() {
		$masthead.find( '.site-navigation' ).removeClass( 'main-navigation' ).addClass( 'main-small-navigation' );
		$masthead.addClass('nav-small-wrap');

	};

	// Check viewport width on first load.
	if ( $( window ).width() < 767 )
		$.fn.smallMenu();

	// Check viewport width when user resizes the browser window.
	$( window ).resize( function() {
		var browserWidth = $( window ).width();

		if ( false !== timeout )
			clearTimeout( timeout );

		timeout = setTimeout( function() {
			if ( browserWidth < 767 ) {
				$.fn.smallMenu();
			} else {
				$masthead.find( '.site-navigation' ).removeClass( 'main-small-navigation' ).addClass( 'main-navigation' );
				$masthead.find( '.site-navigation h1' ).removeClass( 'menu-toggle' ).addClass( 'assistive-text' );
				$masthead.find( '.menu' ).removeAttr( 'style' );
				$masthead.removeClass('nav-small-wrap');
			}
		}, 200 );
	});


/**
 * Hide menu toggle upon scrolling
 */
	
	(function( $ ) {
		$(function() {
			var $menu = $( ".menu-toggle" );
	
				$( window ).scroll(function() {
					$menu.removeClass('slideInLeft').addClass( 'slideOutLeft' );
					clearTimeout( $.data( this, "scrollCheck" ) );
					$.data( this, "scrollCheck", setTimeout(function() {
						$menu.removeClass('slideOutLeft').addClass( 'slideInLeft' );
					}, 400) );
	
				});
	
		});
	
	})( jQuery );
	
/**
 * Place Footer logo on sticky nav @since MM 1.1
 */
 
	var footerLogo = $('#footer-logo img').attr('src');
	
	$("#nav-clone .mgm-logo img").attr("src",footerLogo);

});

