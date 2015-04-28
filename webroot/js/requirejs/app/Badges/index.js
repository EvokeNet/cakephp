require(['../requirejs/bootstrap'], function () {
	require(['jquery'], function ($) {
		
		//--------------------------------------------//
		//Progress
		//--------------------------------------------//
		$(document).ready(function() {
			$(".badge.view").each(function( index ) {
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

			// $('.loader-bg img')
			// 	.on("mouseover", function(){
			// 		$(this).addClass("img-circular opacity-03");
			// 	})
			// 	.on("mouseout", function(){
			// 		$(this).removeClass("img-circular opacity-03");
			// 	});

                                                                                              
		});
	});
});
