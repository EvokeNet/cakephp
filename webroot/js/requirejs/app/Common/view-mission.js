require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery', 'foundation', 'slickcarousel', 'stickykit', 'jqueryui'], function ($) {
		$(document).ready(function(){
			//--------------------------------------------//
			//Top-bar margins
			//--------------------------------------------//
			//Adds margin so that the menu won't be on top of the container
			$('.main-section').css("padding-top",$('#missions-menu').height());
			$('.close-sidebar-button').css("top",$('#missions-menu').height()+40);

			//--------------------------------------------//
			//Creates carousel
			//--------------------------------------------//
			$('.missions-carousel').slick({
			  slidesToShow: 1,
			  responsive: true,
			  slidesToShow: 1,
			  lazyLoad: 'progressive',
			  arrows: true,
			  onInit: function(slider) {
			  },
			  onBeforeChange: function(slider, currentIndex, targetIndex){
			  	//Page number
			  	$('#page-number').html(targetIndex+1);
			  },
			  onAfterChange: function(slider,index){
				//Carousel height is adaptative according to the currently displayed image (not the tallest image on the set)
				var img = jQuery(slider.$slides[index]).children('img');
			  	var sliderHeight = $(img).height();
			  	jQuery(slider.$slider).height(sliderHeight);
			  	$('.slick-track').height(sliderHeight);

			  	//Go to the top of the page
				$("html, body").animate({
					scrollTop: 0
				}, 300);
			  }
			});

			$('.missions-carousel').slickGoTo(0);

			//Changes the position of the arrows
			$('#slickPrevArrow').append($('.slick-prev'));
			$('#slickNextArrow').append($('.slick-next'));

			//Hide sidebar content with jquery (so that it can be shown afterwards)
			$('#missionSidebar').hide().removeClass("hidden");
			$('.tabContent').hide().removeClass("hidden");
			$('#missions-content-overlay').hide().removeClass("hidden");
			$('.close-sidebar-button').hide().removeClass("hidden");


			//--------------------------------------------//
			//Open mission content above graphic novel
			//--------------------------------------------//
			function open_sidr(sidr_button,sidr_source) {
				$(sidr_source).addClass("sidr-open");

				//Add opacity behind
				$(sidr_button+" span").addClass("text-color-highlight").removeClass("text-color-gray"); //Icon highlight
				$('.main-section .missions-graphic-novel').addClass('blur-strong opacity-04'); //Blur everything else
				
				//Show content in front
				$('.mission-sidebar').css("height",""); //restart data-equalizer of the sidebar columns
				$('#missionSidebar').show("slide", { direction: "left" }, 400, function(){
					$(sidr_source).fadeIn('fast');
					$(document).foundation('equalizer', 'reflow'); //data-equalizer for sidebar columns
				});

				//Possible to close sidr
				$('.close-sidebar-button').fadeIn('fast');
			}

			function close_sidr(sidr_button,sidr_source,changingTabs) {
				$(sidr_source).removeClass("sidr-open");

				//Show content in front
				$(sidr_source).fadeOut('fast');
				$('#missionSidebar').hide("slide", { direction: "left" }, 0, function() {
					$(sidr_button+" span").removeClass("text-color-highlight").addClass("text-color-gray"); //Icon grey

					if (!changingTabs) {
						//Remove opacity behind
						$('.main-section .missions-graphic-novel').removeClass('blur-strong opacity-04'); //Remove blur in everything else
					}
				});

				//Not possible to close sidr
				$('.close-sidebar-button').fadeOut('fast');
			}

			/* Open or close a sidr */
			function toggle_sidr(idMenuIcon,idTabContent) {
				var changingTabs = false;

				//Closing a currently open tab
				if ((idTabContent != undefined) && !$('#'+idTabContent).hasClass("sidr-open")) {
					changingTabs = true;
				}

				//Close currently open tab (if any)
				var open_tab = $('.sidr-open');
				if ($(open_tab).length) {
					var open_tab_id = $(open_tab).attr('id');
					close_sidr('#menu-icon-'+open_tab_id,'#'+open_tab_id,changingTabs);
				}

				//Opening another tab
				if (changingTabs) {
					open_sidr('#'+idMenuIcon,'#'+idTabContent);	
				}
			}

			$('.menu-icon').click(function(){
				toggle_sidr($(this).attr("id"), $(this).data('tab-content'));
			});

			//--------------------------------------------//
			//Top-bar margins
			//--------------------------------------------//
			//Adds margin so that the menu won't be on top of the container
			var left_small_margin_top = - $('#menu-left-small').height() / 2;
			$('#menu-left-small').css("margin-top",left_small_margin_top); //NECESSARY IF BODY HAS OVERFLOW:AUTO

			//--------------------------------------------//
			//Close overlay button
			//--------------------------------------------//
			$(".close-missions-content-overlay").click(function(){
				//Hide content overlay and show tab-bar and main section
				$('.main-section').removeClass("hidden");
				$('.tab-bar').removeClass("hidden");
				$('.close-sidebar-button').fadeIn("hidden");
				$('#missions-content-overlay').fadeOut('fast');

				//Clear content-body and its events
				$('#missions-content-overlay-body').off(); //clear events in previous elements
				$('#missions-content-overlay-body *').off(); 
				$('#missions-content-overlay-body').html('');
			});

			//--------------------------------------------//
			//Close sidebar (mission content)
			//--------------------------------------------//
			$(".close-sidebar-button").click(function(){
				//Show content in front
				toggle_sidr();

				//Not possible to close sidr
				$(this).fadeOut("fast");
			});
			

			//--------------------------------------------//
			//EVIDENCE: ADD EVIDENCE FORM OPENS ON THE MISSION-OVERLAY ON THE LEFT
			//--------------------------------------------//
			$(".submit-evidence.button").click(function(event){
				$.ajax({
					url: $(this).attr("href")+"/true",
					type:"POST",
					beforeSend: function() {
						$('#missions-content-overlay .content-body').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>');
						$('#missions-content-overlay').fadeIn('slow');
						$('.main-section').addClass("hidden");
						$('.tab-bar').addClass("hidden");
						$('.close-sidebar-button').fadeOut("fast");
					},
					success: function(data) {
						//Go to the top of the page
						$("html, body").animate({
							scrollTop: 0
						}, 300);

						//Display content
						$('#missions-content-overlay-body').off(); //clear events in previous elements
						$('#missions-content-overlay-body *').off(); //clear events in previous elements
						$("#missions-content-overlay-body").html(data);

						//Reflow
						$(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax
					}
				});
				event.preventDefault();
			});
		    
			//--------------------------------------------//
		    //REFLOW FOUNDATION - After setting up slick (or generating any other elements), foundation needs to be updated
		    //--------------------------------------------//
			$(document).foundation('reflow');

			
			/*
			//http://blog.jonathanargentiero.com/?p=335
			//Using lazy load with foundation interchange
			function lazyInterchange(selector){
			       if($(selector).attr('data-lazy')){
			                $(selector).attr('data-interchange',$(selector).attr('data-lazy'));
			                $(document).foundation('reflow');
			                $(selector).removeAttr('data-lazy');
			        }
			}

			lazyInterchange($('#my_element'));
			*/
		});
	});
});