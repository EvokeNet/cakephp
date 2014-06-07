$(document).ready(function(){
	//For Gmail
	$('a.google_login').oauthpopup({
	    path: 'users/google',
	    width:650,
	    height:350,
	});
	$('a.google_logout').googlelogout({
	    redirect_url:'<?php echo BASE_URL; ?>logout.php?google'
	});
});