require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery', 'foundation', 'foundationjoyride'], function($) {
		$(document).ready(function() {
			$(document).foundation('joyride', 'start', {
				tip_location       : 'right',
				modal              : false,
				scroll_speed       : 0,
				nub_position       : 'left',
				post_step_callback : function() {
					if (this['$target'][0]['id'].length > 0) {
						$('#' + this['$target'][0]['id']).click();
					}
					window.scrollTo(0, 0);
				},
				post_ride_callback : function() {
					$('.close-sidebar-button').click();
				}
			});
		});
	});
});
