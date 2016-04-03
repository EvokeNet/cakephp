require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery'], function ($) {
		$(document).ready(function(){
			//--------------------------------------------//
			//ADD ALLY VIA AJAX
			//--------------------------------------------//
			$('.addally').on('click', function() {
				//Action is on a.href
				if ($(this).attr('href') != "#") {
					$(this).load(
						$(this).attr('href'), 
						function () {
							$(this)
								.html("Congratulations! The user has been added.")
								.attr('href','#')
								.addClass('disabled')
								.removeClass('button');
						}
					); 
				}
				// Prevent link going somewhere
				return false; 
			});
		});
	});
});