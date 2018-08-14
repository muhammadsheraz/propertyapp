$.noConflict();

jQuery(document).ready(function($) {

	"use strict";

	[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
		new SelectFx(el);
	} );

	jQuery('.selectpicker').selectpicker;


	$('#menuToggle').on('click', function(event) {
		$('body').toggleClass('open');
	});

	$('.search-trigger').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		$('.search-trigger').parent('.header-left').addClass('open');
	});

	$('.search-close').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		$('.search-trigger').parent('.header-left').removeClass('open');
	});

	// $('.user-area> a').on('click', function(event) {
	// 	event.preventDefault();
	// 	event.stopPropagation();
	// 	$('.user-menu').parent().removeClass('open');
	// 	$('.user-menu').parent().toggleClass('open');
	// });


	// Generic Alertify Dialog
	if (!alertify.splash) {
		alertify.dialog("splash", function factory() {
			return {
			main: function(message) {
				this.message = message;
			},
			setup: function() {
				return {
					//buttons: [{ text: "Close", key: 27 /*Esc*/ }],
					focus: { element: 0 },
					options: {title: ""}
				};
			},
			prepare: function() {
				this.setContent(this.message);
			}
			};
		});
	}

	alertify.defaults.transition = "pulse"; // slide, zoom, pulse
});