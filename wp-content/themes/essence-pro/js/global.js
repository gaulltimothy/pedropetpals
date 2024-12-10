/**
 * This script adds the jquery effects to the Essence Pro Theme.
 *
 * @package Essence\JS
 * @author StudioPress
 * @license GPL-2.0-or-later
 */


<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P8ZC4XX8"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


( function( $ ) {
	$( 'html' ).addClass( 'js' );

	/**
	 * Toggle the off-screen menu.
	 *
	 * @since 1.0.0
	 */
	function toggleMenu() {
		$( 'body' ).toggleClass( 'no-scroll' );
		$( '.off-screen-menu' ).fadeToggle();
	}

	/**
	 * Close the off-screen menu at mobile screen widths.
	 *
	 * Useful during browser resize.
	 *
	 * @since 1.0.0
	 */
	function closeMenuIfMobile() {
		var isMobile = 'block' === $( '.menu-toggle' ).css( 'display' );
		var menuOpen = $( 'body' ).hasClass( 'no-scroll' );
		if ( isMobile && menuOpen ) {
			toggleMenu();
		}
	}

	$( function() {
		$( '.toggle-off-screen-menu-area' ).click( toggleMenu );
		$( window ).resize( closeMenuIfMobile );
	});

	// Add Keyboard Accessibility.
	$( function() {
		$( '.after-content-featured .entry *' )
			.focus( function() {
				$( this )
					.closest( '.entry' )
					.addClass( 'focused' );
			})
			.blur( function() {
				$( this )
					.closest( '.entry' )
					.removeClass( 'focused' );
			});
	});
}( jQuery ) );
