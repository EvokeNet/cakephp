<?php
	$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $user));
	$this->end(); 
	
?>

<section class="evoke background padding top-2">
	<?= $this->element('left_titlebar', array('title' => sprintf(__('Evokation Teams: %s'), $mission['Mission']['title']))) ?>
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