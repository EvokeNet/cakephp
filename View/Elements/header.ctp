<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><a href = "<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $user['User']['id'])); ?>"><?= strtoupper(__('Evoke')) ?></a></h1>
		</li>
		<!-- <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li> -->
	</ul>

	<section class="evoke top-bar-section">

		<!-- Right Nav Section -->
		<ul class="evoke right">

			<li><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'dashboard', $user['User']['id'])); ?>"><img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large"  class = "evoke top-bar icon"/></a></li>
			
			<li class = "name">
				<h3><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'dashboard', $user['User']['id'])); ?>" class = "evoke top-bar-name"><?= $user['User']['name'] ?></a></h3>
			</li>

			<li class="evoke divider"></li>

			<li class = "evoke top-bar-level"><h5><?= __('Points') ?>&nbsp;&nbsp;&nbsp;<span>120</span></h5></li>

			<!-- <li class = "evoke top-bar-padding"><h5><?= __('Points') ?></h5>&nbsp;&nbsp;<h4>8</h4></li> -->

			<li class="evoke divider"></li>

			<li class = "evoke top-bar-level"><h5><?= __('Level') ?>&nbsp;&nbsp;&nbsp;<span>21</span></h5></li>
			<!-- <li class = "evoke top-bar-padding"><h5><?= __('Level') ?></h5>&nbsp;&nbsp;<h4>8</h4></li> -->
			
			<li class="evoke divider"></li>

			<li class = "evoke top-bar-padding bar">
				<div class="evoke top-bar progress small-9 large-9 round" style = "width:250px">
				  <span class="evoke top-bar meter" style="width: 50%"></span>
				</div>
			</li>

			<li class="evoke divider"></li>

			<li  class="has-dropdown">
				<a href="#"><?= __('Language') ?></a>
				<ul class="dropdown">
					<li><?= $this->Html->link(__('English'), array('action'=>'changeLanguage', 'en')) ?></li>
					<li><?= $this->Html->link(__('Spanish'), array('action'=>'changeLanguage', 'es')) ?></li>
				</ul>
			</li>

			<li class="evoke divider"></li>
			
			<li class="has-dropdown">
				<a href="#"><i class="fa fa-cog fa-2x"></i></a>
				<ul class="dropdown">
					<li><h1><?php echo $this->Html->link(__('Edit informations'), array('controller' => 'users', 'action' => 'edit', $user['User']['id'])); ?></h1></li>
					<li><h1><?php echo $this->Html->link(__('Sign Out'), array('controller' => 'users', 'action' => 'logout')); ?></h1></li>
				</ul>
			</li>

		</ul>

		<!-- <h3><?php echo sprintf(__('Welcome to Evoke Virtual Station'));?></h3> -->

	</section>
</nav>