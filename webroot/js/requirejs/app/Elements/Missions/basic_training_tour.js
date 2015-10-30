require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery', 'foundation', 'foundationjoyride'], function($) {
		$(document).ready(function() {

			/**
			 * Start the joyride and setup customization options
			 * and callbacks for after each step, and at the end.
			 */
			$(document).foundation('joyride', 'start', {
				tip_location             : 'right',
				modal                    : false,
				scroll_speed             : 0,
				nub_position             : 'left',
				tip_animation            : 'fade',
				tip_animation_fade_speed : 300,
				//This will run after every step of the tour
				post_step_callback       : function() {
					if (this['$target'][0]['id'].length > 0) { // only run this if the step is on a button
						$('#' + this['$target'][0]['id']).click();
					}
					window.scrollTo(0, 0); // used to reset the frame so the open tab is not too far up
				},
				// This will run at the end of the whole tour,
				// it should reset everything on the page and award a badge
				// TODO: ajax call to award basic training badge!
				post_ride_callback       : function() {
					$('.close-sidebar-button').click();
				}
			});
		});
	});
});
