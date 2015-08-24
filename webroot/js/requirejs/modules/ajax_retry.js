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
						swal("Vaya...", 'Su sesion ha terminado. Por favor, iniciar sesion de nuevo.', "error");
					}
					//General errors
					else {
						swal("Oh no!", 'Lo sentimos, no hemos podido recuperar esta pagina. Por favor, vuelva a intentarlo.', "error");
					}
				});
		}
	});
});