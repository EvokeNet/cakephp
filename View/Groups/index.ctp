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
			<h1><?php echo __('Join a group or create one');?></h1>
			<dl class="tabs" data-tab>
			  <dd class="active"><a href="#panel2-1"><?php echo __('Groups');?></a></dd>
			  <dd><a href="#panel2-2"><?php echo __('My Groups');?></a></dd>
			</dl>
			<div class="tabs-content">
			  <div class="content active" id="panel2-1">
			    <?php
		  			foreach($groups as $group):?>
		  				<h4><?php echo sprintf(__('Group %s'), $group['Group']['title']); ?></h4>
		  				<h6><?php echo sprintf(__('Group Owner: %s'), $group['User']['name']); ?></h6>

						<div class="button-bar">
						  <ul class="button-group">
						    <li><a class = "button" href = "<?php echo $this->Html->url(array('action' => 'view', $group['Group']['id'])); ?>"><?php echo __('View');?></a></li>
						  </ul>
						  <ul class="button-group">
						    <!-- <li><a href = "<?php echo $this->Html->url(array('controller' => 'groupsUsers', 'action' => 'send', $user['User']['id'], $group['Group']['id'])); ?>" class = "button"><?php echo __('Send request to join');?></a></li> -->
						  </ul>
						</div>

					  	<hr class="sexy_line" />
	  				<?php endforeach;
	  			?>
			  </div>
			  <div class="content" id="panel2-2">
			    <?php
		  			foreach($myGroups as $group):?>
		  				<h4><?php echo sprintf(__('Group %s'), $group['Group']['title']); ?></h4>
					  	<a class = "button" href = "<?php echo $this->Html->url(array('action' => 'view', $group['Group']['id'])); ?>"><?php echo __('View');?></a>
					  	<hr class="sexy_line" />
	  				<?php endforeach;
	  			?>
			  </div>
			</div>
			<a href = "<?php echo $this->Html->url(array('controller' => 'groups', 'action' => 'add')); ?>" class = "button"><?php echo __('Create a group');?></a>
		</div>
	</div>
</section>