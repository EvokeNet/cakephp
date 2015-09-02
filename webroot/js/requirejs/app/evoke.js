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
					// Specify if Equalizer should make elements equal height once they become stacked.
					equalize_on_stack: true
				}
			});
			var path = webroot+'js/locales/__lng__/__ns__.json';
			
			i18n.init({ lng: evokeData.language , resGetPath: path,
                }, function(err, t) {
                	
                	//alert("PATH: "+path);
                });
			i18n.setLng(evokeData.language, { fixLng: true }, function(err, t) { 
          		/* loading done */
          		console.log("EVOKE LANG: "+evokeData.language);
        	});
		});
	};

	/**
	 * Loading animation
	 */
	evoke.loadingAnimation = '<div class="loading text-center"><div class="loading-circle-outside"></div><div class="loading-circle-inside"></div></div>';

	return evoke;
});
