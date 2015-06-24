require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery','jqueryui'], function ($) {
		$(document).ready(function(){
			//--------------------------------------------//
			//Checkbox glows when selected
			//--------------------------------------------//
			$("input[type=checkbox]").on( "click", function(){
				if ($(this).hasClass('img-glow-small')) {
					$(this).removeClass('img-glow-small');
					$("label[for='"+$(this).attr("id")+"']").removeClass('text-glow');
				}
				else {
					$(this).addClass('img-glow-small');
					$("label[for='"+$(this).attr("id")+"']").addClass('text-glow');
				}
			});

			//--------------------------------------------//
			//Sortable list with drag and drop effect
			//--------------------------------------------//
			$( ".sortable" ).sortable();
			$( ".sortable" ).disableSelection();
		});
	});
});