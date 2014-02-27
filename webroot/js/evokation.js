var file;
var groupNameTag = document.getElementById("groupname");
var groupName = groupNameTag.textContent || groupNameTag.innerText;

gapi.load("auth:client,drive-realtime,drive-share", createOrLoadDocument);

function createOrLoadDocument() {
	gapi.auth.setToken(ACCESS_TOKEN);

	gapi.client.load('drive', 'v2', function() {

		if (FILE_ID) {

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
	gapi.client.load('drive', 'v2', function() {

		gapi.drive.realtime.load(file.id, onFileLoaded, initializeModel);

	});

	// $.ajax({
	// 	type: "POST",
	// 	url: "",
	// 	data: {},
	// 	success: function() {

	// 	},
	// 	error: function() {
			
	// 	}
	// });

}

function initializeModel(model) {
	var string = model.createString("This is your Evokation.");
	model.getRoot().set("text", string);
}

function onFileLoaded(doc) {
	var text = doc.getModel().getRoot().get("text");
	var evokation = document.getElementById("evokation");

	gapi.client.load('drive', 'v2', function() {

		gapi.drive.realtime.databinding.bindString(text, evokation);

	});
}