define(['jquery', 'modernizr', 'foundation'], function($, Modernizr, Foundation) {
	$(document).ready(function(){
		$(document).foundation({
			equalizer : {
				// Specify if Equalizer should make elements equal height once they become stacked.
				equalize_on_stack: true
			}
		});
		// $(document).foundation('reflow');
		$(document).foundation('equalizer', 'reflow');
	});
});