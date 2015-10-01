define(['jquery','evoke','evokedata','jqueryui'], function($,evoke,evokeData) {
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

		missions_content_overlay = $('#missions-content-overlay');
		missions_content_overlay_body = $('#missions-content-overlay-body');

		return $.ajax({
			url: ajax_url,
			data: ajax_data,
			type: ajax_type,
			beforeSend: function() {
				//Clear content-body and its events
				$('.content-body *').off();
				$('.content-body').children().remove();
				//SHOW OVERLAY WITH LOADING IMAGE
				$('.content-body').append(evoke.loadingAnimation);
				missions_content_overlay.fadeIn("slow");
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
				missions_content_overlay_body.off();
				missions_content_overlay_body.children().remove();
				missions_content_overlay_body.html(data);

				//Focus on first input, or, at least, in the first element
				first_input = $("#missions-content-overlay-body input:visible:first");
				if (first_input.length > 0) {
					first_input.focus();
				}
				else {
					$("#missions-content-overlay-body :visible:first").focus();
				}
				

				//Reflow
				$(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax
			}
		});
	}

	/**
	 * Open content in the mission overlay layer via AJAX
	 */
	missionPanels.closeMissionOverlay = function() {
		//Clear content-body and its events
		$('#missions-content-overlay-body *').off();
		$('#missions-content-overlay-body').off();
		$('#missions-content-overlay-body').children().remove();

		//Hide content overlay and show tab-bar and main section
		$('#missions-content-overlay').fadeOut('fast');
		$('.main-section').removeClass("hidden");
		$('.tab-bar').removeClass("hidden");
		$('.close-sidebar-button').removeClass("hidden");
	}

	/**
	 * Reload panels main content
	 */
	missionPanels.reloadMainContent = function() {
		var tabQuestsContent = $('#panelsMainContent');

		$.ajax({
			url: evokeData.load_main_content_url,
			type:"POST",
			beforeSend: function() {
				tabQuestsContent.html(evoke.loadingAnimation);
			},
			success: function(data) {
				//Fill tab quests
				tabQuestsContent.html(data);

				$(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax
				$(document).foundation('equalizer','reflow');
			}
		});
	}

	/**
	 * Reload tab with Quests, but keep the same quest open
	 */
	missionPanels.reloadTabQuests = function() {
		//console.log("HERE");
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
				$(document).foundation('equalizer','reflow');
			}
		});
	}

	//--------------------------------------------//
	//Open mission content above graphic novel
	//--------------------------------------------//
	missionPanels.open_panel = function(panel_button,panel_source) {
		$(panel_source).addClass("panel-open");

		//Add opacity behind
		$(panel_button+" span").addClass("text-color-highlight").removeClass("text-color-gray"); //Icon highlight
		$('.main-section .missions-graphic-novel').addClass('blur-strong opacity-04'); //Blur everything else

		
		//Show content in front
		if ($(panel_button).hasClass('default')) {
			$('.mission-sidebar').css("height",""); //restart data-equalizer of the sidebar columns

			$('#missionSidebar').show("slide", { direction: "left" }, 400, function(){
				$(panel_source).fadeIn('fast');
				$(document).foundation('equalizer', 'reflow'); //data-equalizer for sidebar columns
			});
		}
		else {
			$(panel_source).fadeIn('fast');
			$(document).foundation('equalizer', 'reflow'); //data-equalizer for sidebar columns
		}

		//Possible to close panel
		$('.close-sidebar-button').fadeIn('fast');
	}

	missionPanels.close_panel = function(panel_button,panel_source,changingTabs) {
		$(panel_source).removeClass("panel-open");

		//Show content in front
		$(panel_source).fadeOut('fast');
		if (panel_source != '#tabForum') {
			$('#missionSidebar').hide("slide", { direction: "left" }, 0, function() {
				$(panel_button+" span").removeClass("text-color-highlight").addClass("text-color-gray"); //Icon grey

				if (!changingTabs) {
					//Remove opacity behind
					$('.main-section .missions-graphic-novel').removeClass('blur-strong opacity-04'); //Remove blur in everything else
				}
			});
		}
		else {
			$(panel_button+" span").removeClass("text-color-highlight").addClass("text-color-gray"); //Icon grey

			if (!changingTabs) {
				//Remove opacity behind
				$('.main-section .missions-graphic-novel').removeClass('blur-strong opacity-04'); //Remove blur in everything else
			}
		}

		//Not possible to close panel
		$('.close-sidebar-button').fadeOut('fast');
	}

	/* Open or close a panel */
	missionPanels.toggle_panel = function(idMenuIcon,idTabContent) {
		var changingTabs = false;

		//Closing a currently open tab
		if ((idTabContent != undefined) && !$('#'+idTabContent).hasClass("panel-open")) {
			changingTabs = true;
		}

		//Close currently open tab (if any)
		var open_tab = $('.panel-open');
		if ($(open_tab).length) {
			var open_tab_id = $(open_tab).attr('id');
			missionPanels.close_panel('#menu-icon-'+open_tab_id,'#'+open_tab_id,changingTabs);
		}

		//Opening another tab
		if (changingTabs) {
			missionPanels.open_panel('#'+idMenuIcon,'#'+idTabContent);	
		}
	}

	return missionPanels;
});
