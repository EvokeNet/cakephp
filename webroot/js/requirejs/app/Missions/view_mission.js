require([webroot+'js/requirejs/bootstrap'], function () {
	require(['evoke', 'missionpanels', 'evokedata', '../js/requirejs/app/Common/mission_layout', 'foundation', 'froala'], function (evoke,missionPanels,evokeData) {
		$(document).ready(function(){
			//--------------------------------------------//
			//OPEN DOSSIER PANEL
			//--------------------------------------------//
			//CLICKING ON THE DOSSIER PANEL WILL LOAD CONTENT VIA AJAX ONCE (and keep the same content if the button is clicked later on)
			$("#menu-icon-tabDossier").one("click", function() {
				$.ajax({
					url: evokeData.missions_load_dossier_url,
					type:"POST",
					beforeSend: function() {
						$('.tabDossierContent').html(evoke.loadingAnimation);
					},
					success: function(data) {
						$('.tabDossierContent').html(data);
						$(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax
					}
				});
			});

			//--------------------------------------------//
			//OPEN EVIDENCE PANEL
			//--------------------------------------------//
			//CLICKING ON THE EVIDENCE PANEL WILL LOAD CONTENT VIA AJAX (every time, in case a user created a new evidence) -- IF it's not closing
			$("#menu-icon-tabEvidences").on("click", function() {
				if (!$("#tabEvidences").hasClass("panel-open")) { //otherwise this click is to close it
					$.ajax({
						url: evokeData.missions_load_evidences_url,
						type:"POST",
						beforeSend: function() {
							$('.tabEvidencesContent').html(evoke.loadingAnimation);
						},
						success: function(data) {
							//Fill tab evidence
							$('.tabEvidencesContent').html(data);

							$(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax
						}
					});
				}
			});

			//--------------------------------------------//
			//OPEN EVOKATION PANEL
			//--------------------------------------------//
			//CLICKING ON THE EVIDENCE PANEL WILL LOAD CONTENT VIA AJAX (every time, in case a user created a new evidence) -- IF it's not closing
			$("#menu-icon-tabEvokations").on("click", function() {
				if (!$("#tabEvidences").hasClass("panel-open")) { //otherwise this click is to close it
					$.ajax({
						url: evokeData.missions_load_evokations_url,
						type:"POST",
						beforeSend: function() {
							$('.tabEvidencesContent').html(evoke.loadingAnimation);
						},
						success: function(data) {
							//Fill tab evidence
							$('.tabEvidencesContent').html(data);

							$(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax
						}
					});
				}
			});

			//CLICKING ON EACH EVIDENCE OPENS IT ON THE MISSION-OVERLAY ON THE LEFT
			$("body").on( "click", "a.evidence-list-item-link", function( event ) {
				missionPanels.openInMissionOverlay($(this).attr("href")+"/true");
				event.preventDefault();
			});

			//CLICKING ON EACH EVIDENCE OPENS IT ON THE MISSION-OVERLAY ON THE LEFT
			$("body").on( "click", "a.evokation-list-item-link", function( event ) {
				missionPanels.openInMissionOverlay($(this).attr("href")+"/true");
				event.preventDefault();
			});

			//--------------------------------------------//
			//OPEN QUESTS PANEL
			//--------------------------------------------//
			//CLICKING ON THE QUEST PANEL WILL LOAD CONTENT VIA AJAX (every time)
			$("#menu-icon-tabQuests").one("click", function(e) {
				missionPanels.reloadTabQuests();
				e.preventDefault();
			});

			//--------------------------------------------//
			//OPEN QUESTS PANEL BY DEFAULT
			//--------------------------------------------//
			if (evokeData.open_quests_by_default) {
				missionPanels.open_panel("#menu-icon-tabQuests", "#tabQuests");
				missionPanels.reloadTabQuests();
			}
			

			//--------------------------------------------//
			//QUEST - JOIN GROUP Requests to join group handled with ajax
			//--------------------------------------------//
			$("body").on( "click", "a.button.join-group", function( event ) {
				var modal = $(this).parents('div.reveal-modal');
				$.ajax({
					url: $(this).attr('href'),
					type:"POST",
					beforeSend: function() {
						modal.append(evoke.loadingAnimation);
					},
					success: function(data) {
						$('.loading').remove();
						//Close modal
						modal.foundation('reveal', 'close');
						$(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax

						//Reload quests
						missionPanels.reloadTabQuests();
					}
				});
				event.preventDefault();
			});
		});
	});
});