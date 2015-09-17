var file;
var groupNameTag = document.getElementById("groupname");
var groupName = groupNameTag.textContent || groupNameTag.innerText;

// var editor = new MediumEditor('#evokation_div', {
// 	buttons: ['bold', 'italic', 'anchor', 'quote', 'header1', 'header2', 'unorderedlist', 'orderedlist'],
// 	targetBlank: true
// });

var TEXT; // global object that contains the collaborative model
var KB = new Kibo();

gapi.load("auth:client,drive-realtime,drive-share", createOrLoadDocument);

function createOrLoadDocument() {
	gapi.auth.setToken(ACCESS_TOKEN);

	gapi.client.load('drive', 'v2', function() {

		if (FILE_ID) {
			gapi.client.load('drive', 'v2', function() {
				gapi.drive.realtime.load(FILE_ID, onFileLoaded);
			});

		} else {
			gapi.client.drive.files.insert({
				'resource': {
					mimeType: 'application/vnd.google-apps',
					title: 'Evokation - ' + groupName
				}
		    }).execute(initialize);
		}
		
	});
}

function initialize(file) {
	var gdrive_file_id = file.id;
	var title = 'tmp_title';
	var abstract = 'tmp_abstract';
	var group_id = $("#evokation_group").val();

	gapi.client.load('drive', 'v2', function() {
		gapi.drive.realtime.load(file.id, onFileLoaded, initializeModel);
	});

	$.ajax({
		type: "POST",
		url: WEBROOT + "groups_users/storeFileInfo",
		data: {'group_id': group_id, 'gdrive_file_id': gdrive_file_id, 'title': title, 'abstract': abstract },
		success: function(id) {
			$("#evokation_id").val(id);
			console.log('projeto criado no bd');
		},
		error: function(msg) {
			console.log('erro ao criar projeto no bd: ' + msg);
		}
	});

}

function initializeModel(model) {
	var string = model.createString("Your Evokation");
	model.getRoot().set("text", string);
}

function onFileLoaded(doc) {

	TEXT = doc.getModel().getRoot().get("text");
	var evokation = document.getElementById("evokation_txt");

	gapi.client.load('drive', 'v2', function() {
		gapi.drive.realtime.databinding.bindString(TEXT, evokation);

		realtimeTick();

		var updateEditor = function(event) {
			if(!event.isLocal) {
				var editor = $("#evokation_div");
				editor.html(TEXT.getText());
			}
		};

		TEXT.addEventListener(gapi.drive.realtime.EventType.TEXT_INSERTED, updateEditor);
	 	TEXT.addEventListener(gapi.drive.realtime.EventType.TEXT_DELETED, updateEditor);

	 	setButtons($("#evokation_div"));

	});

}

function realtimeTick() {
	$("#evokation_div").html(TEXT.getText());
	$("#evokation_div").on('input', function() {
	 	TEXT.setText($(this).html());
	});
}

function insertHtmlAtCursor(html) {

    var sel, range;
    if (window.getSelection) {
        sel = window.getSelection();
        if (sel.getRangeAt && sel.rangeCount) {
            range = sel.getRangeAt(0);
            range.deleteContents();

            var span = document.createElement('span');
            span.className = 'image';
            span.setAttribute("contenteditable", false);
            span.innerHTML = html;

            range.insertNode( span );
        }
    } else if (document.selection && document.selection.createRange) {
        document.selection.createRange().innerHtml = html;
    }
}

function setButtons(element) {
	var images = element.find('.image');
	var buttonGroup = $('<ul/>', {
		class: "button-group"
	});
	var deleteButton = $('<li/>');
	var trashIcon = $('<i/>', {
		class: "fa fa-trash-o"
	});

	if (parseInt(element.width) >= element.attr('data-size')) {
		var resizeButton = $('<li><button class="button tiny bg-black white"><i class="fa fa-arrows-alt"></i></button></li>');
	} else {
		var resizeButton = $('<li><button class="button tiny bg-black white"><i class="fa fa-compress"></i></button></li>');
	};

	for (var i = images.length - 1; i >= 0; i--) {
		if($(images[i]).children('.button').length <= 0) {
			var delButton = $('<button/>', {
				class: "button tiny bg-black white",
				id: "btn_delete",
				'data-parent': 'image'+i
			});

			delButton.append(trashIcon);
			deleteButton.append(delButton);
			buttonGroup.append(resizeButton, deleteButton);

			$(images[i]).attr('id', 'image'+i);
			$(images[i]).append(buttonGroup);
		 }
	};
	
}


/**
*	jQuery handlers
*
**/

/**
* This AJAX call updates the title and abstract fields of an existing
* document in the database, given the Id.
*
**/
$("#evokation_draft_button").click(function(){
	var id = $("#evokation_id").val();
	var title = $("#evokation_title").val();
	var abstract = $("#evokation_abstract").val();

	$.ajax({
		dataType: 'text',
		type: "POST",
		url: WEBROOT + "groups_users/storeFileInfo",
		data: { 'id': id, 'title': title, 'abstract': abstract },
		success: function() {
			console.log('sucesso');
		},
		error: function(msg) {
			console.log('erro: ' + msg);
		}
	});
});

// Upload image
$("#image_uploader").change(function() {
	if($(this).val() !== '') {
		$("#image_form").ajaxForm({
			beforeSend: function() {
				// insertHtmlAtCursor('<i class="fa fa-spinner fa-spin" contenteditable="false"></i>');
			},
			uploadProgress: function(event, position, total, percentComplete) {
				// insertHtmlAtCursor(percentComplete);
			},
			success: function(msg) {
				var element = $("#evokation_div");
				insertHtmlAtCursor(msg);
				setButtons(element);
				TEXT.setText(element.html());
			},
			complete: function(xhr) {
				console.log('completed');
			}
		});
		$("#image_form").submit();
	}
});

// Image buttons
$(document).on('click', '#btn_delete', function(event) {
	var id = '#' + $(this).attr('data-parent');
	$(this).remove();
	$(id).remove();
	TEXT.setText($("#evokation_div").html());
});

var caret = $('<span/>', {
	class: 'caret'
});
var line = $('<p/>');
var editor = $("#evokation_div");

editor.append(caret);

$(document).on({
	click: function(e) {
		if(e.target.tagName == 'P') {
			console.log(e.pageX - e.offsetX);
			if($(".caret").length > 0) {
				// caret.insertAfter(e.target);
				caret.css({
					'left': e.pageX
				});
				caret.show();
			} else {
				// caret.insertAfter(e.target);
				caret.css({
					'left': e.pageX
				});
				caret.show();
			}
		}
		// $('.caret').blink(800);
	},
	keydown: function(e) {
		switch(KB.lastKey()) {
			case 'backspace':
				e.preventDefault();
				break;
			case 'end':
				e.preventDefault();
				break;
			case 'page_up':
				e.preventDefault();
				break;
			case 'page_down':
				e.preventDefault();
				break;
			case 'home':
				e.preventDefault();
				break;
			case 'enter':
				line.insertAfter(caret);
				break;
		}
	}



}, '#evokation_div, body');

// Caret blink effect
// $.fn.blink = function (speed) {
//     window.setInterval($(this).toggle(), speed);
// };