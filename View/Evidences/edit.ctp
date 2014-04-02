<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><?php echo $this->Html->link(strtoupper(__('Evoke')), array('controller' => 'users', 'action' => 'dashboard', $users['User']['id'])); ?></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
	</ul>

	<section class="evoke top-bar-section">

		<!-- Right Nav Section -->
		<ul class="right">
			<li class="name">
				<h1><?= sprintf(__('Hi %s'), $users['User']['name']) ?></h1>
			</li>
			<li class="has-dropdown">
				<a href="#"><i class="fa fa-cog fa-2x"></i></a>
				<ul class="dropdown">
					<li><h1><?php echo $this->Html->link(__('Edit informations'), array('controller' => 'users', 'action' => 'edit', $users['User']['id'])); ?></h1></li>
					<li><h1><?php echo $this->Html->link(__('Sign Out'), array('controller' => 'users', 'action' => 'logout')); ?></h1></li>
				</ul>
			</li>
			<li  class="has-dropdown">
				<a href="#"><?= __('Language') ?></a>
				<ul class="dropdown">
					<li><?= $this->Html->link(__('English'), array('action'=>'changeLanguage', 'en')) ?></li>
					<li><?= $this->Html->link(__('Spanish'), array('action'=>'changeLanguage', 'es')) ?></li>
				</ul>
			</li>
		</ul>

		<h3><?php echo sprintf(__('Welcome to Evoke Virtual Station'));?></h3>

	</section>
</nav>

<?php $this->end(); ?>

<section class="evoke background-gray padding top-2">
	<div class="row">
		<div class="small-11 small-centered columns">
			<div class="evidences form">
			<?php echo $this->Form->create('Evidence'); ?>
				<?php echo __('Edit Evidence'); ?>
				<?php
					echo $this->Form->input('id');
					echo $this->Form->input('title', array('label' => __('Title')));
					//echo $this->Form->input('content');
					echo $this->Form->hidden('user_id');
					//echo $this->Form->input('quest_id', array('empty' => true));
					echo $this->Form->hidden('mission_id');
					echo $this->Form->hidden('phase_id');
					echo $this->Media->ckeditor('content', array('label' => __('Content')));
					//echo $this->Media->iframe('Evidence', $this->request->data['Evidence']['id']);
				?>
			<?php echo $this->Form->end(__('Save Evidence')); ?>
			</div>
		</div>
	</div>
</section>