require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery','missionpanels', 'sweetalert', 'i18next'], function ($,missionPanels,swal) {

		//--------------------------------------------//
		//REMOVE GROUP MEMBER CONFIRMATION ALERT BOX
		//--------------------------------------------//
		$(".buttonRemoveMember").click(function(){
			var remove_url = $(this).attr('href');

			swal({
				title: i18n.t("app.elements.missions.panel_group_area.msg_remove_group_member.title"),
				text: i18n.t("app.elements.missions.panel_group_area.msg_remove_group_member.text"),
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: i18n.t("app.elements.missions.panel_group_area.msg_remove_group_member.confirmButtonText"),
				cancelButtonText: i18n.t("app.elements.missions.panel_group_area.msg_remove_group_member.cancelButtonText"),
				closeOnConfirm: false
			}, function() {
				$.ajax({
				  url: remove_url+'/true',
				  success: function() {
					swal({
						title: i18n.t("app.elements.missions.panel_group_area.msg_member_removed.title"),
						text: i18n.t("app.elements.missions.panel_group_area.msg_member_removed.text"),
						type: "success"
					}, function(){
						missionPanels.reloadMainContent();
					});
				  },
				  error: function() {
					swal(i18n.t("app.elements.missions.panel_group_area.msg_error_remove.title"),
						i18n.t("app.elements.missions.panel_group_area.msg_error_remove.text"),
						"error"
					);
				  }
				});
			});

			event.preventDefault();
		});
		
		//--------------------------------------------//
		// ACCEPT GROUP REQUEST VIA AJAX
		//--------------------------------------------//
		$(".buttonAcceptRequest").click(function(){
			$.ajax({
				type: 'POST',
				url: $(this).attr('href'),
				success: function(response) {
					swal(i18n.t("app.elements.missions.panel_group_area.msg_acc_request.title"),
						i18n.t("app.elements.missions.panel_group_area.msg_acc_request.text"),
						"success"
					);
					missionPanels.reloadMainContent();
				}
			});
			event.preventDefault();
		});

		//--------------------------------------------//
		// DECLINE GROUP REQUEST VIA AJAX
		//--------------------------------------------//
		$(".buttonDeclineRequest").click(function(){
			$.ajax({
				type: 'POST',
				url: $(this).attr('href'),
				success: function(response) {
					swal(i18n.t("app.elements.missions.panel_group_area.msg_refuse_request.title"),
						i18n.t("app.elements.missions.panel_group_area.msg_refuse_request.text"),
						"success"
					);
					missionPanels.reloadMainContent();
				}
			});
			event.preventDefault();
		});
	});
});