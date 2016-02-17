<?php
	//CSS overriding fullpage.js plugin
	$cssBaseUrl = Configure::read('App.cssBaseUrl');
	echo $this->Html->css('/components/fullpage.js/jquery.fullPage.css'); //FullPage plugin para fazer scroll em secoes

	echo $this->Form->create('User', array('data-abide', 'url' => array('controller' => 'users', 'action' => 'login')));

?>

<<<<<<< HEAD
	<div class="evoke login fullpage">
		<!-- MISSIONS CAROUSEL -->
		<div class="section">
	    	<div class="row full-width full-height missions-carousel">
	    		<?php foreach($missions as $mission):

    			//COVER IMAGE
	    		if (!is_null($mission['Mission']['cover_dir'])) {
	    			$cover_url = $this->webroot.'files/attachment/attachment/'.$mission['Mission']['cover_dir'].'/'.$mission['Mission']['cover_attachment'];
                }
                else {
                	$cover_url = $this->webroot.'img/episodes-example/E01G01P02.jpg';
                } ?>

			    <div class="evoke slide background-cover full-width" data-interchange="['<?= $cover_url ?>',(default)]">
					<noscript>
						<img src="<?= $cover_url ?>" alt="<?= $mission['Mission']['title'] ?>">
					</noscript>

					<div class="table full-width full-height"><div class="table-cell vertical-align-bottom">
						<div class="evoke padding top-1 bottom-1 left-5 right-5 background-color-dark-opacity-05">
							<a href="<?= $this->Html->url(array('controller' => 'missions', 'action' => 'view_sample', $mission['Mission']['id']))?>">
								<h2 class="text-color-highlight"><?= $mission['Mission']['title'] ?></h2>
								<p> <?= $mission['Mission']['description']; ?>
								</p>
							</a>
						</div></div>
					</div>
		    	</div>

		    	<?php endforeach; ?>
	    	</div>
	    </div>

	    <!-- WHAT IS EVOKE? -->
	    <div class="section evoke login gradient-on-top padding top-2">
	    	<div class="row small-width text-center">
		    	<h1 class="text-color-highlight text-center margin bottom-1"><?php echo ('What is Evoke?'); ?></h1>
					<p class="font-size-important"><?php echo ('Welcome to the Evoke network! If you have found this message, it is your destiny to join us. Evoke is your gateway to solving the world’s greatest challenges.'); ?>
						<?php echo ('As an Evoke agent, you will choose your mission, develop your powers, and together with agents around the world create your <strong>own world changing idea</strong>.'); ?>
					</p>
				</div>
	    </div>

	    <!-- EVOKE VIDEO -->
	    <div class="section evoke login gradient-on-top padding top-2">
	    	<div class="row small-width text-center">
				<div class="flex-video widescreen vimeo">
				  <iframe src="<?= $video_url ?>" width="320" height="180" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				</div>
			</div>
	    </div>

	    <!-- WHY WAS EVOKE CREATED? -->
	    <div class="section evoke login gradient-on-top padding top-2">
	    	<div class="row small-width text-center">
		    	<h2 class="text-color-highlight text-center margin bottom-1"><?php echo ('Why was Evoke created?'); ?></h2>
		    	<p class="font-size-important"><?php echo ('The Evoke network was created to identify voices that are not heard and to give them the tools and support to change their community, their world.  The network believes that every individual can make a difference and when connected to others, change the world.'); ?></p>
			</div>
	    </div>

	    <!-- HOW DOES EVOKE WORK? (TABS EXPLAINING) -->
	    <div class="section evoke gradient-on-top padding top-2">
	    	<div class="row standard-width full-height centering-block table padding top-2 text-center">
		    	<h2 class="text-color-highlight text-center margin bottom-1"><?php echo ('Gameplay'); ?></h2>

				<div class="evoke small-block-grid-5 tabs-style-linetriangle centered-block">
					<ul id="tabs-gameplay" class="tabs" data-tab role="tablist">
						<li class="tab-title active" role="presentational">
							<a href="#panelMissions" role="tab" aria-selected="true" controls="panelMissions">
								<div class="tab-image centered-block img-circular">
									<img class="evoke img-circular vertical-align-middle not-active hidden border-width-02 border-style-solid border-color-highlight padding all-1"
										src="<?= $this->webroot.'img/icon-missions.png' ?>" alt="<?php echo ('Missions'); ?>" />
									<img class="evoke img-circular vertical-align-middle active img-glow"
										src="<?= $this->webroot.'img/thumb-missions.jpg' ?>" alt="<?php echo ('Missions'); ?>" />
								</div>
								<h5 class="text-color-highlight text-glow"><?php echo ('Missions'); ?></h5>
							</a>
						</li>
						<li class="tab-title" role="presentational">
							<a href="#panelQuests" role="tab" aria-selected="false" controls="panelQuests">
								<div class="tab-image centered-block img-circular">
									<img class="evoke img-circular vertical-align-middle not-active border-width-02 border-style-solid border-color-highlight padding all-1"
										src="<?= $this->webroot.'img/icon-quests.png' ?>" alt="<?php echo ('Quests'); ?>" />
									<img class="evoke img-circular vertical-align-middle active img-glow hidden"
										src="<?= $this->webroot.'img/thumb-quests.jpg' ?>" alt="<?php echo ('Quests'); ?>" />
								</div>
								<h5 class="text-color-highlight"><?php echo ('Quests'); ?></h5>
							</a>
						</li>
						<li class="tab-title" role="presentational">
							<a href="#panelEvidences" role="tab" aria-selected="true" controls="panelEvidences">
								<div class="tab-image centered-block img-circular">
									<img class="evoke img-circular vertical-align-middle not-active border-width-02 border-style-solid border-color-highlight padding all-1"
										src="<?= $this->webroot.'img/icon-evidences.png' ?>" alt="<?php echo ('Evidences'); ?>" />
									<img class="evoke img-circular vertical-align-middle active img-glow hidden"
										src="<?= $this->webroot.'img/thumb-evidences.jpg' ?>" alt="<?php echo ('Evidences'); ?>" />
								</div>
								<h5 class="text-color-highlight"><?php echo ('Evidence'); ?></h5>
							</a>
						</li>
						<li class="tab-title" role="presentational">
							<a href="#panelBadges" role="tab" aria-selected="false" controls="panelBadges">
								<div class="tab-image centered-block img-circular">
									<img class="evoke img-circular vertical-align-middle not-active border-width-02 border-style-solid border-color-highlight padding all-1"
										src="<?= $this->webroot.'img/icon-badges.png' ?>" alt="<?php echo ('Badges'); ?>" />
									<img class="evoke img-circular vertical-align-middle active img-glow hidden"
										src="<?= $this->webroot.'img/thumb-badges.jpg' ?>" alt="<?php echo ('Badges'); ?>" />
								</div>
								<h5 class="text-color-highlight"><?php echo ('Badges'); ?></h5>
							</a>
						</li>
						<li class="tab-title" role="presentational">
							<a href="#panelPower" role="tab" aria-selected="false" controls="panelPower">
								<div class="tab-image centered-block img-circular">
									<img class="evoke img-circular vertical-align-middle not-active border-width-02 border-style-solid border-color-highlight padding all-1"
										src="<?= $this->webroot.'img/icon-powers.png' ?>" alt="<?php echo ('Powers'); ?>" />
									<img class="evoke img-circular vertical-align-middle active img-glow hidden"
										src="<?= $this->webroot.'img/thumb-powers.jpg' ?>" alt="<?php echo ('Powers'); ?>" />
								</div>
								<h5 class="text-color-highlight"><?php echo ('Powers'); ?></h5>
							</a>
						</li>
=======
<div>
	<nav class="top-bar header-top-fullpage" data-topbar role="navigation">
		<ul class="title-area">
			<li class="name">
				<h1><a href="#"><img src = '<?= $this->webroot.'img/Logo-Evoke-Atualizado.png' ?>' width = "150px"></a></h1>
			</li>
			 <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
			<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
		</ul>

		<section class="top-bar-section">
			<!-- Right Nav Section -->
			<ul class="right">
				<li class="active">
					<?php	echo $this->Form->input('username', array('label' => false, 'type' => 'text', 'placeholder' =>  __('username'), 'class' => 'radius', 'required' => true, 'autofocus', 'class' => 'margin-right-1em'));	?>
				</li>
				<li class="active">
					<?php	echo $this->Form->input('password', array('label' => false, 'type' => 'password', 'placeholder' =>  __('password'), 'class' => 'radius', 'required' => true, 'autofocus'));	?>
				</li>
				<li class="has-form">
					<button type="submit" class="full-width uppercase"><?php echo __('Sign In'); ?></button>
					<!-- <a href = "#" id = "user_login" class="button uppercase"><?php echo __('Sign In'); ?></a> -->
				</li>
				<li class="divider"></li>
				<li class="has-form">
					<a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'register')) ?>" class="button uppercase"><?php echo __('Sign Up'); ?></a>
				</li>
				<li class="divider"></li>
				<li class="has-dropdown">
					<a href="#"><?php echo __('LANGUAGE'); ?></a>
					<ul class="dropdown">
						<li><a href="<?= $this->Html->url(array('action'=>'changeLanguage', 'en')) ?>"><?php echo __('ENGLISH'); ?></a></li>
						<li><a href="<?= $this->Html->url(array('action'=>'changeLanguage', 'es')) ?>"><?php echo __('SPANISH'); ?></a></li>
>>>>>>> d3ace6dc863b027790b02707636363d830b94f9d
					</ul>
				</li>
			</ul>

<<<<<<< HEAD
<?php
	//SCRIPT VARIABLES
	$this->Html->scriptStart(array('inline' => false)); ?>
		var fullpage_tooltips = [
			"<?php echo ('Examples of missions'); ?>",
			"<?php echo ('What is Evoke?'); ?>",
			"<?php echo ('Trailer'); ?>",
			"<?php echo ('Why was Evoke created?'); ?>",
			"<?php echo ('Gameplay'); ?>",
			"<?php echo ('Who is behind Evoke?'); ?>",
			"<?php echo ('How to become an agent?'); ?>"
		];
	<?php
	$this->Html->scriptEnd();

	//SCRIPT
	$this->Html->script('requirejs/app/Users/login.js', array('inline' => false));
?>
=======
		</section>
	</nav>
</div>

<?php echo $this->Form->end(); ?>

<div class = "first_page" id="fullpage">

  <section class="vertical-scrolling section1" id = "section1">
    <!-- <h2><?php echo __('EVOKE'); ?></h2> -->
    <img src = '<?= $this->webroot.'img/Logo-Evoke-Atualizado.png' ?>' width = "200px" class = "margin-bottom-1em">
    <h2 class = "uppercase font-weight-bold"><?php echo __('A crash course in changing the world'); ?></h2>
    <div class="scroll-icon">
    	<p class = "font-green uppercase font-weight-bold"><?php echo __('Discover Evoke'); ?></p>
    	<a href="#secondSection" class="icon-up-open-big"></a>
    </div>
  </section>

  <section class="vertical-scrolling">
    <h2 class = "margin-top-05em font-green uppercase font-weight-bold"><?php echo ('Welcome to the Evoke network!'); ?></h2>
    <div class = "centralize-content">
			<h4><?php echo ('If you have found this message, it is your destiny to join us. Evoke is your gateway to solving the world’s greatest challenges. As an Evoke agent, you will choose your mission, develop your powers, and together with agents around the world create your <strong>own world changing idea</strong>.'); ?></h4>
		</div>
  </section>

  <section class="vertical-scrolling">
    <h2 class = "margin-top-05em font-green uppercase font-weight-bold"><?php echo ('What is Evoke?'); ?></h2>
    <iframe src="<?= $video_url ?>" width="70%" height="70%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
  </section>

	<section class="vertical-scrolling">
		<h2 class = "margin-top-05em font-green uppercase font-weight-bold"><?php echo ('Why was Evoke created?'); ?></h2>
    <div class = "centralize-content">
			<h4><?php echo ('The Evoke network was created to identify voices that are not heard and to give them the tools and support to change their community, their world.  The network believes that every individual can make a difference and when connected to others, change the world.'); ?></h4>
		</div>

		<h2 class = "margin-top-2em margin-top-05em font-green uppercase font-weight-bold"><?php echo ('Who is behind Evoke?'); ?></h2>
    <div class = "centralize-content">
			<h4><?php echo ('Evoke is an innovation project of the World Bank in collaboration with partners around the world.'); ?></h4>
		</div>

  </section>

  <section class="vertical-scrolling">
		<h2 class = "margin-top-05em font-green uppercase font-weight-bold"><?php echo ('How to become an agent?'); ?></h2>
    <div class = "centralize-content">
			<h4><?php echo ('To start your journey towards becoming an Evoke Agent, you simply need to sign up.'); ?></h4>
			<a class="button margin-top-2em" href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'register')) ?>">
			 <?= __('Sign up') ?>
			</a>
		</div>

    <nav class="top-bar footer-bottom-fullpage" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href = "http://www.worldbank.org/" target="_blank"><img src = '<?= $this->webroot.'img/wblogo.png' ?>'></a></h1>
        </li>
         <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
      </ul>

      <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
            <li><a href="#">&copy;&nbsp;&nbsp;<?= __('2016') ?> <?php echo strtoupper(__('Evoke'));?></a></li>
            <li class="divider"></li>
            <li><a href = "<?= $this->Html->url(array('controller' => 'pages', 'action' => 'reportissue'))?>" target="_blank" class = "uppercase"><?= __('Report an issue') ?></a></li>
            <li class="divider"></li>
            <li><a href = "<?= $this->Html->url(array('controller' => 'pages', 'action' => 'terms'))?>" target="_blank" class = "uppercase"><?= __('Terms of Service') ?></a></li>
        </ul>

      </section>
    </nav>

  </section>

</div>

<?php echo $this->Html->script('requirejs/app/fullpage.js', array('inline' => false)); ?>
>>>>>>> d3ace6dc863b027790b02707636363d830b94f9d
