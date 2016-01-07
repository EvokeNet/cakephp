define(['jquery','sweetalert', 'jqueryajaxretry', 'i18next'], function($,swal){
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
						swal(i18n.t("modules.ajax_retry.session_expired.title"),
							i18n.t("modules.ajax_retry.session_expired.text"),
							"error"
						);
					}
					//General errors
					else {
						swal(i18n.t("modules.ajax_retry.retrieve_error.title"),
							i18n.t("modules.ajax_retry.retrieve_error.text"),
							"error"
						);
					}
				});
		}
	});
});