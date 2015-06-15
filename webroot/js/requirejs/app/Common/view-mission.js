require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery', 'evoke', 'missionpanels', 'foundation', 'slickcarousel', 'stickykit', 'jqueryui'], function ($, evoke, missionPanels) {
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
			  	$('#page-number').empty().append(targetIndex+1);
			  },
			  onAfterChange: function(slider,index){
				//Carousel height is adaptative according to the currently displayed image (not the tallest image on the set)
				var img = jQuery(slider.$slides[index]).children('img');
			  	var sliderHeight = $(img).height();
			  	if (sliderHeight > 0) {
			  		jQuery(slider.$slider).height(sliderHeight);
			  		$('.slick-track').height(sliderHeight);
			  	}

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
			

			$('.menu-icon.default').click(function(){
				console.log('toggle panel');
				missionPanels.toggle_panel($(this).attr("id"), $(this).data('tab-content'));
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
				missionPanels.closeMissionOverlay();
			});

			//--------------------------------------------//
			//Close sidebar (mission content)
			//--------------------------------------------//
			$(".close-sidebar-button").click(function(){
				//Show content in front
				missionPanels.toggle_panel();

				//Not possible to close panel
				$(this).fadeOut("fast");
			});
			

			//--------------------------------------------//
			//OPEN LINK IN MISSION OVERLAY
			//Used for submitting evidences, brainstorm etc.
			//--------------------------------------------//
			$("body").on("click", ".button.open-mission-overlay", function(event){
				missionPanels.openInMissionOverlay($(this).attr("href"));
				event.preventDefault();
			});

			//--------------------------------------------//
			//EVIDENCE: ADD EVIDENCE FORM OPENS ON THE MISSION-OVERLAY ON THE LEFT
			//--------------------------------------------//
			var forum_general = null;
			var forum_group = null;

			var refreshForum = function(panel_button, panel_source, forum_id){
				//RELOAD EMBER FORUM
				if (!$("#"+panel_source).hasClass("panel-open")) {
					console.log(panel_source+' open');
					//Define root element 
					var rootElement = '#'+panel_source+' .optimum';

					require(['../Optimum/js/app'], function (OptimumForum) {
						// OptimumForum.initializeForum(rootElement);
						OptimumForum.App.DiscussionsRoute.reopen();
						// OptimumForum.App.PluginIntegration.transitionTo('discussions',forum_id);
					});
				}

				missionPanels.toggle_panel(panel_button, panel_source);
			};

			var initializeForum = function(forum_id, forum_url, forum_container, panel_button) {
				$.ajax({
					url: forum_url,
					type:"POST",
					data: {forum_id: forum_id},
					beforeSend: function() {
						$('#'+forum_container+' .content').empty().append(evoke.loadingAnimation);
					},
					success: function(data) {
						//Display content
						$('#'+forum_container).off(); //clear events in previous elements
						$('#'+forum_container+' *').off(); //clear events in previous elements
						$('#'+forum_container+' .content').html(data);

						//Reflow
						$(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax

						require(['../Optimum/js/app'], function (OptimumForum) {
							OptimumForum.App.PluginIntegration.transitionTo('discussions',forum_id);
						});

						refreshForum(panel_button, forum_container, forum_id);
						// require(['../Optimum/js/app'], function (OptimumForum) {
						// 	console.log('initialize with rootElement: '+rootElement);

						// 	OptimumForum.initializeForum(rootElement);
						// 	var forum = OptimumForum.getForum();
							
						// 	console.log(forum.rootElement);
						// 	console.log(forum_id);
						// 	forum.App.PluginIntegration.transitionTo('discussions',forum_id);

						// 	if (forum_container == "tabForum") {
						// 		forum_general = forum;
						// 	} else if (forum_container == "tabGroupForum") {
						// 		forum_group = forum;
						// 	}

						// 	// refreshForum(panel_button, forum_container);
						// });
					}
				});
			}

			$(".menu-icon.forum").one("click", function(event) {
				var button_id = $(this).attr("id");
				var forum_id = $(this).data("forum-id");
				var forum_url = $(this).data("forum-url");
				var forum_container = $(this).data('tab-content');

				initializeForum(forum_id,forum_url,forum_container,button_id);

				//Bind event so that it only refreshes in every click
				$(this).click(function(event){
					refreshForum(button_id, forum_container);
				});
				
				event.preventDefault();
			});


			//--------------------------------------------//
		    //BRAINSTORM BUTTONS CLICK - FAKE
		    //--------------------------------------------//

		    $("body").on( "click", ".horizontal_timeline .states .circle", function( event ) {
		    	$(".states.active").removeClass('active');

		    	var li = $(this).parents("li");
				var index = li.index() + 1;
				
				li.addClass('active');
				
				console.log(index);
				$('.horizontal_timeline .content').html($("#brainstorm_step"+index+"_description").html());
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