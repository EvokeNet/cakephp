require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery','evoke','linkpreview','../js/requirejs/modules/linkpreviewproxy'], function ($,evoke) {
		var initLinkPreview = function() {
			$('#evidenceLink').linkpreview({
				previewContainer: "#preview-container",
				refreshButton: "#refresh-button",
				errorMessage: "Invalid URL",
				preProcess: function() {
					$('#preview-container').html(evoke.loadingAnimation);
				},
				onSuccess: function(data) {
					//Show preview
					$('.span4').addClass('columns small-6 medium-4 large-3 text-right');
					$('.span8').addClass('columns small-6 medium-8 large-9');
					$('#preview-container').addClass('margin top-2 background-color-standard radius padding all-2');

					//If no data was retrieved, show URL
					if (!data || (data == "")) {
						$('#preview-container').append($("#evidenceLink").val());
					}

					//Update form
					$('#evidence-form-main-content').attr('value', $("#evidenceLink").val());
				}
			});
		};

		//var initLinkPreview = $('.evidenceLink').each(
			
  	// 	$("body")
  	// 		.off(".evidenceLink")
  	// 		.on("focusin", ".evidenceLink", function(){
			// 	var container = $(this).siblings(".preview-container");
			// 	var refresh   = $(this).siblings(".refresh-button");

			// 	$(this).linkpreview({
			// 		previewContainer: container,
			// 		refreshButton: refresh,
			// 		errorMessage: "Invalid URL",
			// 		preProcess: function() {
			// 			$(container).html(evoke.loadingAnimation);
			// 	},
			// 	onSuccess: function(data) {
			// 		//Show preview
			// 		$('.span4').addClass('columns small-6 medium-4 large-3 text-right');
			// 		$('.span8').addClass('columns small-6 medium-8 large-9');
			// 		$(container).addClass('margin top-2 background-color-standard radius padding all-2');

			// 		//If no data was retrieved, show URL
			// 		if (!data || (data == "")) {
			// 			$(container).append($(".evidenceLink").val());
			// 		}

			// 		//Update form
			// 		$('#evidence-form-main-content').attr('value', $(".evidenceLink").val());
			// 	}
			// })
			// .on("focusout", ".evidenceLink", function(e) {
			// 	$(refresh).click();
			// })
  	// 		.on("keypress",".evidenceLink", function(e) {
			// 	if(e.which == 13) {
			// 		$(refresh).click();
			// 	}
			// });
    });
});