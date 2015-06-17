require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery', 'foundation'], function ($) {
		$(document).ready(function(){
			//--------------------------------------------//
			//LOAD MORE EVIDENCES WHEN SCROLLING
			//--------------------------------------------//
			var evidence_list_has_ended = false; //nothing else to load
			var evidence_list_load_limit = parseInt(missions_evidence_list_load_limit); //how many results to bring every call
			var evidence_list_last = evidence_list_load_limit;//parseInt($('meta[name=lastEvidence]').attr('content')); //OFFSET (where to start again)

			//checking scrolling info to call ajax function
			$(window).scroll(throttle(function() {
				var space_for_loading_image = 150;

				if ($(window).scrollTop() >= $(document).height() - $(window).height() - space_for_loading_image) {
				// if ($(window).scrollTop() >= $(window).height() - space_for_loading_image) {
					if (evidence_list_has_ended == false) {
						fillExtraContentEvidenceList();
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

			function fillExtraContentEvidenceList(){
				$.ajax({
				    type: 'post',
				    url: missions_evidence_list_load_evidences_url+"&offset="+evidence_list_last+"&limit="+evidence_list_load_limit,

				    beforeSend: function(xhr) {
				        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				        $(".moreEvidencesLoading").removeClass("hidden");
				    },
				    completed: function() {
				    	$(".moreEvidencesLoading").addClass("hidden");
				    },
				    success: function(response) {
				    	if (response.length == 0) {
				    		evidence_list_has_ended = true;
				    		$(".moreEvidencesLoading").addClass("hidden");
				    	}
				    	else {
				    		//APPEND CONTENT
					        $('.evidences-list').append(response);

					        //UPDATE HEIGHT OF PARENT DIV
					        $("#missions-content-overlay").css("min-height",$('.evidences-list').height());

					        $(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax
					        evidence_list_last += evidence_list_load_limit;
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