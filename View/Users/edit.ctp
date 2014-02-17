<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><a href="#">Agent <?php echo explode(' ', $this->request->data['User']['name'])[0]; ?></a></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
	</ul>

	<section class="top-bar-section">
		<!-- Right Nav Section -->
		<ul class="right">
			<li class="has-dropdown">
				<a href="#">Settings</a>
				<ul class="dropdown">
					<li><a href="<?php echo $this->Html->url(array('action' => 'logout')); ?>">Sign out</a></li>
				</ul>
			</li>
		</ul>

		<!-- Left Nav Section -->
		<ul class="left">
			<li><a href="#">Dashboard</a></li>
		</ul>
	</section>
</nav>

<?php $this->end(); ?>

<section>
	<div class="row">
		<div class="large-12 columns">
			<?php echo $this->Form->create('User'); ?>
			<fieldset>
				<legend><?php echo __('Editing profile'); ?></legend>
				<?php
					echo $this->Form->input('id');
					echo $this->Form->input('name');
					echo $this->Form->input('birthdate');
					echo $this->Form->input('sex', array('type' => 'select', 'options' => array(0 => 'Female', 1 => 'Male')));
					echo $this->Form->input('biography');
					echo $this->Form->input('facebook');
					echo $this->Form->input('twitter');
					echo $this->Form->input('instagram');
					echo $this->Form->input('website');
					echo $this->Form->input('blog');
				?>
				</fieldset>
				<button type="submit" class="button expand"><?php echo __('Save'); ?></button>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</section>