require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery', 'foundation', 'foundationjoyride'], function() {
		$(document).on('ready', function() {
			$(document).foundation('joyride', 'start', {
				scroll_speed : 0
			});
		});
	});
});
