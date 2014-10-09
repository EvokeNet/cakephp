<?php
	//CSS overriding fullpage.js plugin
	$cssBaseUrl = Configure::read('App.cssBaseUrl');
	
	echo $this->Html->css('/components/slick-carousel/slick/slick.css');
	echo $this->Html->css('slick.css');
	?>

	<!-- TOPBAR MENU -->
	<div id="missions-menu" class="sticky fixed">
		<?php echo $this->element('topbar', array('sticky' => '', 'fixed' => '')); ?>
	</div>

	<div id="missions-body" class="missions">
		<div class="off-canvas-wrap" data-offcanvas>
			<div class="inner-wrap">
				<nav class="tab-bar full-height">
				  <section class="right-small text-center">
				    <a class="right-off-canvas-toggle menu-icon background-color-standard" href="#" data-tabname="tabQuests">
				    	<img class="evoke vertical-align-middle" src="<?= $this->webroot.'img/icon-quests-gray.png' ?>" alt="Quests" />
				    </a>
				    <a class="right-off-canvas-toggle menu-icon background-color-standard" href="#" data-tabname="tabDossier">
				    	<img class="evoke vertical-align-middle" src="<?= $this->webroot.'img/icon-dossier-gray.png' ?>" alt="Dossier" />
				    </a>
				    <a class="right-off-canvas-toggle menu-icon background-color-standard" href="#" data-tabname="tabEvidences">
				    	<img class="evoke vertical-align-middle" src="<?= $this->webroot.'img/icon-evidences-gray.png' ?>" alt="Evidences" />
				    </a>
				    <a class="right-off-canvas-toggle menu-icon background-color-standard" href="#" data-tabname="tabMenu">
				    	<i class="fa fa-th-large fa-2x text-color-gray vertical-align-middle"></i>
				    </a>
				  </section>
				</nav>

				<aside class="right-off-canvas-menu tabQuests">
					<div class="large-12 large-centered columns tabs-style-small-image right full-height overflow-hidden paddings-0">
						<!-- TABS COM MENU -->
						<dl class="tabs vertical full-height margin right-3 background-color-standard" data-tab>
						  <dd class="active"><a href="#panel1">Quest 1</a></dd>
						  <dd><a href="#panel2">Quest 2</a></dd>
						  <dd><a href="#panel3" class="deactivated">Quest 3</a></dd>
						  <dd><a href="#panel4">Quest 4</a></dd>
						</dl>
						<div class="tabs-content full-height">
						  <!-- TAB QUESTS -->
						  <div class="content active padding top-2 right-3" id="panel1">
						  	<h3 class="text-color-highlight text-center">QUEST 1</h3>
						    <p>Panel 1. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
						    <h3 class="text-color-highlight text-center">REWARDS</h3>
						    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
						    <p class="text-center">
						    	
						    	<img class="evoke vertical-align-middle" src="<?= $this->webroot.'img/badge1.png' ?>" alt="Quests" />
						    	<img class="evoke vertical-align-middle" src="<?= $this->webroot.'img/badge2.png' ?>" alt="Quests" />
						    	<img class="evoke vertical-align-middle" src="<?= $this->webroot.'img/badge3.png' ?>" alt="Quests" />
						    </p>
						  </div>

						  <!-- TAB DOSSIER -->
						  <div class="content" id="panel2">
						    <p>Panel 2. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
						  </div>

						  <!-- TAB EVIDENCES -->
						  <div class="content" id="panel3">
						    <p>Panel 3. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
						  </div>

						  <!-- TAB MENU -->
						  <div class="content" id="panel4">
						    <p>Panel 4. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
						  </div>
						</div>
					</div>
				</aside>

				<aside class="right-off-canvas-menu tabDossier">
					<div class="large-12 large-centered columns">
						
					</div>
				</aside>

				<section class="main-section">
					<!-- SUBMENU -->
					<div class="missions-submenu fixed hidden padding top-1 left-3">
						<h2 class="text-glow">Mission name here</h2>

						<!-- PROGRESS BAR -->
						<div class="button-bar phases-bar padding top-05 bottom-05">
							<ul class="button-group radius">
								<li><a href="#" class="button small thin past font-weight-bold"><i class="fa fa-flag fa-lg"></i> <?= __('Explore') ?></a></li>
								<li><a href="#" class="button small thin present font-weight-bold"><i class="fa fa-fighter-jet fa-lg"></i> <?= __('Imagine') ?></a></li>
								<li><a href="#" class="button small thin disabled font-weight-bold"><i class="fa fa-eye fa-lg"></i> <?= __('Act') ?></a></li>
								<li><a href="#" class="button small thin disabled font-weight-bold"><i class="fa fa-flash fa-lg"></i> <?= __('Evoke') ?></a></li>
							</ul>
						</div>
					</div>

					<!-- MISSOES -->
					<div class="section missions-content">
				    	<div class="row missions-carousel full-width">
				    		<!-- MISSAO 1 -->
						    <div>
						    	<img data-interchange="
					    			[<?= $this->webroot.'img/episodes-example/Evoke_00_Eng_0000_cover.jpg' ?>, (default)], 
					    			[<?= $this->webroot.'img/episodes-example/Evoke_00_Eng_0000_cover.jpg' ?>, (medium)],
					    			[<?= $this->webroot.'img/episodes-example/Evoke_00_Eng_0000_cover.jpg' ?>, (large)]"
					    			alt="<?php echo __('Mission 1 - Name'); ?>" class="full-width" />
								<noscript><img src="<?= $this->webroot.'img/episodes-example/Evoke_00_Eng_0000_cover.jpg' ?>" class="full-width" alt="<?php echo __('Mission 1 - Name'); ?>" /></noscript>
					    	</div>
					    	
					    	<!-- MISSAO 2 -->
					    	<div>
						    	<img src="<?= $this->webroot.'img/episodes-example/Evoke_00_Eng_0000_Pg01.jpg' ?>" class="full-width" alt="<?php echo __('Mission 1 - Name'); ?>" />
					    	</div>
				    	</div>

				    	<!-- NAVIGATION BAR -->
				    	<div id="navigationBar" class="evoke row full-width fixed sticky contain-to-grid padding top-1 bottom-1 text-center background-color-dark-opacity-05 bottom-0">
								<div class="small-12 medium-12 large-12 columns centering-block">
									<ul class="inline-list centered-block margins-0">
										<li><h5 class="text-glow">Mission name</h5></li>
										<li><div id="slickPrevArrow"></div></li>
										<li><h5 class="text-glow">Page 1</h5></li>
										<li><div id="slickNextArrow"></div></li>
										<li><div id="slickArrows"></div></li>
									</ul>
						    	</div>
				    	</div>
				    </div>
				</section>

				<a class="exit-off-canvas"></a>

			</div>
		</div>
	</div>

	<!-- FOOTER -->
	<?php
		$this->start('footer');
		echo $this->element('footer', array('fixed' => ''));
		$this->end();
	?>
	<!-- FOOTER -->

<?php 
		echo $this->Html->script('/components/jquery/dist/jquery.min.js');
		echo $this->Html->script("http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js");

		//SLICK CAROUSEL
		echo $this->Html->script('/components/slick-carousel/slick/slick.min.js');
		echo $this->Html->script('//code.jquery.com/jquery-migrate-1.2.1.min.js');

		//STICKY KIT
		echo $this->Html->script('/components/sticky-kit/jquery.sticky-kit.min.js');
		
		//FOUNDATION
		echo $this->Html->script('/components/foundation/js/foundation/foundation.js');
		echo $this->Html->script('/components/foundation/js/foundation/foundation.offcanvas.js');
		echo $this->Html->script('/components/foundation/js/foundation/foundation.accordion.js');
?>


	<!-- FullPage Login -->
	<script type="text/javascript">
		$(document).ready(function() {
			//Creates carousel
			$('.missions-carousel').slick({
			  slidesToShow: 1,
			  variableHeight: true,
			  responsive: true,
			  lazyLoad: 'progressive',
			  arrows: true
			});

			//Changes the position of the arrows
			$('#slickPrevArrow').append($('.slick-prev'));
			$('#slickNextArrow').append($('.slick-next'));

			//Adds margin so that the menu won't be on top of the container
			$('#missions-body').css("margin-top",$('#missions-menu').height());
			$('.missions-submenu').css("top",$('#missions-menu').height());


			//MULTIPLE OFFCANVAS
			$(".right-off-canvas-toggle").click(function(){
				//Show right offcanvas
				$(".right-off-canvas-menu").addClass("hidden");
        		$("." + $(this).data("tabname")).removeClass("hidden");
			});


			/*
			//http://blog.jonathanargentiero.com/?p=335
			//Using lazy load with foundation interchange
			function lazyInterchange(selector){
			       if($(selector).attr('data-lazy')){
			                $(selector).attr('data-interchange',$(selector).attr('data-lazy'));
			                $(document).foundation('reflow');
			                $(document).foundation('interchange', 'reflow');
			                $(selector).removeAttr('data-lazy');
			        }
			}

			lazyInterchange($('#my_element'));
			*/
		});

		//Sticky navigation bar, respecting parent element
		$(window).ready(function() {
			//$(".sticky").stick_in_parent();
			/*var offset_top = $(window).height() * 0.9;
			$("#navigationBar").css("top",offset_top+"px");
			$("#navigationBar").stick_in_parent({ parent: 'section', offset_top: offset_top })
	        .on("sticky_kit:stick", function(e) {
	        	//alert("STICKY");
	            $(e.target)
	            .css("top",0+"px")
	            //.css("margin-top","0")
	            //.velocity("transition.slideDownIn", { duration: 200 })
	            .on("sticky_kit:unstick", function(e) {
	            	//alert("UNSTICK");
	            	$(e.target)
	            	.css("top",offset_top+"px");
	            });
	        });

	        $(".sticky_column").stick_in_parent();*/
		});

		//OFF-CANVAS
		$(document)
			.foundation({
				offcanvas : {
					open_method: 'overlap',
					close_on_click : false
				}
			});

		$(document)
			.on('open.fndtn.offcanvas', '[data-offcanvas]', function() {
				$('.off-canvas-wrap .missions-content').addClass('blur-strong').addClass('opacity-05');
	    		$('div.missions-submenu').removeClass("hidden"); //Show submenu
	    		//$('.right-small').css("right",$('.right-off-canvas-menu').width());
	    		$('.right-small').css("transform",'translate3d(-'+$('.right-off-canvas-menu').width()+'px, 0, 0)'); //Off-canvas buttons go to the left
			});

		$(document)
			.on('close.fndtn.offcanvas', '[data-offcanvas]', function() {
				$('.off-canvas-wrap .missions-content').removeClass('blur-strong').removeClass('opacity-05');
				$('div.missions-submenu').addClass("hidden"); //Hide submenu
				//$('.right-small').css("right","0");
				$('.right-small').css("transform",'translate3d(0, 0, 0)'); //Off-canvas buttons go to the left
			});

	</script>
