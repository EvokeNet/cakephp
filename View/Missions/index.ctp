<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><?php echo $user['User']['name']; ?></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
	</ul>

	<section class="top-bar-section">
		<!-- Right Nav Section -->
		<ul class="right">
			<li class="has-dropdown">
				<a href="#"><?= __('Settings') ?></a>
				<ul class="dropdown">
					<li><?php echo $this->Html->link(__('Edit informations'), array('controller' => 'users', 'action' => 'edit', $user['User']['id'])); ?></li>
					<li><?php echo $this->Html->link(__('Sign Out'), array('controller' => 'users', 'action' => 'logout')); ?></li>
				</ul>
			</li>
		</ul>

		<!-- Left Nav Section -->
		<ul class="left">
			<li><?php echo $this->Html->link(__('Dashboard'), array('controller' => 'users', 'action' => 'dashboard', $user['User']['id'])); ?></li>
		</ul>
	</section>
</nav>

<?php $this->end(); ?>

<section class="evoke margin top-2">
	<div class="row">
	  <div class="small-11 small-centered columns">
		  <div class = "issues">
			<?php foreach($issues as $i):?>

				<!-- Print the category's name -->
				<h1><?php echo __('Mission Under Issues: ').$i['Issue']['name'];?></h1>
				<?php foreach($missionIssues as $m):
				//If the mission belongs to that category, it is printed
					if($i['Issue']['id'] == $m['Issue']['id']):?>
						<h2><?php echo $this->Html->link($m['Mission']['title'], array('controller' => 'missions', 'action' => 'view', $m['Mission']['id'], 1)); ?></h2>
						<p><?php echo $m['Mission']['description'];?></p>
						<hr class="sexy_line" />

				<?php endif; endforeach; endforeach; ?>
			</div>
		</div>
	</div>
</section>