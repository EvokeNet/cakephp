require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery', 'fullpage'], function ($) {
		$(document).ready(function(){
			//--------------------------------------------//
			//FULLPAGE
			//--------------------------------------------//
			// Cria a full page
			if ($('.fullpage').length) {
				$('.fullpage').fullpage({
					verticalCentered: true,
					paddingTop: ($('#top-bar-login').height()*(-1.3)).toString()+"px",
					paddingBottom: ($('#top-bar-login').height()*1.3).toString()+"px",
					resize : true,
					scrollOverflow: true,
					fixedElements: '#top-bar-login',
					navigation: true,
					navigationTooltips: fullpage_tooltips
				});

				//Ajusta margens em relacao ao top-bar
				$('.fp-controlArrow').css("margin-top", ($('#top-bar-login').height()*(-2)).toString()+"px");
			}

			//--------------------------------------------//
			//GAMEPLAY TABS
			//--------------------------------------------//
			$(document).ready(function () {
				// Show special image only in the tab that is active
				$('#tabs-gameplay li').click(function() {
					//Hide thumb and glow in all others
					$('li img.active').addClass("hidden");
					$('li img.not-active').removeClass("hidden");
					$('li h5').removeClass("text-glow");
					//Show in this one
					$(this).find('img.not-active').addClass("hidden");
					$(this).find('img.active').removeClass("hidden");
					$(this).find('h5').addClass("text-glow");
				}).mouseover(function() {
					$(this).find('img.not-active').addClass("hidden");
					$(this).find('img.active').removeClass("hidden");
				}).mouseout(function() {
					if (!$(this).hasClass("active")) {
					$(this).find('img.active').addClass("hidden");
					$(this).find('img.not-active').removeClass("hidden");
					}
				});
			});

			$('form:first *:input[type!=hidden]:first').focus();
		});
	});
});
