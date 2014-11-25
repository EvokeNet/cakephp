require(['../requirejs/bootstrap'], function () {
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
				$('#missions-content-overlay').addClass("hidden"); //Hide content overlay
				$('div.missions-submenu').removeClass("hidden"); //show mission submenu

			});

			//--------------------------------------------//
			//SUBMIT EVIDENCE BUTTON
			//--------------------------------------------//
			$(".submit-evidence.button").click(function(){				
				var evidence = $(".evidence-quest-" + $(this).data("quest-id"));
				if ($(".evidence-quest-" + $(this).data("quest-id")).hasClass("hidden")) {
        			$(".evidence-quest-" + $(this).data("quest-id")).removeClass("hidden");
				} else {
					$(".evidence-quest-" + $(this).data("quest-id")).addClass("hidden");
				}
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