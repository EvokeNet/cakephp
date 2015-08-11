require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery', 'sweetalert', 'missionpanels', 'froala', '../js/requirejs/modules/facebook_share'], function ($, swal, missionPanels) {
		$(document).ready(function(){
			$('#missions-content-overlay-body').off(); //clear events in previous elements
			$('#missions-content-overlay-body *').off(); //clear events in previous elements

			//--------------------------------------------//
			//FROALA EDITOR
			//--------------------------------------------//
			$('.newCommentForm').editable({
				inlineMode: false,
				tabSpaces: true,
				theme: 'dark'
			});

			//--------------------------------------------//
			//DELETE EVIDENCE CONFIRMATION ALERT BOX
			//--------------------------------------------//
			$('#buttonDeleteEvidence').click(function(event){
				swal({
					title: "Are you sure?",
					text: "You will not be able to recover your evidence.",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, delete it!",
					closeOnConfirm: false
				},
				function(){
					//actually perform the action
					$.ajax({
					  url: $('#buttonDeleteEvidence').attr('href')+'/true',
					  success: function() {
						swal({
							title: "Deleted!",
							text: "Your evidence has been deleted.",
							type: "success"
						}, function(){
							//RELOAD WINDOW
							window.location.reload(true);
						});
					  },
					  error: function() {
					  	//Error message
						swal("Error", "Sorry, your evidence could not be deleted.", "error");
					  }
					});
				});
				event.preventDefault();
			});

			//--------------------------------------------//
			// LOAD EDIT EVIDENCE VIA AJAX
			//--------------------------------------------//
			$('#buttonEditEvidence').click(function(event){
				$('#evidenceContentWrapper').load($(this).attr('href')+'/true');
				event.preventDefault();
			});

			//--------------------------------------------//
			//DELETE COMMENT CONFIRMATION ALERT BOX
			//--------------------------------------------//
			$("#evidenceCommentsWrapper")
				.off("click", "a.buttonDeleteComment")
				.on("click", "a.buttonDeleteComment", function( event ) {
					var delete_comment_url = $(this).attr('href')+'/true';
					swal({
						title: "Are you sure?",
						text: "You will not be able to recover your evidence.",
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Yes, delete it!",
						closeOnConfirm: true
					},
					function(){
						missionPanels.openInMissionOverlay(delete_comment_url, null, 'POST');
					});
					event.preventDefault();
				});

			//--------------------------------------------//
			//LIKE VIA AJAX
			//--------------------------------------------//
			$("#missions-content-overlay-body")
				.off("click", "#buttonLikeEvidence")
				.on("click", "#buttonLikeEvidence", function( event ) {
					$.ajax({
						type: 'POST',
						url: $(this).attr('href'),
						success: function(response) {
							//Refresh page using the link on the view button
							$('#missions-content-overlay-body').off(); //clear events in previous elements
							$('#missions-content-overlay-body *').off(); //clear events in previous elements
							$('#missions-content-overlay-body').load($("#evidenceViewFull").attr('href'));
						}
					});

					event.preventDefault();
				});

			//--------------------------------------------//
			//SUBMIT COMMENT VIA AJAX (POST NEW OR EDIT)
			//--------------------------------------------//
			$("body")
				.off("submit", "form.formPostComment")
				.on("submit", "form.formPostComment", function( event ) {
					$.ajax({
						data: $(this).serialize(), // get the form data
						type: $(this).attr('method'), // GET or POST
						url: $(this).attr('action'), // the file to call
						success: function(response) {
							//Remove previous froala editors and foundation modals (they are not inside missions-content-overlay)
							$('.modalEvidenceComment').foundation('reveal', 'close');
							$('.froala-editor').remove(); //ATTENTION: this includes any froala editors in the page

							//Display content
							$('#missions-content-overlay-body').off(); //clear events in previous elements
							$('#missions-content-overlay-body *').off(); //clear events in previous elements
							$('#missions-content-overlay-body').html(response);

							//Go to the last comment
							$("html, body").animate({
								scrollTop: $("#evidenceCommentsWrapper div:last").offset().top
							}, 600);

							//Reflow
							$(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax
						}
					});
					event.preventDefault();
				});
		});
	});
});