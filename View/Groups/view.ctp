<?php
	$this->extend('/Common/topbar');
	$this->start('menu');

	$countMembers = count($groupsUsers);
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

<section class="evoke margin top-2">
	<div class="row">
	  <div class="small-11 small-centered columns">
	  	<h1><?php echo sprintf(__('Group %s'), $group['Group']['title']);?></h1>
	  	<?php if(!$userRequest && !$flags['_owner']):?>
		  	<a href = "<?php echo $this->Html->url(array('controller' => 'groupsUsers', 'action' => 'send', $group['User']['id'], $group['Group']['id'])); ?>" class = "button"><?php echo __('Send request to join');?></a>
		<?php endif;?>
	  	<h3><?php echo sprintf(__('Group Owner: %s', $group['User']['name']));?></h3>
	  	<h3><?php echo sprintf(__('Members (%s)', $countMembers));?></h3>
	  	<ul>
			<?php foreach($groupsUsers as $g): ?>
				<li><?php echo $this->Html->Link($g['User']['name'], array('controller' => 'users', 'action' => 'view', $g['User']['id'])); ?>
					<?php if($flags['_owner']) {?>	
				 		<a href="<?php echo $this->Html->url(array('controller' => 'groupsUsers', 'action' => 'delete', $g['User']['id'])); ?>" class="button"><?php echo __('Remove user');?></a>
				 	<?php } ?>
				 </li>
			<?php endforeach; ?>
		</ul>

		<?php if($flags['_owner']) {?>	
			<h3><?php echo (__('Requests'));?></h3>

			<dl class="tabs" data-tab>
			  <dd class="active"><a href="#panel2-1"><?php echo __('Pending Requests');?></a></dd>
			  <dd><a href="#panel2-2"><?php echo __('Accepted/Declined Requests');?></a></dd>
			</dl>
			<div class="tabs-content">
			  <div class="content active" id="panel2-1">
			    <ul>
					<?php foreach($groupsRequestsPending as $g): ?>
						<li><?php echo $g['User']['name']; ?>
							<div class="button-bar">
							  <ul class="button-group">
							    <li><a href = "<?php echo $this->Html->url(array('controller' => 'groupsUsers', 'action' => 'add', $g['GroupRequest']['user_id'], $g['GroupRequest']['group_id'])); ?>" class = "button"><?php echo __('Accept');?></a></li>
							  </ul>
							  <ul class="button-group">
							    <li><a href = "<?php echo $this->Html->url(array('controller' => 'groupRequests', 'action' => 'decline', $g['GroupRequest']['user_id'], $g['GroupRequest']['group_id'])); ?>" class = "button alert"><?php echo __('Decline');?></a></li>
							  </ul>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			  </div>
			  <div class="content" id="panel2-2">
			    <ul>
			    <?php foreach($groupsRequests as $g):?>
					<li>
						<?php 
						if($g['GroupRequest']['status'] == 1) $status = __('Accepted');
						else $status = __('Declined');
						echo sprintf(__("Requester: Agent %s </br> Status: %s", $g['User']['name'], $status));
						?>
					</li>
					<?php endforeach; ?>
				</ul>
			  </div>
			</div>
		<?php } ?>


		<a href = "<?php echo $this->Html->url(array('controller' => 'groupsUsers', 'action' => 'view', $group['Group']['id'])); ?>" class = "button"><?php echo __('Go to project');?></a>

	  </div>
	</div>
</section>