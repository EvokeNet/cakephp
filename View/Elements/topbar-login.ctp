<?php echo $this->Form->create('User', array('data-abide', 'url' => array('controller' => 'users', 'action' => 'login'))); ?>

<div>
	<nav class="top-bar header-top-fullpage" data-topbar role="navigation">
		<ul class="title-area">
			<li class="name">
				<h1><a href="<?= $this->Html->url(array('action'=>'login')) ?>"><img src = '<?= $this->webroot.'img/Logo-Evoke-Atualizado.png' ?>' width = "150px"></a></h1>
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
				<li>
					<a href="<?= $this->Html->url($facebook_login_url) ?>">Login with facebook</a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="<?= $this->Html->url($google_login_url) ?>">Login with google</a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="<?= $this->Html->url(array('action'=>'recover_password')) ?>">Forgot password?</a>
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

<!--<div>
	<nav class="top-bar header-top-fullpage" data-topbar role="navigation">
		<ul class="title-area">
			<li class="name">
				<h1><a href="#"><img src = '<?= $this->webroot.'img/Logo-Evoke-Atualizado.png' ?>' width = "125px"></a></h1>
			</li>
			<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
		</ul>

		<section class="top-bar-section">
			<ul class="right">
				<li class="active">
					<?php	echo $this->Form->input('username', array('label' => false, 'type' => 'text', 'placeholder' =>  __('username'), 'class' => 'radius', 'required' => true, 'autofocus', 'class' => 'margin-right-1em'));	?>
				</li>
				<li class="active">
					<?php	echo $this->Form->input('password', array('label' => false, 'type' => 'password', 'placeholder' =>  __('password'), 'class' => 'radius', 'required' => true, 'autofocus'));	?>
				</li>
				<li class="has-form">
					<button type="submit" class="uppercase"><?php echo __('Sign In'); ?></button>
				</li>
				<li class="has-form">
					<a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'register')) ?>" class="button uppercase"><?php echo __('Sign Up'); ?></a>
				</li>
				<li class="divider"></li>
				<li class="has-dropdown">
					<a href="#"><i class="fa fa-language fa-lg"></i></a>
					<ul class="dropdown">
						<li><a href="<?= $this->Html->url(array('action'=>'changeLanguage', 'en')) ?>"><?php echo __('ENGLISH'); ?></a></li>
						<li><a href="<?= $this->Html->url(array('action'=>'changeLanguage', 'es')) ?>"><?php echo __('SPANISH'); ?></a></li>
					</ul>
				</li>
			</ul>

		</section>
	</nav>
</div>-->

<?php echo $this->Form->end(); ?>