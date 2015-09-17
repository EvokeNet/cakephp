require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery'], function ($) {
		$(document).ready(function(){
			//--------------------------------------------//
			//Profile picture glows on mouseover
			//--------------------------------------------//
			$(".profile-picture")
			.on("mouseover", function(){
				$(this).addClass('img-glow-small');
				$(this).siblings('p').addClass('text-glow');
			})
			.on("mouseout", function(){
				$(this).removeClass('img-glow-small');
				$(this).siblings('p').removeClass('text-glow');
			});
		});
	});
});