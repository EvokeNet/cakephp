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
				<a href="#">Settings</a>
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
			<div class="evidences form">
			<?php echo $this->Form->create('Evidence'); ?>
				<?php echo __('Add Evidence'); ?>
				<?php
					echo $this->Form->input('title');
					echo $this->Form->input('content');
					echo $this->Form->input('quest_id', array('empty' => true));
					echo $this->Form->hidden('user_id', array('value' => $user['User']['id']));
					echo $this->Form->hidden('mission_id', array('value' => $mission['Mission']['id']));
					echo $this->Form->hidden('phase_id', array('value' => $phase['Phase']['id']));
				?>
			<?php echo $this->Form->end(__('Submit')); ?>
			</div>
		</div>
	</div>
</section>