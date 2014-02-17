<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><a href="#">Agent <?php echo explode(' ', $this->Session->read('Auth.User.User.name'))[0]; ?></a></h1>
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
					<legend><?php echo __('Add User'); ?></legend>
				<?php
					echo $this->Form->input('name');
					echo $this->Form->input('birthdate');
					echo $this->Form->input('sex');
					echo $this->Form->input('biography');
					echo $this->Form->input('login');
					echo $this->Form->input('password');
					echo $this->Form->input('facebook');
					echo $this->Form->input('twitter');
					echo $this->Form->input('instagram');
					echo $this->Form->input('website');
					echo $this->Form->input('blog');
				?>
				</fieldset>
			<?php echo $this->Form->end(__('Submit')); ?>
		</div>
	</div>
</section>	