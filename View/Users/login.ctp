<?php
	//CSS overriding fullpage.js plugin
	$cssBaseUrl = Configure::read('App.cssBaseUrl');
	echo $this->Html->css('/components/fullpage.js/jquery.fullPage.css'); //FullPage plugin para fazer scroll em secoes
	echo $this->Html->css('fullpage.css');

	echo $this->element('topbar');
?>

	<div class="evoke login fullpage">
		<div class="section">
	    	<div class="row full-width full-height missions-carousel">


	    		<?php foreach($missions as $mission): ?>

	    		<!-- MISSAO 1 -->
			    <div class="evoke slide background-cover full-width" data-interchange="
		    			[<?= $this->webroot.'img/mission_1_NameMission-default.png' ?>, (default)], 
		    			[<?= $this->webroot.'img/mission_1_NameMission-medium.png' ?>, (medium)],
		    			[<?= $this->webroot.'img/mission_1_NameMission-large.jpg' ?>, (large)]">
					<noscript><img src="<?= $this->webroot.'img/mission_1_NameMission-medium.png' ?>" alt="<?= $mission['Mission']['title'] ?>"></noscript>

					<div class="table full-width full-height"><div class="table-cell vertical-align-bottom">
						<div class="evoke padding top-1 bottom-1 left-5 right-5 background-color-dark-opacity-05">
							<a href="<?= $this->Html->url(array('controller' => 'missions', 'action' => 'view_sample', $mission['Mission']['id']))?>">
								<h2 class="text-color-important"><?= $mission['Mission']['title'] ?></h2>
								<p><?= $mission['Mission']['description'] ?></p>
							</a>
						</div></div>
					</div>
		    	</div>
		    	
		    	<?php endforeach; ?>
	    	</div>
	    </div>
	    
	    <div class="section evoke login gradient-on-top padding top-2">
	    	<div class="row small-width text-center">
		    	<h1 class="text-color-important text-center margin bottom-1"><?php echo __('What is Evoke?'); ?></h1>
				<!-- <p class="font-size-important"><?php echo __('Welcome to the Evoke network!'); ?></p> -->
				<p class="font-size-important"><?php echo __('Welcome to the Evoke network! If you have found this message, it is your destiny to join us. Evoke is your gateway to solving the world’s greatest challenges.'); ?>
					<?php echo __('As an Evoke agent, you will choose your mission, develop your powers, and together will agents around the world create your <strong>own world changing idea</strong>.'); ?></p>
			</div>
	    </div>
	    <div class="section evoke login gradient-on-top padding top-2">
	    	<div class="row small-width text-center">
		    	<h2 class="text-color-important text-center margin bottom-1"><?php echo __('Why was Evoke created?'); ?></h2>
		    	<p class="font-size-important"><?php echo __('The Evoke network was created to identify voices that are not heard and to give them the tools and support to change their community, their world.  The network believes that every individual can make a difference and when connected to others, change the world.'); ?></p>
			</div>
	    </div>
	    <div class="section evoke gradient-on-top padding top-2">
	    	<div class="row standard-width full-height centering-block table padding top-2 text-center">
		    	<h2 class="text-color-important text-center margin bottom-1"><?php echo __('Gameplay'); ?></h2>

				<div class="evoke small-block-grid-5 tabs-style-linetriangle centered-block">
					<ul id="tabs-gameplay" class="tabs" data-tab role="tablist">
						<li class="tab-title active" role="presentational">
							<a href="#panelMissions" role="tab" aria-selected="true" controls="panelMissions">
								<div class="tab-image centered-block img-circular">
									<img class="evoke img-circular vertical-align-middle not-active hidden border-width-02 border-style-solid border-color-highlight padding all-1"
										src="<?= $this->webroot.'img/icon-missions.png' ?>" alt="<?php echo __('Missions'); ?>" />
									<img class="evoke img-circular vertical-align-middle active img-glow"
										src="<?= $this->webroot.'img/thumb-missions.jpg' ?>" alt="<?php echo __('Missions'); ?>" />
								</div>
								<h5 class="text-color-important text-glow"><?php echo __('Missions'); ?></h5>
							</a>
						</li>
						<li class="tab-title" role="presentational">
							<a href="#panelQuests" role="tab" aria-selected="false" controls="panelQuests">
								<div class="tab-image centered-block img-circular">
									<img class="evoke img-circular vertical-align-middle not-active border-width-02 border-style-solid border-color-highlight padding all-1"
										src="<?= $this->webroot.'img/icon-quests.png' ?>" alt="<?php echo __('Quests'); ?>" />
									<img class="evoke img-circular vertical-align-middle active img-glow hidden"
										src="<?= $this->webroot.'img/thumb-quests.jpg' ?>" alt="<?php echo __('Quests'); ?>" />
								</div>
								<h5 class="text-color-important"><?php echo __('Quests'); ?></h5>
							</a>
						</li>
						<li class="tab-title" role="presentational">
							<a href="#panelEvidences" role="tab" aria-selected="true" controls="panelEvidences">
								<div class="tab-image centered-block img-circular">
									<img class="evoke img-circular vertical-align-middle not-active border-width-02 border-style-solid border-color-highlight padding all-1"
										src="<?= $this->webroot.'img/icon-evidences.png' ?>" alt="<?php echo __('Evidences'); ?>" />
									<img class="evoke img-circular vertical-align-middle active img-glow hidden"
										src="<?= $this->webroot.'img/thumb-evidences.jpg' ?>" alt="<?php echo __('Evidences'); ?>" />
								</div>
								<h5 class="text-color-important"><?php echo __('Evidences'); ?></h5>
							</a>
						</li>
						<li class="tab-title" role="presentational">
							<a href="#panelBadges" role="tab" aria-selected="false" controls="panelBadges">
								<div class="tab-image centered-block img-circular">
									<img class="evoke img-circular vertical-align-middle not-active border-width-02 border-style-solid border-color-highlight padding all-1"
										src="<?= $this->webroot.'img/icon-badges.png' ?>" alt="<?php echo __('Badges'); ?>" />
									<img class="evoke img-circular vertical-align-middle active img-glow hidden"
										src="<?= $this->webroot.'img/thumb-badges.jpg' ?>" alt="<?php echo __('Badges'); ?>" />
								</div>
								<h5 class="text-color-important"><?php echo __('Badges'); ?></h5>
							</a>
						</li>
						<li class="tab-title" role="presentational">
							<a href="#panelPower" role="tab" aria-selected="false" controls="panelPower">
								<div class="tab-image centered-block img-circular">
									<img class="evoke img-circular vertical-align-middle not-active border-width-02 border-style-solid border-color-highlight padding all-1"
										src="<?= $this->webroot.'img/icon-powers.png' ?>" alt="<?php echo __('Powers'); ?>" />
									<img class="evoke img-circular vertical-align-middle active img-glow hidden"
										src="<?= $this->webroot.'img/thumb-powers.jpg' ?>" alt="<?php echo __('Powers'); ?>" />
								</div>
								<h5 class="text-color-important"><?php echo __('Powers'); ?></h5>
							</a>
						</li>
					</ul>
				</div>
				<div class="tabs-content text-left padding top-2">
					<section role="tabpanel" aria-hidden="false" class="content active" id="panelMissions">
						<p class="font-size-important"><?php echo __('As an Evoke agent you are presented with a range of missions that reflect the greatest challenges our world faces – from hunger, to sustainable energy, to clean water and literacy.  As an agent you are called upon to explore these challenges, imagine a better world, act to change the world, and evoke your own solution.'); ?></p>
					</section>
					<section role="tabpanel" aria-hidden="true" class="content" id="panelQuests">
						<p class="font-size-important"><?php echo __('Each mission will present a set of quests that will give you powers as an agent.  Each quest will move you toward your understanding of the mission challenge, to learn how others are addressing it and how you as an agent can reshape our world.'); ?></p>
					</section>
					<section role="tabpanel" aria-hidden="true" class="content" id="panelEvidences">
						<p class="font-size-important"><?php echo __('Evidence is what you do.  For each quest, you will be asked to post your evidence to the Evoke Network in the form of a blog, video, or photo.  Your evidence will be reviewed by the entire network and you will receive comments and power points.'); ?></p>
					</section>
					<section role="tabpanel" aria-hidden="true" class="content" id="panelBadges">
						<p class="font-size-important"><?php echo __('Powers are what you give and earn through your participation in the network and your response to quests.  An Evoke agent aims to be a creative visionary, a deep collaborator, a systems thinker, and a social activist.  Powers you earn will build your skills in these areas.'); ?></p>
					</section>
					<section role="tabpanel" aria-hidden="true" class="content" id="panelPower">
						<p class="font-size-important"><?php echo __('As you gain strength and earn powers, you will earn badges – the official recognition of the Evoke network that you have developed the skills and the fortitude to become an agent capable of changing the world.'); ?></p>
					</section>
				</div>
			</div>
	    </div>
	    <div class="section evoke gradient-on-top padding top-2">
	    	<div class="row small-width text-center">
	    		<h2 class="text-color-important text-center margin bottom-1"><?php echo __('Who is behind Evoke?'); ?></h2>
		    	<p class="font-size-important"><?php echo __('Evoke is an innovation project of the World Bank in collaboration with partners around the world.'); ?></p>
		    </div>
	    </div>
	    <div class="section evoke gradient-on-top padding top-2">
	    	<div class="row small-width text-center">
	    		<h2 class="text-color-important text-center margin bottom-1"><?php echo __('How to become an agent?'); ?></h2>
		    	 <p class="font-size-important"><?php echo __('If you have found this message, it is your destiny to follow us.  To start your journey toward becoming an Evoke Agent, you simply need to engage by providing your information here.'); ?></p>
		    </div>

		    <!-- FOOTER -->
			<?php
				echo $this->element('footer', array('fixed' => '', 'absolute' => 'absolute'));
			?>
			<!-- FOOTER -->
	    </div>
	</div>



<!-- SCRIPT -->
<?php
		echo $this->Html->script('/components/jquery/dist/jquery.min.js');
		echo $this->Html->script("http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js");

		//FULLPAGE
		echo $this->Html->script('/components/fullpage.js/jquery.fullPage.js');
		echo $this->Html->script('/components/fullpage.js/vendors/jquery.easings.min.js');
		echo $this->Html->script('/components/fullpage.js/vendors/jquery.slimscroll.min.js');
?>


	<!-- FullPage Login -->
	<script type="text/javascript">
		$(document).ready(function() {
			/* Cria a full page */
			if ($('.fullpage').length) {
			    $('.fullpage').fullpage({
			    	verticalCentered: true,
			    	paddingTop: ($('#top-bar-login').height()*(-1.3)).toString()+"px",
			    	paddingBottom: ($('#top-bar-login').height()*1.3).toString()+"px",
			        resize : true,
			        scrollOverflow: true,
			        fixedElements: '#top-bar-login',
					navigation: true,
					navigationTooltips: ["<?php echo __('Examples of missions'); ?>",
						"<?php echo __('What is Evoke?'); ?>",
						"<?php echo __('Why was Evoke created?'); ?>",
						"<?php echo __('Gameplay'); ?>",
						"<?php echo __('Who is behind Evoke?'); ?>",
						"<?php echo __('How to become an agent?'); ?>"]
			    });

			    /* Ajusta margens em relacao ao top-bar */
			    $('.fp-controlArrow').css("margin-top", ($('#top-bar-login').height()*(-2)).toString()+"px");
			}
		});
	</script>


	<!-- GamePlay tabs -->
	<script type="text/javascript">
		$(document).ready(function () {
			/* Show special image only in the tab that is active */
			$('#tabs-gameplay li').click(function() {
				//Hide thumb and glow in all others
				$('li img.active').addClass("hidden");
				$('li img.not-active').removeClass("hidden");
				$('li h5').removeClass("text-glow");
				//Show in this one
				$(this).find('img.not-active').addClass("hidden");
				$(this).find('img.active').removeClass("hidden");
				$(this).find('h5').addClass("text-glow");

			}).mouseover(function() {
				$(this).find('img.not-active').addClass("hidden");
				$(this).find('img.active').removeClass("hidden");
			}).mouseout(function() {
				if (!$(this).hasClass("active")) {
					$(this).find('img.active').addClass("hidden");
					$(this).find('img.not-active').removeClass("hidden");
				}
			});
		});
	</script>
<!-- SCRIPT -->