require(['../requirejs/bootstrap'], function () {
	require(['jquery', 'jqueryui'], function ($) {
		
		
		$(document).ready(function() {
			//--------------------------------------------//
			//Show progress circle around badge
			//--------------------------------------------//
			$(".view").each(function( index ) {
				var badge_id = $(this).attr('id');
				var progress = $(this).data('progress');

				if(progress==0) {
					$("#"+badge_id+" .animate-50-75-b, .animate-25-50-b, .animate-0-25-b").css("transform","rotate(90deg)");
					$("#"+badge_id+" .animate-75-100-b").css("transform","rotate(90deg)");
					$("#"+badge_id+" .btext").html("0%");
					return;
				}
				if(progress % 1 != 0) {
					progress = progress.toFixed(2);
				}
				if(progress<25){
					var angle = -90 + (progress/100)*360;
					$("#"+badge_id+" .animate-0-25-b").css("transform","rotate("+angle+"deg)");

				}
				else if(progress>=25 && progress<50){
					var angle = -90 + ((progress-25)/100)*360;
					$("#"+badge_id+" .animate-0-25-b").css("transform","rotate(0deg)");
					$("#"+badge_id+" .animate-25-50-b").css("transform","rotate("+angle+"deg)");
				}
				else if(progress>=50 && progress<75){
					var angle = -90 + ((progress-50)/100)*360;
					$("#"+badge_id+" .animate-25-50-b, .animate-0-25-b").css("transform","rotate(0deg)");
					$("#"+badge_id+" .animate-50-75-b").css("transform","rotate("+angle+"deg)");
				}
				else if(progress>=75 && progress<=100){
					var angle = -90 + ((progress-75)/100)*360;
					$("#"+badge_id+" .animate-50-75-b, .animate-25-50-b, .animate-0-25-b").css("transform","rotate(0deg)");
					$("#"+badge_id+" .animate-75-100-b").css("transform","rotate("+angle+"deg)");
				}
				
				$("#"+badge_id+" .btext").html(progress+"%");
			});

			//--------------------------------------------//
			//Click on badge: make all other badges small initially
			//--------------------------------------------//
			var make_badges_small = function(e){
				//Turn smaller
				$('.badge-image').animate({
					height: "4vw",
					width: "4vw"
				},200);

				//Decrease title size
				$('.badge-title').css('font-size','1em');
				
				//This behavior is just for the first time any badge was clicked on
				$('.view').unbind('click', make_badges_small);

				e.preventDefault();
			};

			$('.view').bind('click', make_badges_small);

			//--------------------------------------------//
			//Click on badge: expand skills
			//--------------------------------------------//
			$('.view').on("click", function(e){
				//Expand this badge
				if ($(this).hasClass('closed')) {
					var badge_id = $(this).attr('id');
					expand_badge(badge_id);
				}
				e.preventDefault();
			});
			
			function expand_badge(badge_id) {				
				//Close other open badges
				$('.view.expanded').each(function() {
					var expanded_badge_id = $(this).attr('id');
					close_badge(expanded_badge_id);
				});
				
				//Class expanded
				$('#'+badge_id).removeClass('closed opacity-04').addClass('expanded');
				
				//Parent full-width
				$('#'+badge_id).parent('.badge').addClass('full-width');
				
				//Expand content
				$('#badge-content-'+badge_id).show("blind", 500);

				//Go to the top of the badge content
				$("html, body").animate({
					scrollTop: $('.badge').offset().top
				}, 400);
			}
			
			function close_badge(badge_id) {				
				$('#'+badge_id).removeClass('expanded').addClass('closed opacity-04');
				
				//Parent full-width
				$('#'+badge_id).parent('.badge').removeClass('full-width');
				
				//Hide content
				// $('#badge-content-'+badge_id).children('.badge-skills .badge-achievements').hide();
				$('#badge-content-'+badge_id).hide("puff", 50);
			}


			//--------------------------------------------//
			//Click on skill: make it glow and scroll
			//--------------------------------------------//
			$('#tabs-skills li a')
				.on("click", function(e){
					//Text glow in the active li
					$('#tabs-skills li').removeClass('text-glow');
					var li = $(this).parent('li');
					$(li).addClass('text-glow');

					//Go to the bottom of the badge description
					var badge_id = $('.view.expanded').attr('id');
					$("html, body").animate({
						scrollTop: $('#badge-description-'+badge_id).offset().top
					}, 400);

					e.preventDefault();
				});
		});
	});
});
