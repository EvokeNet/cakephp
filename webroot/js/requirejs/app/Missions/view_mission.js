require(['../requirejs/bootstrap'], function () {
	require(['jquery', 'foundation', 'froala'], function ($) {
		$(document).ready(function(){
			//--------------------------------------------//
			//OPEN DOSSIER OFFCANVAS
			//--------------------------------------------//
			//CLICKING ON THE DOSSIER OFFCANVAS WILL LOAD CONTENT VIA AJAX ONCE (and keep the same content if the button is clicked later on)
			$("#menu-icon-tabDossier").one( "click", function() {
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
			//CLICKING ON THE EVIDENCE OFFCANVAS WILL LOAD CONTENT VIA AJAX ONCE (and keep the same content if the button is clicked later on)
			$("#menu-icon-tabEvidences").one( "click", function() {
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
						$( ".tabEvidencesContent" ).on( "click", "a.evidence-list-item-link", function( event ) {
							$.ajax({
								url: $(this).attr("href")+"/true",
								type:"POST",
								beforeSend: function() {
									$('#missions-content-overlay .content-body').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>');
									$('#missions-content-overlay').removeClass("hidden");
									$('div.missions-submenu').addClass("hidden");
								},
								success: function(data) {
									//Content
									$("#missions-content-overlay .content-body").html(data);
									
									//Reflow
									$(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax
								}
							});
							event.preventDefault();
						});

						$(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax
					}
				});
			});

		});
	});
});