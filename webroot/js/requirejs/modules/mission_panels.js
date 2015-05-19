define(['jquery','evoke','evokeData'], function($,evoke,evokeData) {
	function missionPanels() {}

	missionPanels.reloadTabQuests = function() {
		$.ajax({
			url: evokeData.missions_load_quests_url,
			type:"POST",
			beforeSend: function() {
				$('.tabQuestsContent').html(evoke.loadingAnimation);
			},
			success: function(data) {
				//Fill tab quests
				$('.tabQuestsContent').html(data);

				$(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax
			}
		});
	}

	return missionPanels;
});
