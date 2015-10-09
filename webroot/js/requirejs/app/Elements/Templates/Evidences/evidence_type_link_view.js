require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery','linkpreview','../js/requirejs/modules/linkpreviewproxy'], function ($) {
		$('.evidenceLink').each(
			function(){
				var container = $(this).siblings(".preview-container");
				var refresh   = $(this).siblings(".refresh-button");

				$(this).linkpreview({
					previewContainer: container,
					refreshButton: refresh,
					errorMessage: "Invalid URL",
					preProcess: function() {
						container.html('<div><div class="loading-circle-outside"></div><div class="loading-circle-inside"></div></div>');
					},
					onSuccess: function(data) {
						$('.span4').addClass('columns small-6 medium-4 large-3 text-right');
						$('.span8').addClass('columns small-6 medium-8 large-9');
						container.addClass('margin top-2 padding all-2 margin bottom-2');

						//If no data was retrieved, show URL
						if (!data) {
							container.append($(this).attr("href"));
						}
					}
				});
			}
		);
    });
});