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
					console.log(data);
					//RELOAD TAB QUESTS
					missionPanels.closeMissionOverlay();
					missionPanels.reloadTabQuests();

					//GROUP FORUM ICON IS NOW ENABLED
					var forum_url = $('#menu-icon-tabForumGroup').data('forum-url');
					console.log(forum_url);

					forum_url.append(data.forum_id);
					console.log($('#menu-icon-tabForumGroup').data('forum-url'));

					$('#menu-icon-tabForumGroup').data('forum-id',data.forum_id);

					$('#menu-icon-tabForumGroup').removeClass('hidden');
				}
			});
			
			event.preventDefault();
		});
	});
});