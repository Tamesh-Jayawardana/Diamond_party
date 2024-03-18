/* global jQuery:false */
/* global YACHT_RENTAL_STORAGE:false */


// Theme-specific first load actions
//==============================================
function yacht_rental_theme_ready_actions() {
	"use strict";
	// Put here your init code with theme-specific actions
	// It will be called before core actions
	
	setTimeout(function () {
		maxh();
		maxhprice();
		maxhrecentnews();
		maxhscteam2();
	}, 1000);
	
}


// Theme-specific scroll actions
//==============================================
function yacht_rental_theme_scroll_actions() {
	"use strict";
	// Put here your theme-specific code with scroll actions
	// It will be called when page is scrolled (before core actions)
}


// Theme-specific resize actions
//==============================================
function yacht_rental_theme_resize_actions() {
	"use strict";
	// Put here your theme-specific code with resize actions
	// It will be called when window is resized (before core actions)
	
	setTimeout(function () {
		maxh();
		maxhprice();
		maxhrecentnews();
		maxhscteam2();
	}, 500);
	
	
	
	
}


// Theme-specific shortcodes init
//=====================================================
function yacht_rental_theme_sc_init(cont) {
	"use strict";
	// Put here your theme-specific code to init shortcodes
	// It will be called before core init shortcodes
	// @param cont - jQuery-container with shortcodes (init only inside this container)
}


// Theme-specific post-formats init
//=====================================================
function yacht_rental_theme_init_post_formats() {
	"use strict";
	// Put here your theme-specific code to init post-formats
	// It will be called before core init post_formats when page is loaded or after 'Load more' or 'Infinite scroll' actions

	// Tribe Events buttons decoration (add 'sc_button' class)
	jQuery('a.tribe-events-read-more,.tribe-events-button,.tribe-events-nav-previous a,.tribe-events-nav-next a,.tribe-events-widget-link a,.tribe-events-viewmore a')
		.addClass('sc_button sc_button_style_filled');

	// All other buttons decoration (add 'hover' class)
	if (YACHT_RENTAL_STORAGE['button_hover'] && YACHT_RENTAL_STORAGE['button_hover']!='default') {
		jQuery('button:not(.search_submit):not([class*="sc_button_hover_"]),\
				.sc_button:not(.sc_button_style_border):not([class*="sc_button_hover_"]),\
				#buddypress a.button:not([class*="sc_button_hover_"])'
				).addClass('sc_button_hover_'+YACHT_RENTAL_STORAGE['button_hover']);
		if (YACHT_RENTAL_STORAGE['button_hover']!='arrow')
			jQuery('input[type="submit"]:not([class*="sc_button_hover_"]),\
					input[type="button"]:not([class*="sc_button_hover_"]),\
					.isotope_filters_button,\
					.scroll_to_top:not([class*="sc_button_hover_"]),\
					.sc_slider_prev:not([class*="sc_button_hover_"]),.sc_slider_next:not([class*="sc_button_hover_"]),\
					.tagcloud > a:not([class*="sc_button_hover_"])'
					).addClass('sc_button_hover_'+YACHT_RENTAL_STORAGE['button_hover']);
	}

	// Mark field as 'filled' on keypress
	jQuery('[class*="sc_input_hover_"] input, [class*="sc_input_hover_"] textarea').each(function() {
		if (jQuery(this).val()!='')
			jQuery(this).addClass('filled');
		else
			jQuery(this).removeClass('filled');
	});
	jQuery('[class*="sc_input_hover_"] input, [class*="sc_input_hover_"] textarea').on('blur', function() {
		if (jQuery(this).val()!='')
			jQuery(this).addClass('filled');
		else
			jQuery(this).removeClass('filled');
	});
}


// Theme-specific GoogleMap styles
//=====================================================
function yacht_rental_theme_googlemap_styles($styles) {
	"use strict";
	// Put here your theme-specific code to add GoogleMap styles
	// It will be called before GoogleMap init when page is loaded
	$styles['greyscale'] = [
    	{ "stylers": [
        	{ "saturation": -100 }
            ]
        }
	];
	$styles['inverse'] = [
		{ "stylers": [
			{ "invert_lightness": true },
			{ "visibility": "on" }
			]
		}
	];
	$styles['simple'] = [
    	{ stylers: [
        	{ hue: "#00ffe6" },
            { saturation: -20 }
			]
		},
		{ featureType: "road",
          elementType: "geometry",
          stylers: [
			{ lightness: 100 },
           	{ visibility: "simplified" }
            ]
		},
		{ featureType: "road",
          elementType: "labels",
          stylers: [
          	{ visibility: "off" }
            ]
		}
	];
	$styles['apple'] = [
		{ "featureType": "landscape.man_made",
		  "elementType": "geometry",
		  "stylers": [
			{"color":"#f7f1df"}
			]
		},
		{ "featureType": "landscape.natural",
		  "elementType": "geometry",
		  "stylers": [
		  	{"color":"#d0e3b4"}
			]
		},
		{ "featureType": "landscape.natural.terrain",
		  "elementType": "geometry",
		  "stylers": [
		  	{"visibility":"off"}
			]
		},
		{ "featureType": "poi",
		  "elementType": "labels",
		  "stylers": [
		  	{"visibility":"off"}
			]
		},
		{ "featureType": "poi.business",
		  "elementType": "all",
		  "stylers": [
		  	{"visibility":"off"}
			]
		},
		{ "featureType": "poi.medical",
		  "elementType": "geometry",
		  "stylers": [
		  	{"color":"#fbd3da"}
			]
		},
		{ "featureType": "poi.park",
		  "elementType": "geometry",
		  "stylers": [
		  	{"color":"#bde6ab"}
			]
		},
		{ "featureType": "road",
		  "elementType": "geometry.stroke",
		  "stylers": [
		  	{"visibility":"off"}
			]
		},
		{ "featureType": "road",
		  "elementType": "labels",
		  "stylers": [
		  	{"visibility":"off"}
			]
		},
		{ "featureType": "road.highway",
		  "elementType": "geometry.fill",
		  "stylers": [
		  	{"color":"#ffe15f"}
			]
		},
		{ "featureType": "road.highway",
		  "elementType":"geometry.stroke",
		  "stylers": [
		  	{"color":"#efd151"}
		  	]
		},
		{ "featureType": "road.arterial",
		  "elementType": "geometry.fill",
		  "stylers": [
		  	{"color":"#ffffff"}
			]
		},
		{ "featureType": "road.local",
		  "elementType": "geometry.fill",
		  "stylers": [
		  	{"color":"black"}
			]
		},
		{ "featureType": "transit.station.airport",
		  "elementType": "geometry.fill",
		  "stylers": [
		  	{"color":"#cfb2db"}
			]
		},
		{ "featureType": "water",
		  "elementType": "geometry",
		  "stylers": [
		  	{"color":"#a2daf2"}
			]
		}
	];
	return $styles;
}


jQuery(document).ready(function(){  
	"use strict";
    jQuery(".boatsCheckBox").change(function(){
        if(jQuery(this).is(":checked")){  // If the checkbox is checked,
            jQuery(this).parent("label").addClass("boatsLabelCheckBoxSelected"); // add LabelSelected class label 
        }else{   
            jQuery(this).parent("label").removeClass("boatsLabelCheckBoxSelected");  // otherwise remove it
        }
    });  
}); 


function maxh() {
	"use strict";
	if (jQuery('.maxHBox').length>0) {
		jQuery('.maxHBox').each(function (){
			"use strict";
			var maxH = 0;
			jQuery(this).find('.maxHBoxItem').each(function (){
				"use strict";
				if ( jQuery(this).height() > maxH ) {
					maxH = jQuery(this).height();
				}
			});
			jQuery(this).find('.maxHBoxItem').height(maxH);
			jQuery(this).find('.maxHBoxItem .sc_column_item_inner').height(maxH);
			jQuery(this).find('.maxHBoxItem .sc_section_overlay').height(maxH);
		});
	}
}

function maxhprice() {
	"use strict";
	if (jQuery('.maxHBoxPrice').length>0) {
		jQuery('.maxHBoxPrice').each(function (){
			"use strict";
			var maxHPriceTitle = 0;
			jQuery(this).find('.sc_price_block_description').each(function (){
				"use strict";
				if ( jQuery(this).height() > maxHPriceTitle ) {
					maxHPriceTitle = jQuery(this).height();
				}
			});
			jQuery(this).find('.sc_price_block_description').height(maxHPriceTitle);
		});
	}
}

function maxhrecentnews() {
	"use strict";
	if (jQuery('.sc_recent_news_style_news-magazine').length>0) {
		jQuery('.sc_recent_news_style_news-magazine').each(function (){
			"use strict";
			var maxHPriceTitle = 0;
			jQuery(this).find('.column-1_2').each(function (){
				"use strict";
				if ( jQuery(this).height() > maxHPriceTitle ) {
					maxHPriceTitle = jQuery(this).height();
				}
			});
			jQuery(this).find('.column-1_2').height(maxHPriceTitle);
		});
	}
}
function maxhscteam2() {
	"use strict";
	if (jQuery('.sc_team_style_team-2').length>0) {
		jQuery('.sc_team_style_team-2').each(function (){
			"use strict";
			var maxHPriceTitle = 0;
			jQuery(this).find('.sc_team_item_content').each(function (){
				"use strict";
				if ( jQuery(this).height() > maxHPriceTitle ) {
					maxHPriceTitle = jQuery(this).height();
				}
			});
			jQuery(this).find('.sc_team_item_content').height(maxHPriceTitle);
		});
	}
}




jQuery(function() {
	"use strict";
	
	var js_length_min = parseInt(jQuery( ".bs_length_min" ).val());
	var js_length_max = parseInt(jQuery( ".bs_length_max" ).val());
	var js_length_big = parseInt(jQuery( ".bs_length_big" ).val());
	jQuery( "#slider-range-area" ).slider({
		range: true,
		min: 0,
		max: js_length_big,
		step: 5,
		values: [ js_length_min, js_length_max ],
		slide: function( event, ui ) {
			
			jQuery( ".bs_length .bs_length_min" ).val(ui.values[0]);
			jQuery( ".bs_length .bs_length_max" ).val(ui.values[1]);
			
			if ( (ui.values[0]==0) && (ui.values[1]==js_length_big) ) {
				jQuery( ".bs_length_info_value" ).html( 'Any' );
			} else {
				jQuery( ".bs_length_info_value" ).html( ui.values[0] + " - " + ui.values[1] + " M" );
			}
		}
	});
	if ( (js_length_min==0) && (js_length_max==js_length_big) ) {
		jQuery( ".bs_length_info_value" ).html( 'Any' );
	} else {
		jQuery( ".bs_length_info_value" ).html( js_length_min + " - " + js_length_max + " M" );
	}
});


jQuery(function() {
	"use strict";
	
	var js_price_min = parseInt(jQuery( ".bs_price_min" ).val());
	var js_price_max = parseInt(jQuery( ".bs_price_max" ).val());
	var js_price_big = parseInt(jQuery( ".bs_price_big" ).val());
	jQuery( "#slider-range-price" ).slider({
		range: true,
		min: 0,
		max: js_price_big,
		step: 100,
		values: [ js_price_min, js_price_max ],
		slide: function( event, ui ) {
			
			jQuery( ".bs_price .bs_price_min" ).val(ui.values[0]);
			jQuery( ".bs_price .bs_price_max" ).val(ui.values[1]);
			
			if ( (ui.values[0]==0) && (ui.values[1]==js_price_big) ) {
				jQuery( ".bs_price_info_value" ).html( 'Any' );
			} else {
				jQuery( ".bs_price_info_value" ).html( "$" + ui.values[0] + " - $" + ui.values[1] );
			}
		}
	});
	if ( (js_price_min==0) && (js_price_max==js_price_big) ) {
		jQuery( ".bs_price_info_value" ).html( 'Any' );
	} else {
		jQuery( ".bs_price_info_value" ).html( "$" + js_price_min + " - $" + js_price_max );
	}
});
