require(['../requirejs/bootstrap'], function () {
	require(['jquery', 'foundation'], function ($) {
		$(document).ready(function(){
			//--------------------------------------------//
			//LOAD MORE EVIDENCES WHEN SCROLLING
			//--------------------------------------------//
			var last = parseInt($('meta[name=lastEvidence]').attr('content')); //OFFSET (where to start again)
			var has_ended = false; //nothing else to load
			var load_limit = missions_evidence_list_load_limit; //how many results to bring every call
			var target = 'moreEvidencesTarget'; //basis for the scroll

			//checking scrolling info to call ajax function
			$(window).scroll(throttle(function() {
				var space_for_loading_image = 100;

				if ($(window).scrollTop() >= $(document).height() - $(window).height() - space_for_loading_image) {
					alert('teste');
					if (has_ended == false) {
						fillExtraContent();
					}
				}
			}, 600));

			function throttle(fn, threshhold, scope) {
			  	threshhold || (threshhold = 250);
			  	var last,
			    	deferTimer;
			  	return function () {
			    	var context = scope || this;

			    	var now = +new Date,
			    	    args = arguments;
			    	if (last && now < last + threshhold) {
			    	  // hold on to it
			    		clearTimeout(deferTimer);
			    		deferTimer = setTimeout(function () {
			    	    	last = now;
			        		fn.apply(context, args);
			      		}, threshhold);
			    	} else {
			    		last = now;
			      		fn.apply(context, args);
			    	}
			  	};
			}


			function fillExtraContent(){
				$.ajax({
				    type: 'post',
				    url: missions_evidence_list_load_evidences_url+last,

				    beforeSend: function(xhr) {
				        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				        $(".moreEvidencesLoading").removeClass("hidden");
				    },
				    completed: function() {
				    	$(".moreEvidencesLoading").addClass("hidden");
				    },
				    success: function(response) {
				    	if (response.length == 0) {
				    		has_ended = true;
				    		$(".moreEvidencesLoading").addClass("hidden");
				    	}
				    	else {
					        $('.evidences-list').append(response);
					        $(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax
					        last += load_limit;
					    }
				    },
				    error: function(e) {
				        console.log(e);
				    }
				});
			}
		});
	});
});