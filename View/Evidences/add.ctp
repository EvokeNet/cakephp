<?php  
	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><?php echo __('Agent ').$username[0]; ?></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
	</ul>

	<section class="top-bar-section">
		<!-- Right Nav Section -->
		<ul class="right">
			<li class="has-dropdown">
				<a href="#">Settings</a>
				<ul class="dropdown">
					<li><?php echo $this->Html->link(__('Edit informations'), array('controller' => 'users', 'action' => 'edit', $userid)); ?></li>
					<li><?php echo $this->Html->link(__('Sign Out'), array('controller' => 'users', 'action' => 'logout')); ?></li>
				</ul>
			</li>
		</ul>

		<!-- Left Nav Section -->
		<ul class="left">
			<li><a href="#"><?php echo $this->Html->link(__('Dashboard'), array('controller' => 'users', 'action' => 'dashboard', $userid)); ?></a></li>
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
					echo $this->Form->hidden('user_id', array('value' => $users['User']['id']));
					echo $this->Form->hidden('mission_id', array('value' => $missions['Mission']['id']));
					echo $this->Form->hidden('phase_id', array('value' => $phases['Phase']['id']));
				?>
			<?php echo $this->Form->end(__('Submit')); ?>
			</div>
		</div>
	</div>
</section>

<!-- <div class="evidences form">
<?php echo $this->Form->create('Evidence'); ?>
	<fieldset>
		<legend><?php echo __('Add Evidence'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('content');
		echo $this->Form->input('user_id');
		echo $this->Form->input('quest_id');
		echo $this->Form->input('mission_id');
		echo $this->Form->input('phase_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Evidences'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Quests'), array('controller' => 'quests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Quest'), array('controller' => 'quests', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Missions'), array('controller' => 'missions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mission'), array('controller' => 'missions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Phases'), array('controller' => 'phases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Phase'), array('controller' => 'phases', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Comments'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Votes'), array('controller' => 'votes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vote'), array('controller' => 'votes', 'action' => 'add')); ?> </li>
	</ul>
</div> -->
