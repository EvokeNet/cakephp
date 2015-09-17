require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery'], function($) {

		$(document).ready(function() {
			menuHeight();
		});

		function menuHeight(){
			$(".maincolumn").each(function() {
				$('.menucolumn').css("height", $(this).innerHeight());
			});
		}
		
	});
});