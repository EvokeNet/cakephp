require(['../requirejs/bootstrap'], function () {
	require(['jquery'], function ($) {
		$(document).ready(function(){
			//--------------------------------------------//
			//Option elements glows on hover
			//--------------------------------------------//
			$("div.panelOptions li")
			.on("mouseover", function(){
				$(this).find(".table").addClass('img-glow-small');
				$(this).find(".cropGraphicNovelIcon").addClass('img-glow-small');
				$(this).find(".button").addClass('img-glow-small');
			})
			.on("mouseout", function(){
				$(this).find(".table").removeClass('img-glow-small');
				$(this).find(".cropGraphicNovelIcon").removeClass('img-glow-small');
				$(this).find(".button").removeClass('img-glow-small');
			});
		});
	});
});