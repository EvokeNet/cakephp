define(['facebook'], function(){
	FB.init({
		appId: '666636333396015',
	});

	window.fbShare = function(shared_link_URL) {
		FB.ui({
		  method: 'share',
		  href: shared_link_URL
		}, function(response){});
	};
});