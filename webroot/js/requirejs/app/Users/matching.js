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

			$("#sendAnswers").on("click", function(){
				$('a.close-reveal-modal').trigger('click');
			});

			$(".nextQuestion").on("click", function(){
				// fake a submition to trigger foundation abide validation
				$('#questionsForm').trigger('submit');

				var counter = $('#questionCounter').text();
				var total   = parseFloat($('#totalQuestions').text());
				console.log("Count: "+counter);
				// change question counter
				$('#questionCounter').html(++counter);
				// increase progress bar
				$('.meter').css('width', (parseFloat(counter-1)/total*100)+'%');
			});


			$('#questionsForm')
		  		.on('invalid', function () {
		    		if( $('div[class|="field"]:not(.hidden)').find('[data-invalid]').length == 0){
		    			$('div[class|="field"]:not(.hidden)').addClass('hidden').next().removeClass('hidden');
		    			$('small.error').css('display', 'none');
		    		}else{
		    			$('small.error').css('display', 'block');
		    		}
		  		})
		  		.on('valid', function () {
		  			$('div[class|="field"]:not(.hidden)').addClass('hidden').next().removeClass('hidden');
		    		console.log('valid!');
		  	});
			//--------------------------------------------//
			//Sortable list with drag and drop effect
			//--------------------------------------------//
			$( ".sortable" ).sortable();
			$( ".sortable" ).disableSelection();
		});
	});
});