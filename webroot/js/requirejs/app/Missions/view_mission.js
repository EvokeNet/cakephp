require([webroot+'js/requirejs/bootstrap'], function () {
	require(['evoke', 'missionpanels', 'evokeData', 'foundation', 'froala'], function (evoke,missionPanels,evokeData) {
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

							//CLICKING ON EACH EVIDENCE OPENS IT ON THE MISSION-OVERLAY ON THE LEFT
							$(".tabEvidencesContent").on( "click", "a.evidence-list-item-link", function( event ) {
								$.ajax({
									url: $(this).attr("href")+"/true",
									type:"POST",
									beforeSend: function() {
										//SHOW OVERLAY WITH LOADING IMAGE
										$('.content-body').html(evoke.loadingAnimation);
										$('#missions-content-overlay').fadeIn("fast");
										//HIDE SECTION BEHIND
										$('.main-section').addClass("hidden");
										$('.tab-bar').addClass("hidden");
										$('.close-sidebar-button').fadeOut('fast');
									},
									success: function(data) {
										//Go to the top
										$("html, body").animate({
											scrollTop: 0
										}, 300);

										//#missions-content-overlay Content
										$(".content-body").html(data);

										//Reflow
										$(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax
									}
								});
								event.preventDefault();
							});

							$(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax
						}
					});
				}
			});


			//--------------------------------------------//
			//OPEN QUESTS PANEL
			//--------------------------------------------//
			//CLICKING ON THE QUEST PANEL WILL LOAD CONTENT VIA AJAX (every time)
			$("#menu-icon-tabQuests").one("click", function(e) {
				if (!$("#tabQuests").hasClass("panel-open")) { //otherwise this click is to close it
					missionPanels.reloadTabQuests();
				}
				e.preventDefault();
			});

			//--------------------------------------------//
			//Requests to join group handled with ajax
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