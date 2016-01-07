require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery','jqueryui'], function ($) {
		$(document).ready(function(){

			$("#btnShowUserMenu").on("click", function(){
				$("#content").find('div :visible').addClass('hidden');
				$("#userMenu").removeClass('hidden');
				console.log($("#btnShowUserMenu").parent().parent().find('li :active'));//.removeClass('active');
				$("#usersLink").addClass('active');
			});

		});
	});
});