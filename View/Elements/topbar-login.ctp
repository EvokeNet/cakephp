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
                <li class="active margin-right-1em">
                    <a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'login')) ?>" class="button uppercase"><?php echo __('Sign In'); ?></a>
				</li>
                <li class="divider"></li>
                <li class="active margin-left-1em margin-right-1em">
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