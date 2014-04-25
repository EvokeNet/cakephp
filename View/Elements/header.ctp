<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<?php if(isset($user['User'])) :?>
				<h1><a href = "<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $user['User']['id'])); ?>"><?= strtoupper(__('Evoke')) ?></a></h1>
			<?php else : ?>
				<h1><a href = "<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'login')); ?>"><?= strtoupper(__('Evoke')) ?></a></h1>
			<?php endif; ?>
		</li>
		<!-- <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li> -->
	</ul>

	<section class="evoke top-bar-section">

		<!-- Right Nav Section -->
		<ul class="evoke right">

			<?php if(isset($user['User'])) :?>
				<li>
					<a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'dashboard', $user['User']['id'])); ?>">
						<?php if($user['User']['photo_attachment'] == null) : ?>
							<img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large"  class = "evoke top-bar icon"/>
			  			<?php else : ?>
			  				<img src="<?= $this->webroot.'files/attachment/attachment/'.$user['User']['photo_dir'].'/'.$user['User']['photo_attachment'] ?>" class = "evoke top-bar icon"/>
			  			<?php endif; ?>
					</a>
				</li>
			<?php endif; ?>

			<li class = "name">
				<?php if(isset($user['User'])) :?>
					<h3><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'dashboard', $user['User']['id'])); ?>" class = "evoke top-bar-name"><?= $user['User']['name'] ?></a></h3>
				<?php else :?>
					<h3><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'login')); ?>" class = "evoke top-bar-name"><?= __('Unidentified Agent, please login') ?></a></h3>
				<?php endif; ?>
			</li>

			<?php if(isset($user['User'])) :?>
				<li class="evoke divider"></li>

				<li class = "evoke top-bar-level"><h5><?= __('Points') ?>&nbsp;&nbsp;&nbsp;<span><?= $userPoints ?></span></h5></li>

				<!-- <li class = "evoke top-bar-padding"><h5><?= __('Points') ?></h5>&nbsp;&nbsp;<h4>8</h4></li> -->

				<li class="evoke divider"></li>

				<li class = "evoke top-bar-level"><h5><?= __('Level') ?>&nbsp;&nbsp;&nbsp;<span><?= $userLevel ?></span></h5></li>
				<!-- <li class = "evoke top-bar-padding"><h5><?= __('Level') ?></h5>&nbsp;&nbsp;<h4>8</h4></li> -->
				
				<li class="evoke divider"></li>

				<li class = "evoke top-bar-padding bar">
					<div class="evoke top-bar progress small-9 large-9 round" style = "width:250px">
					  <span class="evoke top-bar meter" style="width: <?= $userLevelPercentage ?>%"></span>
					</div>
				</li>
			<?php endif; ?>

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
					<?php if(isset($user['User'])) :?>
						<li><h1><?php echo $this->Html->link(__('Edit information'), array('controller' => 'users', 'action' => 'edit', $user['User']['id'])); ?></h1></li>
						<li><h1><?php echo $this->Html->link(__('Sign Out'), array('controller' => 'users', 'action' => 'logout')); ?></h1></li>
					<?php else :?>
						<li><h1><?php echo $this->Html->link(__('Log in'), array('controller' => 'users', 'action' => 'login')); ?></h1></li>
					<?php endif; ?>
				</ul>
			</li>

		</ul>

		<!-- <h3><?php echo sprintf(__('Welcome to Evoke Virtual Station'));?></h3> -->

	</section>
</nav>