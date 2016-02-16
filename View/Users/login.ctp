<?php
	//CSS overriding fullpage.js plugin
	$cssBaseUrl = Configure::read('App.cssBaseUrl');
	echo $this->Html->css('/components/fullpage.js/jquery.fullPage.css'); //FullPage plugin para fazer scroll em secoes

	echo $this->Form->create('User', array('data-abide', 'url' => array('controller' => 'users', 'action' => 'login')));

?>

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
					</ul>
				</li>
			</ul>

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
			<h4><?php echo ('If you have found this message, it is your destiny to join us. Evoke is your gateway to solving the worldâ€™s greatest challenges. As an Evoke agent, you will choose your mission, develop your powers, and together with agents around the world create your <strong>own world changing idea</strong>.'); ?></h4>
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
