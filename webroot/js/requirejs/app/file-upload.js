require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery'], function ($) {
		$(document).ready(function(){
			//--------------------------------------------//
			//INSTRUCTIONS
			//--------------------------------------------//
			//Create an INPUT of type FILE
			//1. define its id
			//2. add class "upload-file-input"
			//   ex.: <input type="file" id="file-input-1" class="upload-file-input" />

			//Create a BUTTON to trigger the input
			//1. add class upload-file-button
			//2. add property file-input-id, whose value is the id of the actual input that will be triggered
			//   ex.: <button class="upload-file-button" data-file-input-id="file-input-1" />

			//(Optional) Create an element to display the file name
			//1. define its id with the same name as the file input, plus "-filename"
			//   ex.: <span id="file-input-1-filename"></span>

			//(Optional) Create an element to display the file content
			//1. define its id with the same name as the file input, plus "-filecontent"
			//   ex.: <img id="file-input-1-filecontent" />
			//2. define a custom event to manipulate the change in the object
			//   ex.: $('#file-input-1-filecontent').change(function(){});

			

			//--------------------------------------------//
			//CLICK IN UPLOAD BUTTONS
			//--------------------------------------------//
			// $('body')
			// 	.off('click', '.upload-file-button') //clear events in previous elements
			// 	.on('click', '.upload-file-button', function(e) {
			// 		//Default input file behavior
			// 		var file_input_id = $(this).data("file-input-id");
			// 		//$('#'+file_input_id).click();

			// 		//Remove focus
			// 		//e.preventDefault();
			// 		$(this).blur();

			// 		//Go to the top of the button
			// 		$("html,body").animate({
			// 			scrollTop: $(this).offset().top
			// 		}, 300);
			// 	});

			//--------------------------------------------//
			//FILE INPUT CHANGED -> FILE NAME DISPLAYED IN ANOTHER ELEMENT
			//--------------------------------------------//
			$('body')
				.off('click', '.upload-file-input') //clear events in previous elements
				.on('change', '.upload-file-input', function (event) {
					console.log('evento!!!');
				});
			// $('body')
			// 	.off('click', '.upload-file-input') //clear events in previous elements
			// 	.on('change', '.upload-file-input', function (event) {
			// 		if ('files' in this) {
			// 			//Displays file name if there is such element
			// 			var filename_element = $('#'+this.id+'-filename');

			// 			//Displays file content if there is such an element (and the browser supports it)
			// 			var filecontent_element = $('#'+this.id+'-filecontent');
			// 			var uploadbutton_element = $('#'+this.id+'-uploadbutton');

			// 			if (this.files.length > 0) {
			// 				if ($(filename_element).length) {
			// 					$(filename_element).text(this.files[0].name);
			// 				}

			// 				//Displays the file content if the browser supports it
			// 				if (($(filecontent_element).length) && (window.FileReader)) {
			// 					var reader = new FileReader();

			// 					reader.onload = function (e) {
			// 						$(filecontent_element).attr('src', e.target.result).data('filecontent', e.target.result);

			// 						if ($(uploadbutton_element).length) {
			// 							$(uploadbutton_element).remove();
			// 						}
			// 					};

			// 					reader.readAsDataURL(this.files[0]);
			// 				}
			// 			}
			// 		}
			// 	});
		});
	});
});