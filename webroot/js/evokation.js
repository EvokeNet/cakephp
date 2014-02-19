$(document).ready(function() {

	// Start CKEditor
	CKEDITOR.disableAutoInline = true;
	CKEDITOR.replace('evokation', {
		customConfig: 'custom/ckeditor_config.js'
	});

});

// All Google Realtime API goes here
var realtimeOptions = {
  clientId: 'INSERT YOUR CLIENT ID HERE',
  authButtonElementId: 'authorizeButton',
  initializeModel: initializeModel,
  autoCreate: true,
  defaultTitle: "New Realtime Quickstart File",
  newFileMimeType: null, // Using default.
  onFileLoaded: onFileLoaded,
  registerTypes: null, // No action.
  afterAuth: null // No action.
}

function initializeModel(model) {
	var string = model.createString('Hello Realtime World!');
	model.getRoot().set('text', string);
}

function onFileLoaded(doc) {
	var string = doc.getModel().getRoot().get('text');

	var editor = document.getElementById('evokation');
	gapi.drive.realtime.databinding.bindString(string, textArea1);


	// Add logic for undo button.
	var model = doc.getModel();
	var undoButton = document.getElementById('undoButton');
	var redoButton = document.getElementById('redoButton');

	undoButton.onclick = function(e) {
		model.undo();
	};
	redoButton.onclick = function(e) {
		model.redo();
	};

	// Add event handler for UndoRedoStateChanged events.
	var onUndoRedoStateChanged = function(e) {
		undoButton.disabled = !e.canUndo;
		redoButton.disabled = !e.canRedo;
	};

	model.addEventListener(gapi.drive.realtime.EventType.UNDO_REDO_STATE_CHANGED, onUndoRedoStateChanged);
}

function startRealtime() {
	var realtimeLoader = new rtclient.RealtimeLoader(realtimeOptions);
	realtimeLoader.start();
}

startRealtime();