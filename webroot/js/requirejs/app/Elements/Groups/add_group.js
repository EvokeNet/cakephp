require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery','evoke','missionpanels','sweetalert'], function ($,evoke,missionPanels,swal) {
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
					sweetAlert({
						title: "You created a group!",
						text: "<p>Invite your friends and accept their requests to join the group!</p><br />"+
							"<p><span class='red'>Important:</span> only after your group is complete you should start to brainstorm your evidence!</p>",
						type: "success",
						confirmButtonColor: "#DD6B55",
						closeOnConfirm: false,
						html: true
					}, function(){
						//RELOAD PAGE (just to reload group area - this can be improved)
						location.reload();
					});
				}
			});
			
			event.preventDefault();
		});
	});
});