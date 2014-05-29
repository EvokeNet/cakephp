$('#evokation_div').pad({
	'host': 'http://198.50.155.101:2222',
	'padId': $('meta[name=padID]').attr('content'),
	'height': 1000,
	'showControls': true,
	'noColors': true,
	// 'showChat': true,
	// 'alwaysShowChat' : true,
	'userName': $('meta[name=userName]').attr('content'),
});