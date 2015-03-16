require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery', 'foundation', 'froala'], function ($) {
		$(document).ready(function(){
			//--------------------------------------------//
			//OPEN DOSSIER OFFCANVAS
			//--------------------------------------------//
			//CLICKING ON THE DOSSIER OFFCANVAS WILL LOAD CONTENT VIA AJAX ONCE (and keep the same content if the button is clicked later on)
			$("#menu-icon-tabDossier").one("click", function() {
				$.ajax({
					url: missions_load_dossier_url,
					type:"POST",
					beforeSend: function() {
						$('.tabDossierContent').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>');
					},
					success: function(data) {
						$('.tabDossierContent').html(data);
						$(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax
					}
				});
			});

			//--------------------------------------------//
			//OPEN EVIDENCE OFFCANVAS
			//--------------------------------------------//
			//CLICKING ON THE EVIDENCE OFFCANVAS WILL LOAD CONTENT VIA AJAX (every time, in case a user created a new evidence) -- IF it's not closing
			$("#menu-icon-tabEvidences").on("click", function() {
				if (!$("#sidr-tabEvidences").hasClass("sidr-open")) { //otherwise this click is to close it
					$.ajax({
						url: missions_load_evidences_url,
						type:"POST",
						beforeSend: function() {
							$('.tabEvidencesContent').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>');
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
										$('.content-body').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>');
										$('#missions-content-overlay').removeClass("hidden");
										//HIDE SUBMENU BEHIND
										$('div.missions-submenu').addClass("hidden");
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

		});
	});
});