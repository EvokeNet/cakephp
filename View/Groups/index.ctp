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

<section class="evoke background padding top-2">
	<?= $this->element('left_titlebar', array('title' => __('Evokation Teams'))) ?>
	<div class="row full-width">
		<div class="small-6 small-centered columns">

			<dl class="tabs" data-tab>
			  <dd class="active"><a href="#panel2-1"><?php echo __('Evokation Teams');?></a></dd>
			  <dd><a href="#panel2-2"><?php echo __('My Evokation Teams');?></a></dd>
			  <dd><a href="#panel2-3"><?php echo __('Evokation Teams I Belong To');?></a></dd>
			</dl>
			<div class="evoke tabs-content screen-box margin panel group box-size">
			  <div class="content active" id="panel2-1">
			  	<?php
		  			foreach($groups as $e):
	  					echo $this->element('group_box', array('e' => $e, 'user' => $user));
	  			endforeach;?>
			   <!--  <?php
		  			foreach($evokations as $e):
	  					echo $this->element('evokation_red_box', array('e' => $e));
	  			endforeach;?> -->
			  </div>
			  <div class="content" id="panel2-2">
			    <?php
		  			foreach($myGroups as $e):
	  					echo $this->element('group_box', array('e' => $e, 'user' => $user));
	  			endforeach;?>
			  </div>
			  <div class = "content" id="panel2-3">
			  	<?php
		  			foreach($groupsIBelong as $e):
		  				echo $e['Group']['name'];
	  					echo $this->element('group_box', array('e' => $e, 'user' => $user));
	  			endforeach;?>
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