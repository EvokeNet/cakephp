require(['../requirejs/bootstrap'], function (bootstrap) {
		require(['jquery'], function ($) {
		//Profile picture glows on mouseover
		$("div.profile-picture")
		.on("mouseover", function(){
			alert('teste');
			$(this).addClass('img-glow-small');
			$(this).siblings('p').addClass('text-glow');
		})
		.on("mouseout", function(){
			$(this).removeClass('img-glow-small');
			$(this).siblings('p').removeClass('text-glow');
		});
	});
});