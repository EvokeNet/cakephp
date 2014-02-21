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
	<div class="row evoke missions">
	  	<div class="small-11 small-centered columns">
	  		<h2><?php echo __('Create a group or join one');?></h2>
	  		<?php
	  			foreach($groups as $group):?>
	  				<h4><?php echo sprintf(__('Group %s'), $group['Group']['title']); ?></h4>
				  	<h6><?php echo sprintf(__('Group Owner: %s'), $group['User']['name']); ?></h6>
				  	<button><?php echo $this->Html->link(__('Join group'), array('controller' => 'groupsUsers', 'action' => 'add')); ?></button>
				  	<hr class="sexy_line" />
  				<?php endforeach;
  			?>
	  		<button><?php echo $this->Html->link(__('Create a group'), array('controller' => 'groups', 'action' => 'add')); ?></button>
		</div>
	</div>
</section>
