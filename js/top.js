/**
 * Toggle visibility of the top link
 *
 */
jQuery(function( $ ){

	var app = {

		init: function() {
			$( document ).on( 'scroll', app.scroll );
			app.scroll();
		},

		scroll: function() {
			var $toplink = $('#toplink');

			if ( $(document).scrollTop() > 50 ) {
				$toplink.addClass('active');
			} else {
				$toplink.removeClass('active');
			}
		}
	};

	$( document ).ready( app.init );

});
