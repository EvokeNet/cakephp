<?php
	$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $user));
	$this->end(); 

?>

<section class="evoke background padding top-2">

	<nav class="evoke breadcrumbs">
	  <?php echo $this->Html->link(__('Missions'), array('controller' => 'missions', 'action' => 'index')); ?>

	  <a class="unavailable" href="#"><?php echo sprintf(__('Mission %s'), $mission['Mission']['title']);?></a>

	  	<?php foreach($missionPhases as $mp):

	  		if($mp['Phase']['position'] < $missionPhase['Phase']['position'])
	  			echo $this->Html->link($mp['Phase']['name'], array('controller' => 'missions', 'action' => 'view', $mission['Mission']['id'], $mp['Phase']['position']));

  		endforeach; ?>

	  <a class="current" href="#"><?php echo $missionPhase['Phase']['name'];?></a>
	</nav>
	
	<?php if(isset($mission['Mission'])):  
		echo $this->element('left_titlebar', array('title' => sprintf(__('Evokation Teams: %s'), $mission['Mission']['title'])));
	endif; ?>
	<div class="row full-width">
		<div class="small-8 small-centered columns">

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
	  				endforeach;
	  			?>
			  </div>
			  <div class="content" id="panel2-2">
			    <?php
		  			foreach($myGroups as $e):
	  					echo $this->element('group_box', array('e' => $e, 'user' => $user));
	  				endforeach;
	  			?>
			  </div>
			  <div class = "content" id="panel2-3">
			  	<?php
		  			foreach($groupsIBelong as $e):
	  					echo $this->element('group_box', array('e' => $e, 'user' => $user));
	  				endforeach;
	  			?>
			  </div>
			</div>

			<?php if(isset($mission['Mission'])): ?>
				<a class="button general" href="" data-reveal-id="newGroup" data-reveal>
					<span><?php echo __('Create a group');?></span>
				</a>
				<div id="newGroup" class="reveal-modal large evoke lightbox" data-reveal>
					<?= $this->element('add_group', array('mission' => $mission, 'userid' => $user['User']['id']));?>
					<a class="close-reveal-modal">&#215;</a>
				</div>

			<?php else : ?>
				<a class="button general" href="" data-reveal-id="newGroup" data-reveal>
					<span><?php echo __('Create a group');?></span>
				</a>
				<div id="newGroup" class="reveal-modal large evoke lightbox" data-reveal>
					<?= $this->element('add_group', array('userid' => $user['User']['id']));?>
					<a class="close-reveal-modal">&#215;</a>
				</div>

			<?php endif; ?>
		</div>
	</div>
</section>