require(['../requirejs/bootstrap'], function (bootstrap) {
	require(['jquery'], function ($) {
		//ADD ALLY VIA AJAX
		$('.addally').on('click', function() {
			//Action is on a.href
			if ($(this).attr('href') != "#") {
			    $(this).load(
			        $(this).attr('href') 
			    	, function () {
			        $(this).html("<?= __('Congratulations! The user has been added.') ?>");
			        $(this).attr('href','#');
			    }); 
			}
		    // Prevent link going somewhere
		    return false; 
		});
	});
});