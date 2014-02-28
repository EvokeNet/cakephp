var file;
var groupNameTag = document.getElementById("groupname");
var groupName = groupNameTag.textContent || groupNameTag.innerText;

gapi.load("auth:client,drive-realtime,drive-share", createOrLoadDocument);

function createOrLoadDocument() {
	gapi.auth.setToken(ACCESS_TOKEN);

	gapi.client.load('drive', 'v2', function() {

		if (FILE_ID) {
			gapi.client.load('drive', 'v2', function() {
				gapi.drive.realtime.load(FILE_ID, onFileLoaded, initializeModel);
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
			$("evokation_id").val(id);
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
	var text = doc.getModel().getRoot().get("text");
	var evokation = document.getElementById("evokation");

	gapi.client.load('drive', 'v2', function() {
		gapi.drive.realtime.databinding.bindString(text, evokation);
	});
}

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