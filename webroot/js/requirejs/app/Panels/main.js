require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery','jqueryui'], function ($) {
		$(document).ready(function(){
			//on click
			$("#btnShowUserMenu").on("click", function(){
				console.log('hello');
				$("#content").find('div:visible').addClass('hidden'); // hide the visible div
				$("#userMenu").removeClass('hidden'); // show user menu
				// set the correct item on the menu to active
				$("#btnShowUserMenu").parent().parent().find('li.active').removeClass('active'); 
				$("#usersLink").addClass('active');
			});

			//--------------------------------------------//
			//DELETE EVIDENCE CONFIRMATION ALERT BOX
			//--------------------------------------------//
			$('.deleteUser').click(function(event){
				var $this = $(this);
				event.preventDefault();
				swal({
					title: i18n.t("app.panels.main.msg_delete_user.title"),
					text: i18n.t("app.panels.main.msg_delete_user.text"),
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: i18n.t("app.panels.main.msg_delete_user.confirmButtonText"),
					cancelButtonText: i18n.t("app.panels.main.msg_delete_user.cancelButtonText"),
					closeOnConfirm: false
				},
				function(){
					//actually perform the action
					$.ajax({
					  url: $this.attr('href'),
					  success: function() {
					  	$this.closest('tr').remove();
						swal({
							title: i18n.t("app.panels.main.msg_user_deleted.title"),
							text: i18n.t("app.panels.main.msg_user_deleted.text"),
							type: "success"
						}, function(){
						
						});
					  },
					  error: function() {
					  	//Error message
						swal(i18n.t("app.panels.main.msg_error_delete.title"),
						 	i18n.t("app.panels.main.msg_error_delete.text"),
						 	"error"
						);
					  }
					});
				});
				event.preventDefault();
			});

		});
	});
});