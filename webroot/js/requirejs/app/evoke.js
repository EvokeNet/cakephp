define(['modernizr', 'foundation', 'i18next'], function(Modernizr, Foundation) {

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
			i18n.init({ lng: "en" ,
                  resGetPath: webroot+"js/locales/__lng__/__ns__.json",
                }, function(err, t) {});
		});
	};

	/**
	 * Loading animation
	 */
	evoke.loadingAnimation = '<div class="loading text-center"><div class="loading-circle-outside"></div><div class="loading-circle-inside"></div></div>';

	return evoke;
});
