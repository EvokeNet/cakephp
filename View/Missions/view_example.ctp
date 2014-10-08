<?php
	//CSS overriding fullpage.js plugin
	$cssBaseUrl = Configure::read('App.cssBaseUrl');
	//echo $this->Html->css('fullpage.css');
	
	echo $this->Html->css('/components/slick-carousel/slick/slick.css'); //FullPage plugin para fazer scroll em secoes

	//$this->extend('/Common/login-topbar');

	//$this->start('menu');
	//$this->end(); 
?>
	<!-- BARRA APOS MENU -->
	<div class="sticky">
		Mission Social Innovation (barra de progresso) (botao para quests)
	</div>

	<div class="evoke">
		<!-- MISSOES -->
		<div class="section">
	    	<div class="row missions-carousel full-width">
	    		<!-- MISSAO 1 -->
			    <div>
			    	<img data-interchange="
		    			[<?= $this->webroot.'/img/episodes-example/Evoke_00_Eng_0000_cover.jpg' ?>, (default)], 
		    			[<?= $this->webroot.'/img/episodes-example/Evoke_00_Eng_0000_cover.jpg' ?>, (medium)],
		    			[<?= $this->webroot.'/img/episodes-example/Evoke_00_Eng_0000_cover.jpg' ?>, (large)]"
		    			alt="<?php echo __('Mission 1 - Name'); ?>" class="full-width" />
					<noscript><img src="<?= $this->webroot.'/img/episodes-example/Evoke_00_Eng_0000_cover.jpg' ?>" alt="<?php echo __('Mission 1 - Name'); ?>" /></noscript>
		    	</div>
		    	
		    	<!-- MISSAO 2 -->
		    	<div>
			    	<img src="<?= $this->webroot.'/img/episodes-example/Evoke_00_Eng_0000_Pg01.jpg' ?>" alt="<?php echo __('Mission 1 - Name'); ?>" />
		    	</div>
	    	</div>
	    </div>
	</div>



<?php 
		echo $this->Html->script('/components/jquery/dist/jquery.min.js');
		echo $this->Html->script("http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js");

		//SLICK
		echo $this->Html->script('/components/slick-carousel/slick/slick.min.js');
		echo $this->Html->script('//code.jquery.com/jquery-migrate-1.2.1.min.js');
?>


	<!-- FullPage Login -->
	<script type="text/javascript">
		$(document).ready(function() {
			//Creates carousel
			$('.missions-carousel').slick({
			  slidesToShow: 1,
			  variableHeight: true,
			  responsive: true,
			  lazyLoad: 'progressive'
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
	</script>
