define(['jquery','sweetalert', 'jqueryajaxretry'], function($,swal){
	$.ajaxPrefilter(function(opts, originalOpts, jqXHR) {
		//Avoiding infinite loop in case the same request is refreshed
		if (opts.refreshRequest) {
			return;
		}

		opts.refreshRequest = true;

		//If retrying is not specified in the ajax request, this is the default behavior
		if(!opts.times) {
			//Trying 3 times, with the jquery ajax retry plugin
			jqXHR.retry({times:3})
				.fail(function(){
					//Session expired
					if (jqXHR.status === 401) {
						swal("Oops...", 'Your session has expired. Please sign in again.', "error");
					}
					//General errors
					else {
						swal("Oh no!", 'Sorry, we could not retrieve this page. Please try again.', "error");
					}
				});
		}
	});
});