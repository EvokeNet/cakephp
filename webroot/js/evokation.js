var file;
var groupNameTag = document.getElementById("groupname");
var groupName = groupNameTag.textContent || groupNameTag.innerText;

var editor = new MediumEditor('#evokation_div', {
	buttons: ['bold', 'italic', 'anchor', 'quote', 'header1', 'header2', 'unorderedlist', 'orderedlist'],
	targetBlank: true
});

var TEXT; // global object that contains the collaborative model

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
					mimeType: 'text/html',
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
				// var sel = rangy.saveSelection();
				$("#evokation_div").html(TEXT.getText());
				// rangy.restoreSelection(sel);
			}
		};

		TEXT.addEventListener(gapi.drive.realtime.EventType.TEXT_INSERTED, updateEditor);
	 	TEXT.addEventListener(gapi.drive.realtime.EventType.TEXT_DELETED, updateEditor);

	 	setDraggableElements();

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

            document.createElement(html);

            range.insertNode( html );
        }
    } else if (document.selection && document.selection.createRange) {
        document.selection.createRange().innerHtml = html;
    }
}


/**
*	Document callbacks
*
**/

function setResizableImages() {
	$("#evokation_div img").each(function() {
		var width, height;

		$(this).resizable({
			aspectRatio: 1,
			containment: "#evokation_div",
			stop: function(event, ui) {
				$(this).width = $(event.target).width;
				$(this).height = $(event.target).height;
				console.log(ui.width, ui.height);
				TEXT.setText($("#evokation_div").html());
			}
		});
	});
}

function setDraggableElements() {
	$("#evokation_div img").each(function() {
		$(this).draggable();
	});
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
				var image = '<img src="' + msg + '" />';
				insertHtmlAtCursor(image);
				TEXT.setText($("#evokation_div").html());
			},
			complete: function(xhr) {
				console.log('completed');
				console.log(xhr.responseText);
			}
		});
		$("#image_form").submit();
	}
});


$("#x").click(function(e) {
	e.stopPropagation();

	var element = document.querySelector("#evokation_div");
	var range = rangy.createRange();
	range.selectNodeContents(element);
	var sel = rangy.getSelection();
	sel.setSingleRange(range);

	console.log(sel.focusOffset);

});