require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery', 'foundation', 'slickcarousel', 'stickykit', 'sidr'], function ($) {
		$(document).ready(function(){
			//--------------------------------------------//
			//Top-bar margins
			//--------------------------------------------//
			//Adds margin so that the menu won't be on top of the container
			$('#missions-body').css("margin-top",$('#missions-menu').height());
			$('.missions-submenu').css("top",$('#missions-menu').height());

			//--------------------------------------------//
			//Creates carousel
			//--------------------------------------------//
			$('.missions-carousel').slick({
			  slidesToShow: 1,
			  variableHeight: true,
			  responsive: true,
			  lazyLoad: 'progressive',
			  arrows: true,
			  onInit: function(slider) {
			  	$('.slick-slide img:not(.slick-active)').addClass("hidden");
			  },
			  onBeforeChange: function(slider, currentIndex, targetIndex){
			  	//Hide previous image, so that it's height does not count in parent
			  	$('.slick-slide img').addClass("hidden");
			  	//Page number
			  	$('#page-number').html(targetIndex+1);
			  },
			  onAfterChange: function(slider,index){
			  	//Show this image
			  	$('.slick-active img').removeClass("hidden");
			  }
			});

			$('.missions-carousel').slickGoTo(0);

			//Changes the position of the arrows
			$('#slickPrevArrow').append($('.slick-prev'));
			$('#slickNextArrow').append($('.slick-next'));

			//--------------------------------------------//
			//Off canvas
			//--------------------------------------------//
			function open_sidr(sidr_button,sidr_source) {
				$(sidr_source).addClass("sidr-open");
				$(sidr_button+" span").addClass("text-color-highlight").removeClass("text-color-gray"); //Icon highlight
				$('.off-canvas-wrap .missions-content').addClass('blur-strong opacity-04'); //Blur everything else

				//Show submenu
				$('div.missions-submenu .content').css("margin-right",$(sidr_source).width()+100);
	    		$('div.missions-submenu').removeClass("hidden");

	    		//Position missions-content-overlay
	    		$('#missions-content-overlay').css("padding-right",$(sidr_source).width()+100);

	    		//Off-canvas buttons go to the left
	    		$('.right-small').css("right",$(sidr_source).width());
			}

			function close_sidr(sidr_button,sidr_source) {
				$(sidr_button+" span").removeClass("text-color-highlight").addClass("text-color-gray"); //Icon grey
				$('.off-canvas-wrap .missions-content').removeClass('blur-strong').removeClass('opacity-04'); //Blur everything else
				$('div.missions-submenu').addClass("hidden"); //Hide submenu
				$('#missions-content-overlay').addClass("hidden"); //Hide content overlay
				$("#missions-content-overlay").css("min-height","100%"); //Reset min-height that might have changed when loading content by scrolling down
				$('.right-small').css("right","0"); //Off-canvas buttons go back to the right
			}

			$('#menu-icon-tabQuests').sidr({
				name: 'sidr-tabQuests',
				side: 'right',
				source: '#tabQuests',

				displace: false, renaming: false,
				onOpen: function() { open_sidr('#menu-icon-tabQuests','#sidr-tabQuests'); },
				onClose: function() { close_sidr('#menu-icon-tabQuests','#sidr-tabQuests'); }
			});

			$('#menu-icon-tabDossier').sidr({
				name: 'sidr-tabDossier',
				side: 'right',
				source: '#tabDossier',
				displace: false, renaming: false,
				onOpen: function() { open_sidr('#menu-icon-tabDossier','#sidr-tabDossier'); },
				onClose: function() { close_sidr('#menu-icon-tabDossier','#sidr-tabDossier'); }
			});

			$('#menu-icon-tabEvidences').sidr({
				name: 'sidr-tabEvidences',
				side: 'right',
				source: '#tabEvidences',
				displace: false, renaming: false,
				onOpen: function() { open_sidr('#menu-icon-tabEvidences','#sidr-tabEvidences'); },
				onClose: function() { close_sidr('#menu-icon-tabEvidences','#sidr-tabEvidences'); }
			});

			$('#menu-icon-tabMenu').sidr({
				name: 'sidr-tabMenu',
				side: 'right',
				source: '#tabMenu',
				displace: false, renaming: false,
				onOpen: function() { open_sidr('#menu-icon-tabMenu','#sidr-tabMenu'); },
				onClose: function() { close_sidr('#menu-icon-tabMenu','#sidr-tabMenu'); }
			});


			//--------------------------------------------//
			//Top-bar margins
			//--------------------------------------------//
			//Adds margin so that the menu won't be on top of the container
			//$('.sidr').css("top",$('#missions-menu').height()); //NECESSARY IF BODY HAS OVERFLOW:AUTO

			//--------------------------------------------//
			//Close overlay button
			//--------------------------------------------//
			$(".close-missions-content-overlay").click(function(){
				//Hide content overlay
				$('#missions-content-overlay').addClass("hidden");

				//show mission submenu
				$('div.missions-submenu').removeClass("hidden");

				//Clear content-body and its events
				$('#missions-content-overlay-body').off(); //clear events in previous elements
				$('#missions-content-overlay-body *').off(); 
				$('#missions-content-overlay-body').html('');
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
						$('#missions-content-overlay').removeClass("hidden");
						$('div.missions-submenu').addClass("hidden");
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
			//EVIDENCE: SUBMITTING A FORM TO ADD AN EVIDENCE LOADS EVIDENCE VIEW VIA AJAX
			//--------------------------------------------//
			$("#missions-content-overlay").on("submit", "form.formSubmitEvidence", function( event ) {
				$.ajax({
					data: $(this).serialize(), // get the form data
					type: $(this).attr('method'), // GET or POST
					url: $(this).attr('action'), // the file to call
					success: function(response) {
						//Go to the top of the page
						$("html, body").animate({
							scrollTop: 0
						}, 300);

						//Display content
						$('#missions-content-overlay-body').off(); //clear events in previous elements
						$('#missions-content-overlay-body *').off(); //clear events in previous elements
						$('#missions-content-overlay-body').html(response);

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