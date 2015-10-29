require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery', 'foundation', 'foundationjoyride'], function() {
		$(document).foundation('joyride', 'start');
	});
});
