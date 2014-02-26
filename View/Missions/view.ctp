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
	<div class="row evoke missions">
	  <div class="small-11 small-centered columns">

	  	<nav class="breadcrumbs">
		  <?php echo $this->Html->link(__('Missions'), array('controller' => 'missions', 'action' => 'index')); ?>

		  <a class="unavailable" href="#"><?php echo sprintf(__('Mission %s'), $mission['Mission']['title']);?></a>

		  	<?php foreach($missionPhases as $mp):

		  		if($mp['Phase']['position'] < $missionPhase['Phase']['position'])
		  			echo $this->Html->link($mp['Phase']['name'], array('controller' => 'missions', 'action' => 'view', $mission['Mission']['id'], $mp['Phase']['position']));

	  		endforeach; ?>

		  <a class="current" href="#"><?php echo $missionPhase['Phase']['name'];?></a>
		</nav>

		<?php
			if(!is_null($mission_img)) :
				echo '<img src="' . $this->webroot.'files/attachment/attachment/'.$mission_img[0]['Attachment']['dir'].'/thumb_'.$mission_img[0]['Attachment']['attachment'] . '"/>';
			else :
				echo '<h4>Nenhuma img definida, mostrar uma padrao</h4>';
			endif;
		?>
	  	<h1><?php echo __('Mission: '); echo h($mission['Mission']['title']); ?></h1>
	  	<h4><?php echo __('Created by: '); echo $this->Html->Link($organized_by['Organization']['name'], array('controller' => 'organizations', 'action' => 'view', $organized_by['Organization']['id'])); ?></h4>
		<h2><?php echo __('Mission Brief'); ?></h2>
		<h4><?php echo h($mission['Mission']['description']); ?></h4>

		<h2><?php echo __('Quests: '); echo h($mission['Mission']['title']); ?></h2>

		<?php foreach ($quests as $q): ?>

			<div class = "missionblock"><a href="" data-reveal-id="<?= $q['Quest']['id'] ?>" data-reveal><?php echo $q['Quest']['title'];?></a></div>

			<div id="<?= $q['Quest']['id'] ?>" class="reveal-modal small" data-reveal>
			  <?= $this->element('quest', array('q' => $q, 'questionnaires' => $questionnaires, 'answers' => $answers));?>
			  <a class="close-reveal-modal">&#215;</a>
			</div>

		<?php endforeach; ?>

		<div class = "post-it"></div>

		<div class="row">
		  <div class="medium-9 columns">
		  	<h2><?php echo __('Discussions: ').$mission['Mission']['title']; ?></h2>

			<dl class="tabs" data-tab>
			  <dd class="active"><a href="#panel2-1"><?php echo __('Most Voted');?></a></dd>
			  <dd><a href="#panel2-2"><?php echo __('Most Recent');?></a></dd>
			  <dd><a href="#panel2-3"><?php echo __('My evidences');?></a></dd>
			</dl>
			<div class="tabs-content">
			  <div class="content active" id="panel2-1">
			  </div>
			  <div class="content" id="panel2-2">
			    <?php
			    	foreach($evidences as $e):
			    		//show only evidences related to this particular mission/phase
				   		if($e['Evidence']['mission_id'] == $mission['Mission']['id'] && $e['Evidence']['phase_id'] == $missionPhase['Phase']['id']): ?>

				   			<h4><?php echo $this->Html->link($e['Evidence']['title'], array('controller' => 'evidences', 'action' => 'view', $e['Evidence']['id']));?></h4>
				   			<p><?php echo substr($e['Evidence']['content'], 0, 200);?></p>
						
							
		    			<hr class="sexy_line" />
		    	<?php 
		    			endif;
		    		endforeach; 
		    	?>
			  </div>
			  <div class="content" id="panel2-3">
			  		<?php   	
			  	  	foreach ($my_evidences as $e) : ?>

						<h4><?php echo $this->Html->link($e['Evidence']['title'], array('controller' => 'evidences', 'action' => 'view', $e['Evidence']['id']));?></h4>
				    		<p><?php echo substr($e['Evidence']['content'], 0, 200);?></p>
						
					<?php endforeach; ?>
			  </div>
			</div>

		  </div>
		  <div class="medium-3 columns">
		  	<h2><?php echo __('To-do list');?></h2>
		  	<ul>
				<?php foreach($quests as $q):
					$evidence_exists = false;
					//if it was an 'evidence' type quest
					foreach($my_evidences as $e):
						if($q['Quest']['id'] == $e['Quest']['id']) {$evidence_exists = true; break;}
					endforeach;

					//if it was a questionnaire type quest
					foreach($questionnaires as $questionnaire):
						foreach ($previous_answers as $previous_answer) {
							if($q['Quest']['id'] == $questionnaire['Quest']['id'] && $questionnaire['Questionnaire']['id'] == $previous_answer['Question']['questionnaire_id']) {$evidence_exists = true; break;}
						}
					endforeach;

					//debug($previous_answers);
					if($evidence_exists):?>
						<li><i class="fa fa-check-square-o"></i>&nbsp;&nbsp;<?php echo $q['Quest']['title'];?></li>
					<?php else: ?>
						<li><i class="fa fa-square-o"></i>&nbsp;&nbsp;<?php echo $q['Quest']['title'];?></li>
					<?php endif; 

				endforeach; ?>

		  	</ul>

		  	<?php if(isset($nextMP)){ ?>

		  	<a href = "<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'view', $mission['Mission']['id'], $nextMP['Phase']['position'])); ?>" class = "button"><?php echo sprintf(__('Go to %s  ->'), $nextMP['Phase']['name']);?></a>

		  	<?php } if(isset($prevMP)) {?>

		  	<a href = "<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'view', $mission['Mission']['id'], $prevMP['Phase']['position'])); ?>" class = "button"><?php echo sprintf(__('<-  Go back to %s'), $prevMP['Phase']['name']);?></a>

		  	<?php } ?>

		  </div>
		</div>

	  </div>
	</div>
</section>
