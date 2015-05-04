require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery'], function ($) {
		$(document).ready(function(){
			//--------------------------------------------//
			//GLOW
			//--------------------------------------------//
			//Top-leaders glow when selected
			$("div.top-leaders li")
			.on("mouseover", function(){
				$(this).find('.profile-content').addClass('background-color-darkest');
				$(this).find('.profile-picture').addClass('img-glow-small');
				$(this).find('.user-name').addClass('text-glow');
			})
			.on("mouseout", function(){
				$(this).find('.profile-content').removeClass('background-color-darkest');
				$(this).find('.profile-picture').removeClass('img-glow-small');
				$(this).find('.user-name').removeClass('text-glow');
			});

			//Other leaders glow when selected
			$("div.other-leaders .profile-content")
			.on("mouseover", function(){
				$(this).find('.profile-picture').addClass('img-glow-small');
				$(this).find('.user-name').addClass('text-glow');
			})
			.on("mouseout", function(){
				$(this).find('.profile-picture').removeClass('img-glow-small');
				$(this).find('.user-name').removeClass('text-glow');
			});
		});
	});
});