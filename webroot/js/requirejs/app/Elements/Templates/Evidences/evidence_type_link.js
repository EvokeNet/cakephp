require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery','linkpreview'], function ($) {
  		$("body")
  			.off("focusout", "#evidenceLink")
  			.on("focusout", "#evidenceLink", function(event) {

	  			console.log('focusout');
	  			// $('#linkTeste').linkpreview({
	  			// 	previewContainer: "#link-container-teste"
	  			// });

				$('#evidenceLink').linkpreview({
					previewContainer: "#preview-container",
					refreshButton: "#refresh-button",
					onSuccess: function(data) {
						console.log("Winner!");
						console.log(data);
					}
				});
	  		});
    });
});