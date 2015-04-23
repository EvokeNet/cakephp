require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery','linkpreview'], function ($) {
  		$("body")
  			.off("focusout", "#evidenceLink")
  			.on("focusout", "#evidenceLink", function(event) {

	  			console.log('focusout');
	  			$('#linkTeste').linkpreview({
	  				previewContainer: "#link-container-teste"
	  			});

				$('#evidenceLink').linkpreview({
					previewContainer: "#preview-container",
					refreshButton: "#refresh-button",
					errorMessage: "Invalid URL",
					preProcess: function() {
						console.log("preProcess");
					},
					onSuccess: function(data) {
						console.log("onSuccess");
						console.log(data);
					},
					onError: function() {
						console.log("onError");
					},
					onComplete: function() {
						console.log("onComplete");
					}
				});
	  		});
    });
});