define(['jquery','evoke','evokeData'], function($,evoke,evokeData) {
	function missionPanels() {}

	missionPanels.reloadTabQuests = function() {
		var tabQuestsContent = $('.tabQuestsContent');
		var active_tab_index = tabQuestsContent.find('dd.active').index();

		$.ajax({
			url: evokeData.missions_load_quests_url,
			type:"POST",
			beforeSend: function() {
				tabQuestsContent.html(evoke.loadingAnimation);
			},
			success: function(data) {
				//Fill tab quests
				tabQuestsContent.html(data);

				//If there was an active tab, the same tab has to be active now
				if (active_tab_index > 0) {
					//Ignore the default tab
					tabQuestsContent.find('dd').removeClass('active');
					tabQuestsContent.find('.tabs-content div.content').removeClass('active');

					//Make the original tab active
					var active_tab = tabQuestsContent.find('dd:eq('+active_tab_index+')');
					$(active_tab).addClass('active');

					var tab_content_id = active_tab.find('a').attr('href');
					$(tab_content_id).addClass('active');
				}

				$(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax
			}
		});
	}

	return missionPanels;
});
