/**
 * Live-update changed settings in real time in the Customizer preview.
 */
( function( $ ) {
	"use strict";

	var api = wp.customize;

	if (!yacht_rental_previewer_vars['need_refresh']) {
		var $style = $('#yacht_rental-customizer-css');
		// Prepare inline styles in the preview window
		if ( $style.length == 0 ) {
			$style = $('head').append( '<'+'style type="text/css" id="yacht_rental-customizer-css"></'+'style'+'>' ).find('#yacht_rental-customizer-css');
		}
	}

	// Refresh preview without page reload when controls are changed
	api.bind( 'preview-ready', function() {
		"use strict";

		// Change css when color scheme or separate color controls are changed
		if (!yacht_rental_previewer_vars['need_refresh']) {
			api.preview.bind( 'refresh-customizer-css', function( css ) {
				"use strict";
				$style.html( css );
			} );
		}

		// Refresh preview window
		api.preview.bind( 'refresh-preview', function( ) {
			"use strict";
			yacht_rental_set_cookie(yacht_rental_previewer_vars['options_prefix']+'_compile_less', 1);
		} );

		// Any other controls are changed
		api.preview.bind( 'refresh-other-controls', function( obj ) {
			"use strict";
			var id = obj.id, val = obj.value;

			if (id == 'blogname') {
				$('.logo .logo_text').html( val );

			} else if (id == 'blogdescription') {
				$( '.logo .logo_slogan' ).html( val );

			}
		} );
				
	} );

} )( jQuery );
