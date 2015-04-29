require(['../requirejs/bootstrap'], function () {
	require(['jquery', 'jqueryui'], function ($) {
		
		//--------------------------------------------//
		//Progress
		//--------------------------------------------//
		$(document).ready(function() {
			$(".badge .view").each(function( index ) {
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

			$('.loader-bg')
				.on("mouseover", function(){
					$(this).addClass("img-glow");
				})
				.on("mouseout", function(){
					$(this).removeClass("img-glow");
				});

			$('.badge .closed')
				.on("click", function(){
					//Close other open badges
					$('.badge .expanded').each(function() {
						var badge_id = $(this).attr('id');
						close_badge(badge_id);
					});

					//Expand this badge
					var badge_id = $(this).attr('id');
					expand_badge(badge_id);
				});

			function expand_badge(badge_id) {
				$('.badge .view').removeClass('closed').addClass('expanded');

				//Turn smaller
				$('#badge_id .badge-image').animate({
					height: "4vw",
					width: "4vw"
				},500);

				//Hide description
				$('#badge-description-'+badge_id).fadeOut('fast', function() {
					//Show skills
					$('#badge-skills-'+badge_id).show("slide", { direction: "left" }, 400);
				});
			}

			function close_badge(badge_id) {
				$('.badge .view').addClass('closed').removeClass('expanded');

				//Turn bigger
				$('#badge_id .badge-image').animate({
					height: "12vw",
					width: "12vw"
				},500);

				//Show description
				$('#badge-description-'+badge_id).fadeIn('fast', function() {
					//Hide skills
					$('#badge-skills-'+badge_id).hide("slide", { direction: "left" }, 100);
				});
			}

			$('.badge .expanded')
				.on("click", function(){
					$(this).addClass("img-circular opacity-03");
				});

			$('.badge-skills li.closed')
				.on("click", function(){
					$(this).children('.badge-achievements').show("slide", { direction: "left" }, 400);
				});

                                                                                              
		});
	});
});
