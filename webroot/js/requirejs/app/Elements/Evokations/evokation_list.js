require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery', 'foundation'], function ($) {
		$(document).ready(function(){
			//--------------------------------------------//
			//LOAD MORE EVokationS WHEN CLICKING BUTTON
			//--------------------------------------------//
			$("#btnLoadMoreEvokations").on("click", fillExtraContentEvokationList);

			//--------------------------------------------//
			//LOAD MORE EVokationS WHEN SCROLLING
			//--------------------------------------------//
			var evokation_list_has_ended = false; //nothing else to load
			var evokation_list_load_limit = parseInt(missions_evokation_list_load_limit); //how many results to bring every call
			var evokation_list_last = evokation_list_load_limit;//parseInt($('meta[name=lastEvokation]').attr('content')); //OFFSET (where to start again)

			//checking scrolling info to call ajax function
			$(window).scroll(throttle(function() {
				var space_for_loading_image = 150;

				if ($(window).scrollTop() >= $(document).height() - $(window).height() - space_for_loading_image) {
				// if ($(window).scrollTop() >= $(window).height() - space_for_loading_image) {
					if (evokation_list_has_ended == false) {
						fillExtraContentEvokationList();
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

			function fillExtraContentEvokationList(){
				$.ajax({
				    type: 'post',
				    url: missions_evokation_list_load_evokations_url+"&offset="+evokation_list_last+"&limit="+evokation_list_load_limit,

				    beforeSend: function(xhr) {
				        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				        $(".moreEvokationsLoading").removeClass("hidden");
				        $("#btnLoadMoreEvokations").addClass("hidden");
				    },
				    completed: function() {
				    	$(".moreEvokationsLoading").addClass("hidden");
				    	$("#btnLoadMoreEvokations").removeClass("hidden");
				    },
				    success: function(response) {
				    	if (response.length == 0) {
				    		evokation_list_has_ended = true;
				    		//Hide loading image
				    		$(".moreEvokationsLoading").addClass("hidden");
				    		//Hide button to load more evokations
				    		$("#btnLoadMoreEvokations").fadeOut();
				    	}
				    	else {
				    		//APPEND CONTENT
					        $('.evokations-list').append(response);

					        //UPDATE HEIGHT OF PARENT DIV
					        $("#missions-content-overlay").css("min-height",$('.evokations-list').height());

					        $(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax
					        evokation_list_last += evokation_list_load_limit;
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