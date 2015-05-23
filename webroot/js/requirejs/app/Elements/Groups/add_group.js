require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery','evoke','missionpanels'], function ($,evoke,missionPanels) {
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
					missionPanels.closeMissionOverlay();
					missionPanels.reloadTabQuests();
				}
			});
			
			event.preventDefault();
		});
	});
});