<?php
	//CSS overriding fullpage.js plugin
	$cssBaseUrl = Configure::read('App.cssBaseUrl');
	echo $this->Html->css('/components/fullpage.js/jquery.fullPage.css'); //FullPage plugin para fazer scroll em secoes
?>

<!-- <header>
  <div class="header-top clearfix">
    <div class = "left" style = "margin-top:1.7em"><img src = '<?= $this->webroot.'img/Logo-Evoke-Atualizado.png' ?>'></div>
    <a class="l-right toggle-menu" href="#">
      <i></i>
      <i></i>
      <i></i>
    </a>
  </div>
</header> -->

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
					<?php	echo $this->Form->input('password', array('label' => false, 'type' => 'text', 'placeholder' =>  __('password'), 'class' => 'radius', 'required' => true, 'autofocus'));	?>
				</li>
				<li class="has-form"><a href="http://foundation.zurb.com/docs" class="button uppercase"><?php echo __('Sign In'); ?></a></li>
				<li class="divider"></li>
				<li class="has-form"><a href="http://foundation.zurb.com/docs" class="button uppercase"><?php echo __('Sign Up'); ?></a></li>
				<li class="divider"></li>
				<li class="has-dropdown">
					<a href="#"><?php echo __('LANGUAGE'); ?></a>
					<ul class="dropdown">
						<li><a href="<?= $this->Html->url(array('action'=>'changeLanguage', 'en')) ?>"><?php echo __('ENGLISH'); ?></a></li>
						<li><a href="<?= $this->Html->url(array('action'=>'changeLanguage', 'es')) ?>"><?php echo __('SPANISH'); ?></a></li>
					</ul>
				</li>
			</ul>

		</section>
	</nav>
</div>

<div id="fullpage">

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
    <h2 class = "margin-bottom-1em font-green uppercase font-weight-bold"><?php echo ('Welcome to the Evoke network!'); ?></h2>
    <h3 class = "centralize-content">
			<p><?php echo ('If you have found this message, it is your destiny to join us. Evoke is your gateway to solving the world’s greatest challenges.'); ?></p>
			<p><?php echo ('As an Evoke agent, you will choose your mission, develop your powers, and together with agents around the world create your <strong>own world changing idea</strong>.'); ?></p>
		</h3>
  </section>

  <section class="vertical-scrolling">
    <h2 class = "margin-bottom-1em font-green uppercase font-weight-bold"><?php echo ('What is Evoke?'); ?></h2>
    <iframe src="<?= $video_url ?>" width="70%" height="70%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
  </section>

  <section class="vertical-scrolling">
    <h2>fullPage.js</h2>
    <h3>This is the fourth section</h3>

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
