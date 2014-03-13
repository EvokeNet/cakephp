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

            var spinner = document.createElement('span');
            spinner.innerHTML = html;

            console.log(spinner);

            range.insertNode( spinner );
        }
    } else if (document.selection && document.selection.createRange) {
        document.selection.createRange().innerHtml = html;
    }
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
})




$("#x").click(function(e) {
	e.stopPropagation();

	var element = document.querySelector("#evokation_div");
	var range = rangy.createRange();
	range.selectNodeContents(element);
	var sel = rangy.getSelection();
	sel.setSingleRange(range);

	console.log(sel.focusOffset);

});

var saveSelection, restoreSelection;
if (window.getSelection) {
    // IE 9 and non-IE
    saveSelection = function() {
        var sel = window.getSelection(), ranges = [];
        if (sel.rangeCount) {
            for (var i = 0, len = sel.rangeCount; i < len; ++i) {
                ranges.push(sel.getRangeAt(i));
            }
        }
        return ranges;
    };

    restoreSelection = function(savedSelection) {
        var sel = window.getSelection();
        sel.removeAllRanges();
        for (var i = 0, len = savedSelection.length; i < len; ++i) {
            sel.addRange(savedSelection[i]);
        }
    };
} else if (document.selection && document.selection.createRange) {
    // IE <= 8
    saveSelection = function() {
        var sel = document.selection;
        return (sel.type != "None") ? sel.createRange() : null;
    };

    restoreSelection = function(savedSelection) {
        if (savedSelection) {
            savedSelection.select();
        }
    };
}