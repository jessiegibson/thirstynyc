jQuery( function($) {
        'use strict';

	// Insert mobile menu icon before the primary navigation ul
	$( '<div id="menu-mobile">&#8801; Menu</div>' ).insertBefore( 'ul.menu-primary' );

	// Add .displaynone class to ul.menu-primary to hide ul.menu-primary for small screen sizes
	$( 'ul.menu-primary' ).addClass( 'displaynone' );

	// Toggle nav for mobile menu
	$('#menu-mobile').click (function(){
		$('.menu-primary').slideToggle();
		$(this).toggleClass('active');
	});

});