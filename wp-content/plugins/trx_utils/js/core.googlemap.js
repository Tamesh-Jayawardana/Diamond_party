function yacht_rental_googlemap_init(dom_obj, coords) {
	"use strict";
	if (typeof YACHT_RENTAL_STORAGE['googlemap_init_obj'] == 'undefined') yacht_rental_googlemap_init_styles();
	YACHT_RENTAL_STORAGE['googlemap_init_obj'].geocoder = '';
	try {
		var id = dom_obj.id;
		YACHT_RENTAL_STORAGE['googlemap_init_obj'][id] = {
			dom: dom_obj,
			markers: coords.markers,
			geocoder_request: false,
			opt: {
				zoom: coords.zoom,
				center: null,
				scrollwheel: false,
				scaleControl: false,
				disableDefaultUI: false,
				panControl: true,
				zoomControl: true, //zoom
				mapTypeControl: false,
				streetViewControl: false,
				overviewMapControl: false,
				styles: YACHT_RENTAL_STORAGE['googlemap_styles'][coords.style ? coords.style : 'default'],
				mapTypeId: google.maps.MapTypeId.ROADMAP
			}
		};
		
		yacht_rental_googlemap_create(id);

	} catch (e) {
		
		dcl(YACHT_RENTAL_STORAGE['strings']['googlemap_not_avail']);

	};
}

function yacht_rental_googlemap_create(id) {
	"use strict";

	// Create map
	YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].map = new google.maps.Map(YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].dom, YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].opt);

	// Add markers
	for (var i in YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].markers)
		YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].markers[i].inited = false;
	yacht_rental_googlemap_add_markers(id);
	
	// Add resize listener
	jQuery(window).resize(function() {
		if (YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].map)
			YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].map.setCenter(YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].opt.center);
	});
}

function yacht_rental_googlemap_add_markers(id) {
	"use strict";
	for (var i in YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].markers) {
		
		if (YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].markers[i].inited) continue;
		
		if (YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].markers[i].latlng == '') {
			
			if (YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].geocoder_request!==false) continue;
			
			if (YACHT_RENTAL_STORAGE['googlemap_init_obj'].geocoder == '') YACHT_RENTAL_STORAGE['googlemap_init_obj'].geocoder = new google.maps.Geocoder();
			YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].geocoder_request = i;
			YACHT_RENTAL_STORAGE['googlemap_init_obj'].geocoder.geocode({address: YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].markers[i].address}, function(results, status) {
				"use strict";
				if (status == google.maps.GeocoderStatus.OK) {
					var idx = YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].geocoder_request;
					if (results[0].geometry.location.lat && results[0].geometry.location.lng) {
						YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].markers[idx].latlng = '' + results[0].geometry.location.lat() + ',' + results[0].geometry.location.lng();
					} else {
						YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].markers[idx].latlng = results[0].geometry.location.toString().replace(/\(\)/g, '');
					}
					YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].geocoder_request = false;
					setTimeout(function() { 
						yacht_rental_googlemap_add_markers(id); 
						}, 200);
				} else
					dcl(YACHT_RENTAL_STORAGE['strings']['geocode_error'] + ' ' + status);
			});
		
		} else {
			
			// Prepare marker object
			var latlngStr = YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].markers[i].latlng.split(',');
			var markerInit = {
				map: YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].map,
				position: new google.maps.LatLng(latlngStr[0], latlngStr[1]),
				clickable: YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].markers[i].description!=''
			};
			if (YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].markers[i].point) markerInit.icon = YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].markers[i].point;
			if (YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].markers[i].title) markerInit.title = YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].markers[i].title;
			YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].markers[i].marker = new google.maps.Marker(markerInit);
			
			// Set Map center
			if (YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].opt.center == null) {
				YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].opt.center = markerInit.position;
				YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].map.setCenter(YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].opt.center);				
			}
			
			// Add description window
			if (YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].markers[i].description!='') {
				YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].markers[i].infowindow = new google.maps.InfoWindow({
					content: YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].markers[i].description
				});
				google.maps.event.addListener(YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].markers[i].marker, "click", function(e) {
					var latlng = e.latLng.toString().replace("(", '').replace(")", "").replace(" ", "");
					for (var i in YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].markers) {
						if (latlng == YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].markers[i].latlng) {
							YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].markers[i].infowindow.open(
								YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].map,
								YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].markers[i].marker
							);
							break;
						}
					}
				});
			}
			
			YACHT_RENTAL_STORAGE['googlemap_init_obj'][id].markers[i].inited = true;
		}
	}
}

function yacht_rental_googlemap_refresh() {
	"use strict";
	for (var id in YACHT_RENTAL_STORAGE['googlemap_init_obj']) {
		yacht_rental_googlemap_create(id);
	}
}

function yacht_rental_googlemap_init_styles() {
	// Init Google map
	YACHT_RENTAL_STORAGE['googlemap_init_obj'] = {};
	YACHT_RENTAL_STORAGE['googlemap_styles'] = {
		'default': []
	};
	if (window.yacht_rental_theme_googlemap_styles!==undefined)
		YACHT_RENTAL_STORAGE['googlemap_styles'] = yacht_rental_theme_googlemap_styles(YACHT_RENTAL_STORAGE['googlemap_styles']);
}