require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery', 'handlebars', 'froala', '../FileUploader/js/FileUploader'], function ($, Handlebars) {
		$(document).ready(function(){
			$('#missions-content-overlay-body').off(); //clear events in previous elements
			$('#missions-content-overlay-body *').off(); //clear events in previous elements
			window.initUploader(); //FILEUPLOADER

			//--------------------------------------------//
			//HANDLEBARS FOR DIFFERENT TYPES OF EVIDENCES
			//--------------------------------------------//
			$(".evidence-type").click(function(){
				var evidence_type = $(this).data("evidence-type");

				if ((evidence_type == "image") || (evidence_type == "video") || (evidence_type == "link")) {
					//Compile handlebars
					var source   = $("#evidence-type-"+evidence_type+"-template").html();
					var template = Handlebars.compile(source);

					//Execute handlebars
					var context = {
						id: 'evidence-1',
						input_file_name: 'main-content'
					};
					var html = template(context);

					//Display content
					$('#evidence-main-content').html(html);
				}

				//Remove buttons to choose evidence type, and show the form
				$('#new-evidence-type').remove();
				$('#new-evidence-form').removeClass('hidden');

				//FROALA EDITOR
				$('#evidenceContentForm').editable({
					inlineMode: false,
					minHeight: 200,
					tabSpaces: true,
					theme: 'dark'
				});

				//Reflow
				window.initUploader(); //FILEUPLOADER
				$(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax
			});

			

			//--------------------------------------------//
			//EVIDENCE: SUBMITTING A FORM TO EDIT AN EVIDENCE LOADS EVIDENCE VIEW VIA AJAX
			//--------------------------------------------//
			$("#missions-content-overlay-body").on("submit", "form.formSubmitEvidence", function( event ) {
				$.ajax({
					data: $(this).serialize(), // get the form data
					type: $(this).attr('method'), // GET or POST
					url: $(this).attr('action'), // the file to call
					success: function(response) {
						//Go to the top of the page
						$("html, body").animate({
							scrollTop: 0
						}, 300);

						//Display content
						$('#missions-content-overlay-body').off(); //clear events in previous elements
						$('#missions-content-overlay-body *').off(); //clear events in previous elements
						$('#missions-content-overlay-body').html(response);

						//Reflow
						$(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax
					}
				});
				event.preventDefault();
			});
		});
	});
});