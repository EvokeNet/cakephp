require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery','evoke','missionpanels','sweetalert', 'i18next'], function ($,evoke,missionPanels,swal) {
		//--------------------------------------------//
		//SUBMIT A FORM TO ADD A GROUP VIA AJAX
		//--------------------------------------------//
		$("#missions-content-overlay-body").on("submit", "#createGroupForm", function( event ) {
			$.ajax({
				url: $(this).attr('action'),
				data: $(this).serialize(),
				type: $(this).attr('method'),
				beforeSend: function() {
					//SHOW OVERLAY WITH LOADING IMAGE
					$('.content-body').empty().append(evoke.loadingAnimation);
				},
				success: function(data) {
					//RELOAD TAB QUESTS
					missionPanels.closeMissionOverlay();
					missionPanels.reloadTabQuests();

					//Confirmation dialog
					swal({
						title: i18n.t("app.elements.groups.add_group.msg_group_created.title"),
						text: "<p>"+i18n.t("app.elements.groups.add_group.msg_group_created.text_invite")+"</p><br />"+
							"<p><span class='red'>"+i18n.t("app.elements.groups.add_group.msg_group_created.text_important")+
							"</span>"+i18n.t("app.elements.groups.add_group.msg_group_created.text_warning")+"</p>",
						type: "success",
						confirmButtonColor: "#DD6B55",
						closeOnConfirm: true,
						html: true
					}, function(){
						//Reload main content
						missionPanels.reloadMainContent();
					});
				}
			});
			
			event.preventDefault();
		});
	});
});