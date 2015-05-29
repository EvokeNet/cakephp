define(['jquery','sweetalert', 'jqueryajaxretry'], function($,swal){
	$.ajaxPrefilter(function(opts, originalOpts, jqXHR) {
		if (opts.refreshRequest) {
			return;
		}

		opts.refreshRequest = true;

		if(!opts.times) {
			jqXHR.retry({times:3})
				.fail(function(){
					if (jqXHR.status === 401) {
						swal("Oops...", 'Your session has expired. Please sign in again.', "error");
					}
					else {
						swal("Oh no!", 'Sorry, we could not retrieve this page. Please try again.', "error");
					}
				});
		}
	});
});