jQuery(window).on("load", function() {
	"use strict";
	/* -----------------------------------------
	FlexSlider Init
	----------------------------------------- */
	var slider = jQuery("#homeslider");

	if ( slider.length ) {
		slider.flexslider({
			animation: ThemeOption.slider_effect,
			direction: ThemeOption.slider_direction,
			slideshow: Boolean(ThemeOption.slider_autoslide),
			slideshowSpeed: Number(ThemeOption.slider_speed),
			animationSpeed: Number(ThemeOption.slider_duration),
			controlNav: false
		});
	}

	jQuery(".testimonial-sld").flexslider({
		controlNav: false,
		directionNav: false,
		slideshowSpeed: 7000
	});

});

jQuery(document).ready(function($) {
	"use strict";

	$('body').fitVids();

	/* -----------------------------------------
	Main Navigation Init
	----------------------------------------- */
	$('ul#navigation').superfish({
		delay:       300,
		animation:   {opacity:'show'},
		speed:       'fast',
		dropShadows: false
	});

	/* -----------------------------------------
	Responsive Menus Init with jPanelMenu
	----------------------------------------- */
	var jPM = $.jPanelMenu({
		menu: '#navigation',
		trigger: '.menu-trigger',
		excludedPanelContent: "style, script, #wpadminbar",
		animated: false
	});

	var jRes = jRespond([
		{
			label: 'mobile',
			enter: 0,
			exit: 768
		}
	]);

	jRes.addFunc({
		breakpoint: 'mobile',
		enter: function() {
			jPM.on();
		},
		exit: function() {
			jPM.off();
		}
	});

	/* -----------------------------------------
	 Map Init
	 ----------------------------------------- */
	if ( $('#map_canvas').length ) {
		map_init('map_canvas');
	}

	/* -----------------------------------------
		 Reservation Datepicker
		 ----------------------------------------- */
		var resDate = jQuery('#ci_date');
		var resInlineDate = jQuery('.inline-datepicker');
		if ( resDate.length || resInlineDate.length ) {
			if( jQuery( window ).width() < 767 ) {
				resInlineDate.datetimepicker({
					ampm: true,
					dateFormat: 'DD, MM d, yy',
					timeFormat: 'hh:mm tt',
					stepMinute: 5,
					separator : ' @ ',
					altField  : resDate,
					altFieldTimeOnly: false,
					minDate   : new Date()
				});
			} else {
				resDate.datetimepicker({
					ampm: true,
					dateFormat: 'DD, MM d, yy',
					timeFormat: 'hh:mm tt',
					stepMinute: 5,
					separator : ' @ ',
					minDate   : new Date()
				});
			}
		}

});


function map_init(map_element) {
	"use strict";
	if ( typeof google === 'object' && typeof google.maps === 'object' ) {
		var myLatlng = new google.maps.LatLng( ThemeOption.map_coords_lat, ThemeOption.map_coords_long );

		var mapOptions = {
			zoom       : parseInt( ThemeOption.map_zoom_level ),
			center     : myLatlng,
			mapTypeId  : google.maps.MapTypeId.ROADMAP,
			scrollwheel: false
		};

		var map = new google.maps.Map( document.getElementById( map_element ), mapOptions );

		var contentString = '<div class="content">' + ThemeOption.map_tooltip + '</div>';

		var infowindow = new google.maps.InfoWindow( {
			content: contentString
		} );

		var marker = new google.maps.Marker( {
			position: myLatlng, map: map, title: ''
		} );
		google.maps.event.addListener( marker, 'click', function() {
			infowindow.open( map, marker );
		} );
	}
}
