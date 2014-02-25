$(document).ready(function() {

	// Start CKEditor
	// CKEDITOR.disableAutoInline = true;
	// CKEDITOR.replace('evokation', {
	// 	customConfig: 'custom/ckeditor_config.js'
	// });

});

var globals = globals || {};

globals.INSTALL_SCOPE = 'https://www.googleapis.com/auth/drive.install';
globals.FILE_SCOPE = 'https://www.googleapis.com/auth/drive.file';
globals.OPENID_SCOPE = 'openid';
globals.CLIENT_ID = '265052812506-kl15ei6bv8493e4sb7uu31nksuor9r10.apps.googleusercontent.com';
globals.USER_ID = '';

gapi.load("auth:client,drive-realtime", function() {
	gapi.auth.authorize({
		client_id: globals.CLIENT_ID,
		scope: [
			globals.INSTALL_SCOPE,
			globals.FILE_SCOPE,
			globals.OPENID_SCOPE
		],
		user_id: globals.USER_ID,
		immediate: true
		}, initializeRealtime);
});

function initializeRealtime() {
	
}