require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery','jqueryui'], function ($) {
		$(document).ready(function(){
			//on click
			$("#btnShowUserMenu").on("click", function(){
				$("#content").find('div :visible').addClass('hidden'); // hide the visible div
				$("#userMenu").removeClass('hidden'); // show user menu
				// set the correct item on the menu to active
				$("#btnShowUserMenu").parent().parent().find('li.active').removeClass('active'); 
				$("#usersLink").addClass('active');
			});

		});
	});
});