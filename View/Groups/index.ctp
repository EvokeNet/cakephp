<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><?php echo $this->Html->link(strtoupper(__('Evoke')), array('controller' => 'users', 'action' => 'dashboard', $user['User']['id'])); ?></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
	</ul>

	<section class="evoke top-bar-section">

		<!-- Right Nav Section -->
		<ul class="right">
			<li class="name">
				<h1><?= sprintf(__('Hi %s'), $user['User']['name']) ?></h1>
			</li>
			<li class="has-dropdown">
				<a href="#"><i class="fa fa-cog fa-2x"></i></a>
				<ul class="dropdown">
					<li><h1><?php echo $this->Html->link(__('Edit informations'), array('controller' => 'users', 'action' => 'edit', $user['User']['id'])); ?></h1></li>
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

<section class="evoke background padding top-2">
	<?= $this->element('left_titlebar', array('title' => __('Evokations'))) ?>
	<div class="row full-width">
		<div class="small-6 small-centered columns">

			<dl class="tabs" data-tab>
			  <dd class="active"><a href="#panel2-1"><?php echo __('Evokation Teams');?></a></dd>
			  <dd><a href="#panel2-2"><?php echo __('My Evokation Teams');?></a></dd>
			</dl>
			<div class="tabs-content">
			  <div class="content active" id="panel2-1">
			    <?php
		  			foreach($groups as $group):?>
		  				<!-- <h4><?php echo sprintf(__('Group %s'), $group['Group']['title']); ?></h4>
		  				<h6><?php echo sprintf(__('Group Owner: %s'), $group['User']['name']); ?></h6>

						<div class="button-bar">
						  <ul class="button-group">
						    <li><a class = "button" href = "<?php echo $this->Html->url(array('action' => 'view', $group['Group']['id'])); ?>"><?php echo __('View');?></a></li>
						  </ul>
						  <ul class="button-group">
						   	<li><a href = "<?php echo $this->Html->url(array('controller' => 'groupsUsers', 'action' => 'send', $user['User']['id'], $group['Group']['id'])); ?>" class = "button"><?php echo __('Send request to join');?></a></li>
						  </ul>
						</div> -->
	  				<?php endforeach; ?>

	  			<?php foreach($evokations as $e):?>
					<div class="row full-width evoke mission evokation bg-red adjust-row">
			  			
			  			<div class="medium-2 columns">

			  				<img src="https://graph.facebook.com/<?php echo $users['User']['facebook_id']; ?>/picture?type=large" width="110px"/>
						  		
						  	<div class = "evoke text-align">
						  		<a href = "<?php echo $this->Html->url(array('controller' => 'groups', 'action' => 'view', $e['Group']['id']));?>">
									<h6><?= $e['Group']['title']?></h6>
								</a>
							</div>
							
						</div>

						<div class="medium-7 columns">
							<h1><?= $e['Evokation']['title']?></h1>
						</div>
						<div class="medium-3 columns">
							
							<div class = "evoke text-align">
								<div class = "evoke evidence-icons social">
									<i class="fa fa-facebook-square fa-lg"></i>&nbsp;
									<i class="fa fa-google-plus-square fa-lg"></i>&nbsp;
									<i class="fa fa-twitter-square fa-lg"></i>
								</div>
								<a href = "<?php echo $this->Html->url(array('controller' => 'evokations', 'action' => 'view', $e['Evokation']['id']));?>" class = "evoke button general green"><?php echo __('View this project');?></a>
		    				</div>

						</div>
					</div>
				<?php endforeach;?>
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
			<?php if(isset($mission)): ?>
				<a href = "<?php echo $this->Html->url(array('controller' => 'groups', 'action' => 'add', $mission['Mission']['id'])); ?>" class = "button"><?php echo __('Create a group');?></a>
			<?php else : ?>
				<a href = "<?php echo $this->Html->url(array('controller' => 'groups', 'action' => 'add')); ?>" class = "button"><?php echo __('Create a group');?></a>
			<?php endif; ?>
		</div>
	</div>
</section>