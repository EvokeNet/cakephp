define(['jquery','modernizr', 'foundation'], function(jQuery,Modernizr, Foundation) {

	function evoke() {}

	/**
	 * Initialize evoke
	 */
	evoke.initialize = function() {
		$(document).ready(function(){
			//Initialize foundation
			$(document).foundation({
				equalizer : {
					// Specify if Equalizer should make elements equal height once they become stacked.
					equalize_on_stack: true
				}
			});

			//Override jquery's show function to remove class hidden when it exists
			var originalShow = jQuery.fn.show;
			jQuery.fn.show = function()
			{
				$(this).removeClass('hidden');
				// Now go back to jQuery's original show()
				return originalShow.apply(this, arguments);  
			};
		});
	};

	/**
	 * Loading animation
	 */
	evoke.loadingAnimation = '<div class="loading text-center"><div class="loading-circle-outside"></div><div class="loading-circle-inside"></div></div>';

	return evoke;
});