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
			//Click on badge: expand skills
			//--------------------------------------------//
			$('.view').bind('click', make_badges_small);
			
			var make_badges_small = function(){
				//Close all other badges
				$('.view.closed').each(function() {
					var badge_id = $(this).attr('id');
					close_badge(badge_id);
				});
				
				//Decrease title size
				$('.badge-title').css('font-size','1em');
				
				//This behavior is just for the first time any badge was clicked on
				$('.view').unbind('click', make_badges_small);
			};
			
			$('.view').on("click", function(){
				//Expand this badge
				if ($(this).hasClass('closed')) {
					var badge_id = $(this).attr('id');
					expand_badge(badge_id);
				}
			});
			
			function expand_badge(badge_id) {
				console.log('expand badge '+badge_id);
				
				//Close other open badges
				$('.view.expanded').each(function() {
					var expanded_badge_id = $(this).attr('id');
					close_badge(expanded_badge_id);
				});
				
				//Class expanded
				$('#'+badge_id).removeClass('closed opacity-04').addClass('expanded');
				
				//Parent full-width
				$('#'+badge_id).parent('.badge').addClass('full-width');

				//Turn bigger
				$('#'+badge_id).animate({
					height: "12vw",
					width: "12vw"
				},500);
				
				//Hide title
				$('#'+badge_id+' .badge-title').hide();
				
				//Expand content
				$('#badge-content-'+badge_id).show("pulsate", 200);
			}
			
			function close_badge(badge_id) {
				console.log('close badge ' +badge_id);
				
				$('#'+badge_id).removeClass('expanded').addClass('closed opacity-04');
				
				//Parent full-width
				$('#'+badge_id).parent('.badge').removeClass('full-width');
				
				//Turn smaller
				$('#'+badge_id).animate({
					height: "4vw",
					width: "4vw"
				},200);
				
				//Show title
				$('#'+badge_id+' .badge-title').show();
				
				//Hide content
				$('#badge-content-'+badge_id).children('.badge-skills .badge-achievements').hide();
				$('#badge-content-'+badge_id).hide("puff", 50);
			}


			//--------------------------------------------//
			//Click on skill: expand/close achievements
			//--------------------------------------------//
			$('.badge-skills li')
				.on("click", function(){
					//Expand achievements
					if ($(this).hasClass('closed')) {
						$(this).removeClass('closed').addClass('expanded');
						$(this).children('.badge-achievements').show("slide", { direction: "left" }, 400);
					}
					//Close achievements
					else {
						$(this).addClass('closed').removeClass('expanded');
						$(this).children('.badge-achievements').hide("slide", { direction: "left" }, 400);
					}
				});

                                                                                              
		});
	});
});
