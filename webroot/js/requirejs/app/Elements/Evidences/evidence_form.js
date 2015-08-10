require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery', 'handlebars', '../FileUploader/js/FileUploader', 'missionpanels', 'sweetalert', 'froala'], function ($, Handlebars, FileUploader, missionPanels, swal) {
		$(document).ready(function(){
			$('#missions-content-overlay-body').off(); //clear events in previous elements
			$('#missions-content-overlay-body *').off(); //clear events in previous elements

			//--------------------------------------------//
			//SETUP FILE UPLOADER PLUGIN
			//--------------------------------------------//
			$(window)
				.off('uploaderFileAdded')
				.on('uploaderFileAdded', function(event) {
					//Show progress bar
					$('div.files').removeClass('hidden');
				});

			$(window)
				.off('uploadCompleted')
				.on('uploadCompleted', function(event) {
					//Hide progress bar
					$('div.files').addClass('hidden');

					var detail = event.originalEvent.detail;

					//Insert data into form to save it in the DB
					$('#evidence-form-main-content').attr('value', detail.url);
					$('#evidence-form-type').attr('value', detail.mimetype);

					//Display uplodaded content
					$('#file-content').attr('src', detail.url).attr('alt', detail.identifier);

					if ($('.upload-button-text').length) {
						$('.upload-button-text').remove();
					}

					//Video shows
					$('.flex-video-new').removeClass('hidden');
				});

			//--------------------------------------------//
			//EFFECT TO RESIZE EVIDENCE TYPE
			//--------------------------------------------//
			var setup_evidence_type = function(){
				//Title and Font-size
				$('#evidence-type-title').remove();
				$('#new-evidence-type').animate({fontSize: "6"},500);
				$('#new-evidence-type h4').animate({fontSize: "7"},500);

				//Load form according to the evidence type
				evidence_type = $(this).data("evidence-type");
				load_evidence_type_form(evidence_type);

				//Active x inactive
				$('.evidence-type').addClass('inactive');
				$(this).removeClass('inactive').addClass('active');

				//Next choice of evidence type will discard previous changes
				$(".evidence-type").bind("click", function(event) {
					btn_clicked = $(this);
					var evidence_type = $(this).data("evidence-type");
					var evidenceContentForm = $('#evidenceContentForm').html();

					//Confirmation dialog
					swal({
						title: "Are you sure?",
						text: "If you change your evidence type now, you will lose the special content of your evidence's focus",
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#26dee0",
						confirmButtonText: "Yes, change my evidence type!",
						closeOnConfirm: true
					},
					function(){
						//Execute the action if confirmed
						$.when(load_evidence_type_form(evidence_type)).then(function () {
							$('#evidenceContentForm').html(evidenceContentForm);

							//Active x inactive
							$('.evidence-type').removeClass('active').addClass('inactive');
							$(btn_clicked).removeClass('inactive').addClass('active');
						});
					});
					event.preventDefault();
				});

				//This behavior is just for the first time any evidence type was chosen
				$(".evidence-type").unbind('click', setup_evidence_type);
			};

			$(".evidence-type").bind('click', setup_evidence_type);

			//--------------------------------------------//
			//LOAD HANDLEBARS TEMPLATE FOR DIFFERENT TYPES OF EVIDENCES
			//--------------------------------------------//
			var load_evidence_type_form = function(evidence_type){
				if ((evidence_type == "image") || (evidence_type == "video") || (evidence_type == "link")) {
					//Compile handlebars
					var source   = $("#evidence-type-"+evidence_type+"-template").html();
					var template = Handlebars.compile(source);

					//Execute handlebars
					var context = {
						id: 'evidence-1',
						input_file_name: 'main_content'
					};
					var html = template(context);

					//Display content
					$('#evidence-main-content').html(html);

					//Evidence type in the form
					$('#evidence-form-type').attr('value', evidence_type);
				}
				else {
					$('#evidence-main-content').html("");
				}

				//Remove buttons to choose evidence type, and show the form
				$('#new-evidence-form').removeClass('hidden');

				//FROALA EDITOR
				$('#evidenceContentForm').editable({
					inlineMode: false,
					minHeight: 200,
					tabSpaces: true,
					theme: 'dark'
				});

				//Reflow
				FileUploader.initUploader(); //FILEUPLOADER
				$(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax
			};

			//--------------------------------------------//
			//EDITING AN EVIDENCE: ALREADY LOADS EVIDENCE TYPE FORM
			//--------------------------------------------//
			var evidence_type = $('#evidence-form-type').attr('value');
			if (evidence_type) {
				load_evidence_type_form(evidence_type);
			}


			//--------------------------------------------//
			//EVIDENCE: SUBMITTING A FORM TO EDIT AN EVIDENCE LOADS EVIDENCE VIEW VIA AJAX
			//--------------------------------------------//
			$("#missions-content-overlay-body").on("submit", "form.formSubmitEvidence", function( event ) {
				//ADD EVIDENCE
				$.ajax({
					url: webroot+"/evidences/addEvidence",
					type:"POST",
					data: $('form').serializeArray(),
					success: function(dataAddEvidence) {
						var objAddEvidence = $.parseJSON(dataAddEvidence);

						//CHECK IF A PHASE WAS UNLOCKED
						$.ajax({
							url: webroot+"/phases/checkSubscription",
							type:"POST",
							data:objAddEvidence,
							success: function(data) {
								var obj = $.parseJSON(data);

								if(obj.flag == 0){

									swal({
										title: "Phase unlocked!",
										text: "Congratulations, you just unlocked a phase! You can keep working on this phase, but you can also take a look on the next one.",
										type: "success"
									});

								}

								//Execute the action if confirmed
								missionPanels.openInMissionOverlay(
									webroot+"/evidences/view/"+objAddEvidence.evidence_id 	//URL DE VISUALIZACAO DA EVIDENCE
								).done(function() {
									missionPanels.reloadTabQuests();
									missionPanels.reloadMainContent();
								});
							}
						});

					}
				});

				event.preventDefault();
			});
		});
	});
});
