require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery'], function($) {

		$('.evoke .missions.index img').each(function(){
			$(this).wrap('<div class="tint t"></div>');
		});

	});
});