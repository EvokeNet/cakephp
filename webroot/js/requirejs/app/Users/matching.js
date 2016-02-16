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

			$('#matchingStart').on('click', function(){
				$('#matchingInfo').addClass('hidden');
				$('#questionsModal').removeClass('hidden');
			});

			$("#sendAnswers").on("click", function(){
				$('a.close-reveal-modal').trigger('click');
			});

			$(".nextQuestion").on("click", function(){
				// fake a submition to trigger foundation abide validation
				$('#questionsForm').trigger('submit');
			});

			$("input[type=radio]").on( "click", function(){
				console.log($(this).attr("id"))
				$("label").removeClass('question-block-selected').addClass('question-block');
				$("label[id='"+$(this).attr("id")+"']").removeClass('question-block').addClass('question-block-selected');
			});

			$('#questionsForm')
		  		.on('invalid', function () {

		  			console.log('invalid!');
		    		if( $('div[class|="field"]:not(.hidden)').find('[data-invalid]').length == 0){
		    			$('div[class|="field"]:not(.hidden)').addClass('hidden').next().removeClass('hidden');
		    			$('small.error').css('display', 'none');

		    			var counter = $('#questionCounter').text();
						var total   = parseFloat($('#totalQuestions').text());

						// change question counter
						$('#questionCounter').html(++counter);

						console.log($("ul#timeline").children('li').length)
						console.log(counter)

						// Shows current quetsion in timeline
						for(var i = 1; i <= counter; i++){
							$('#circle-'+counter).addClass('complete')
							console.log(counter)
						}

						$( "input" ).on( "click", function() {
						  //alert( $( "input:checked" ).val() + " is checked!" );
						});

						//var elems = $( "input[id^='UserMatchingAnswerMatchingAnswer")

						/*elems.each( function() {
							console.log($(this.id).prop("checked"))
							console.log(this.id)
								if($(this.id).prop("checked")){
									console.log('ioueriuotreuioertuiorteuio')
									$(this.id).removeClass('question-block').addClass('question-block-selected')
								}
						});*/

						// increase progress bar
						$('#questionsModal .meter').css('width', (parseFloat(counter-1)/total*100)+'%');
		    		}else{
		    			$('small.error').css('display', 'block');
		    		}
		  		})
		  		.on('valid', function () {
		  			$('div[class|="field"]:not(.hidden)').addClass('hidden').next().removeClass('hidden');

		  			var counter = $('#questionCounter').text();
					var total   = parseFloat($('#totalQuestions').text());

					// change question counter
					$('#questionCounter').html(++counter);
					// increase progress bar
					$('#questionsModal .meter').css('width', (parseFloat(counter-1)/total*100)+'%');
		    		console.log('valid!');
		  	});
			//--------------------------------------------//
			//Sortable list with drag and drop effect
			//--------------------------------------------//
			$(function() {
			    $( ".sortable" ).sortable({
			    	stop: function( event, ui ) {
			        	var ul = $(ui.item[0]).parent();
			       		ul.find('li:not(.ui-sortable-placeholder)').each(function( index, element ) {
			        		var inputName = $(element).data('sort');
			          		//console.log($(this).parent().parent().find('input[data-answer-id="' + inputName + '"]'));
			        		$(this).parent().parent().find('input[data-answer-id="' + inputName + '"]').attr('value', index+1);
			        	});
			      	}
				});
				$( ".sortable" ).disableSelection();
			});
		});
	});
});
