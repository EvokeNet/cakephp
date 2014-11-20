//--------------------------------------------//
//FACEBOOK SHARE
//--------------------------------------------//
window.fbAsyncInit = function() {
    FB.init({
      appId: '<?php echo $facebook->getAppID() ?>',
      cookie: true,
      xfbml: true,
      oauth: true
    });
};

function fbShare(shared_link_URL) {
	FB.ui({
	  method: 'share',
	  href: shared_link_URL
	}, function(response){});
}

//--------------------------------------------//
//REFLOW FOUNDATION after page has loaded
//--------------------------------------------//
//$(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax

//--------------------------------------------//
//FROALA EDITOR
//--------------------------------------------//
$('#newCommentForm').editable({
	inlineMode: false,
	tabSpaces: true,
	theme: 'dark'
});