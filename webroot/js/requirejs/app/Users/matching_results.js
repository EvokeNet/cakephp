require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery'], function ($) {
		$(document).ready(function(){
			//--------------------------------------------//
			//Checkbox glows when selected
			//--------------------------------------------//
			$("div.profile-content")
			.on("mouseover", function(){
				$(this).addClass('img-glow-small');
				$(this).find('.profile-picture').addClass('img-glow-small');
				$(this).find('button').addClass('img-glow-small').addClass('text-glow');
			})
			.on("mouseout", function(){
				$(this).removeClass('img-glow-small');
				$(this).find('.profile-picture').removeClass('img-glow-small');
				$(this).find('button').removeClass('img-glow-small').removeClass('text-glow');
			});
		});
	});
});