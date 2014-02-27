// $(document).ready(function() {

// 	// Start CKEditor
// 	// CKEDITOR.disableAutoInline = true;
// 	// CKEDITOR.replace('evokation', {
// 	// 	customConfig: 'custom/ckeditor_config.js'
// 	// });

// });

// console.log(access_token);
gapi.load("auth:client,drive-realtime,drive-share", initialize);

function initialize() {
	var fileId;
	var groupName = document.getElementById("groupname");
	
	gapi.client.load('drive', 'v2', function() {
		fileId = gapi.client.drive.files.insert({
			'resource': {
				mimeType: 'application/vnd.google-apps.drive-sdk',
				title: 'Evokation - ' + groupName
			}
	    });
	});

    gapi.client.load('drive', 'v2', function() {
		gapi.drive.realtime.load(fileId, onFileLoaded, initializeModel);
	});

}

function initializeModel(model) {
	var string = model.createString("This is your Evokation.");
	model.getRoot().set("text", string);
}

function onFileLoaded(doc) {
	var text = doc.getModel().getRoot().get("text");
	var evokation = document.getElementById("evokation");
	gapi.drive.realtime.databinding.bindString(string, evokation);
}