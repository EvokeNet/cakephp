define(['modernizr', 'foundation', 'evokedata','i18next'], function(Modernizr, Foundation, evokeData) {

	function evoke() {}

	/**
	 * Initialize evoke
	 */
	evoke.initialize = function() {
		$(document).ready(function(){
			//Initialize foundation
			$(document).foundation({
				equalizer : {
					Specify if Equalizer should make elements equal height once they become stacked.
					equalize_on_stack: true
				}
			});
			var path = webroot+'js/locales/__lng__/__ns__.json'; // path to the translation.json of each language
			//init rhe i18next library
			i18n.init({ lng: evokeData.language , resGetPath: path,
                }, function(err, t) {
                });
			i18n.setLng(evokeData.language, { fixLng: true }, function(err, t) { 
          		/* loading done */
        	});

			/**
			* Alert fadeout
			*/
        	var alert = $('.alert-fade-out'); // add alert to this class if you want it to desapear after sometime
			setTimeout(function(){ $(alert).fadeOut(500) }, 5000); // after 5 seconds, fade it out in 0.5 seconds
		});
	};

	/**
	 * Loading animation
	 */
	evoke.loadingAnimation = '<div class="loading text-center"><div class="loading-circle-outside"></div><div class="loading-circle-inside"></div></div>';

	return evoke;
});
