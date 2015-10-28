require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery', 'handlebars', '../FileUploader/js/FileUploader', 'missionpanels', 'sweetalert', 'i18next', 'froala'], 
		function ($, Handlebars, FileUploader, missionPanels, swal) {
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
				$('#new-evidence-type').animate({fontSize: "6"}, 500);
				$('#new-evidence-type h4').animate({fontSize: "7"}, 500);

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
						title: i18n.t("app.elements.evidences.evidence_form.msg_change_type.title"),
						text: i18n.t("app.elements.evidences.evidence_form.msg_change_type.text"),
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#26dee0",
						confirmButtonText: i18n.t("app.elements.evidences.evidence_form.msg_change_type.confirmButtonText"),
						cancelButtonText: i18n.t("app.elements.evidences.evidence_form.msg_change_type.cancelButtonText"),
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
					$('#evidence-form-type').attr('value', 'text');
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
				//load_evidence_type_form(evidence_type);
				var type_split = evidence_type.split("/")[0];
				$(".evidence-type").filter('[data-evidence-type="'+type_split+'"]').click();
			}

			//--------------------------------------------//
			//GET EMBEDED YOUTUBE LINK AND SHOW THE VIDEO
			//--------------------------------------------//

			/**
			 * JavaScript function to match (and return) the video Id 
			 * of any valid Youtube Url, given as input string.
			 * @author: Stephan Schmitz <eyecatchup@gmail.com>
			 * @url: http://stackoverflow.com/a/10315969/624466
			 */
			function ytVidId(url) {
				var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
				return (url.match(p)) ? RegExp.$1 : false;
			}
			$('#btnEmbededLink').on("click", function(){

				var link = $('#embededLink').val();

				if(link == null || link == '' || !(link = ytVidId(link))){
					swal({
						title: i18n.t("app.elements.evidences.evidence_form.msg_empty_link.title"),
						text: i18n.t("app.elements.evidences.evidence_form.msg_empty_link.text"),
						type: "warning"
					});
				}else{
					
					link = '<iframe width="560" height="315" src="https://www.youtube.com/embed/'+link+'" frameborder="0" allowfullscreen></iframe>';
					//$('#videoWrapper').html = '';
					//var btnSubmit = '<a href="#"  id="btnEmbededLink" class="button thin"><?php echo __("Submit") ?></a>';
					$('#videoWrapper').html(link);
					//$('#videoWrapper').append(btnSubmit);
				}
			});

			$('#sendEmbededLink').on("click", function(){
				var link = $('#embededLink').val();
				console.log(link);
				if(link == null || link == '' || !ytVidId(link)){
					swal({
						title: i18n.t("app.elements.evidences.evidence_form.msg_empty_link.title"),
						text: i18n.t("app.elements.evidences.evidence_form.msg_empty_link.text"),
						type: "warning"
					});
				}else{
					console.log($('#EvidenceAddEvokationPartActForm').serializeArray());
					$.ajax({
						url: $('#EvidenceAddEvokationPartActForm').attr('action'),
						type: 'POST',
						data: $('#EvidenceAddEvokationPartActForm').serializeArray(),
						dataType: 'json',
						success: function(data, textStatus, jxqh) {
							console.log(data);
							console.log(textStatus);
							console.log(jxqh);
						}, error: function(a, b, c) {
							console.log(a, b, c);
						}
					});
				}
			});

			//--------------------------------------------//
			//EVIDENCE: SUBMITTING A FORM TO EDIT AN EVIDENCE LOADS EVIDENCE VIEW VIA AJAX
			//--------------------------------------------//
			$("#missions-content-overlay-body").on("submit", "form.formSubmitEvidence", function( event ) {
				//ADD EVIDENCE
				console.log("ADD EVIDENCE");
				$.ajax({
					url: $(this).attr('action'),//webroot+"evidences/addEvidence",
					type:"POST",
					data: $(this).serializeArray(),

					success: function(dataAddEvidence) {
						var filePath = '';
						if(dataAddEvidence == true){
							if ($('#EvidenceId').length){
								filePath = webroot+"evidences/view/"+$('#EvidenceId').val();
							}
							// if it is an evokaiton part, open evokation preview instead
							if ($('#EvidenceEvokationId').length){
								filePath = webroot+"evidences/preview_evokation/"+$('#EvidenceEvokationId').val()+"/"+$('#EvidenceMissionId').val();
							}
							//Execute the action if confirmed
							missionPanels.openInMissionOverlay(
								filePath
							).done(function() {
								missionPanels.reloadTabQuests();
								missionPanels.reloadMainContent();
							});
						}else if(dataAddEvidence == false){
							//ERROR
						}else{
							var objAddEvidence = $.parseJSON(dataAddEvidence);
							console.log("Before");
							//CHECK IF A PHASE WAS UNLOCKED
							$.ajax({
								url: webroot+"phases/checkSubscription",
								type:"POST",
								data:objAddEvidence,
								success: function(data) {
									console.log("AJAX");
									filePath = webroot+"evidences/view/"+objAddEvidence.evidence_id; 	//URL DE VISUALIZACAO DA EVIDENCE
									// if it is an evokaiton part, open evokation preview instead
									if ($('#EvidenceEvokationId').length){
										filePath = webroot+"evidences/preview_evokation/"+$('#EvidenceEvokationId').val()+"/"+$('#EvidenceMissionId').val()+"/"+$('#EvidencePhaseId').val();
									}
									var obj = $.parseJSON(data);
									console.log("SUCCESS: "+obj.flag);
									if(obj.flag == 0){

										swal({
											title: i18n.t("app.elements.evidences.evidence_form.msg_phase_unlocked.title"),
											text: i18n.t("app.elements.evidences.evidence_form.msg_phase_unlocked.text"),
											type: "success"
										});
									}
									//Execute the action if confirmed
									missionPanels.openInMissionOverlay(
										filePath
									).done(function() {
										missionPanels.reloadTabQuests();
										missionPanels.reloadMainContent();
									});
								}
							});
						}
						
					}
				});

				event.preventDefault();
			});
		});
	});
});
