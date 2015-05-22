define(['jquery','evoke','evokeData'], function($,evoke,evokeData) {
	function missionPanels() {}

	/**
	 * Open content in the mission overlay layer via AJAX
	 * It returns the jqXHR object of the ajax call, so whoever calls it
	 * can attach callbacks to the request.
	 * Example: missionPanels.openInMissionOverlay(my_url).done(function(){});
	 */
	missionPanels.openInMissionOverlay = function(ajax_url, ajax_data, ajax_type) {
		if (!ajax_type) {
			ajax_type = 'POST';
		}
		return $.ajax({
			url: ajax_url,
			data: ajax_data,
			type: ajax_type,
			beforeSend: function() {
				//SHOW OVERLAY WITH LOADING IMAGE
				$('.content-body').empty().append(evoke.loadingAnimation);
				$('#missions-content-overlay').fadeIn("slow");
				//HIDE SECTION BEHIND
				$('.main-section').addClass("hidden");
				$('.tab-bar').addClass("hidden");
				$('.close-sidebar-button').fadeOut('fast');
			},
			success: function(data) {
				//Go to the top of the page
				$("html, body").animate({
					scrollTop: 0
				}, 300);

				//Display content
				$('#missions-content-overlay-body *').off(); //clear events in previous elements
				$('#missions-content-overlay-body').off().html(data);

				//Reflow
				$(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax
			}
		});
	}

	/**
	 * Open content in the mission overlay layer via AJAX
	 */
	missionPanels.closeMissionOverlay = function() {
		//Clear content-body and its event
		$('#missions-content-overlay-body *').off(); //clear events in previous elements
		$('#missions-content-overlay-body').off().empty();

		//Hide content overlay and show tab-bar and main section
		$('#missions-content-overlay').fadeOut('fast');
		$('.main-section').removeClass("hidden");
		$('.tab-bar').removeClass("hidden");
		$('.close-sidebar-button').fadeIn("hidden");
	}

	/**
	 * Reload tab with Quests, but keep the same quest open
	 */
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
