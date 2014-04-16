<?php

	echo $this->Html->css('jcarousel');
	echo $this->Html->css('sticky_note');
	echo $this->Html->css('ribbon');

	$this->extend('/Common/topbar');
	$this->start('menu');
	
	echo $this->element('header', array('user' => $user));
	$this->end(); 

?>

<section class="evoke background padding top-2">

	<?php echo $this->Session->flash(); ?>

	<nav class="evoke breadcrumbs">
	  <?php echo $this->Html->link(__('Missions'), array('controller' => 'missions', 'action' => 'index')); ?>

	  <a class="unavailable" href="#"><?php echo sprintf(__('Mission %s'), $mission['Mission']['title']);?></a>

	  	<?php foreach($missionPhases as $mp):

	  		if($mp['Phase']['position'] < $missionPhase['Phase']['position'])
	  			echo $this->Html->link($mp['Phase']['name'], array('controller' => 'missions', 'action' => 'view', $mission['Mission']['id'], $mp['Phase']['position']));

  		endforeach; ?>

	  <a class="current" href="#"><?php echo $missionPhase['Phase']['name'];?></a>
	</nav>

	<?= $this->element('mission_status', array('missionPhases' => $missionPhases, 'missionPhase' => $missionPhase, 'completed' => $completed, 'total' => $total)) ?>

	<div class = "evoke missions data">
  		<h1 style = "margin-bottom: 50px;"><?php echo __('Mission: '); echo h($mission['Mission']['title']); ?></h1>
	</div>

	<div class="row full-width">
		  <div class="small-6 medium-6 large-6 columns evoke mission pink">
		  	<fieldset>
			  	<legend><?= __('Latest Projects') ?></legend>
			  	<?php foreach($evokations as $e):
				  		echo $this->element('evokation_box', array('e' => $e, 'evokationsFollowing' => $evokationsFollowing));
		  			endforeach;?>
			</fieldset>
		  </div>
		  <div class="small-6 medium-6 large-6 columns evoke mission green">
		  	<fieldset>
			  	<legend><?= __('Succefully Launched Projects') ?></legend>
				  	<?php foreach($evokations as $e):
				  		//echo $this->element('evokation_red_box', array('e' => $e));
			  		endforeach;?>
			</fieldset>
		  </div>
	</div>

	<!-- <div class = "evoke position">
		<img src = '<?= $this->webroot.'img/small_bar.png' ?>' class = "evoke horizontal_bar left">
		<div class = "evoke titles"><h4><?php echo strtoupper(__('Mission Activities'));?></h4></div>
	</div> -->

  	<?= $this->element('left_titlebar', array('title' => __('Mission Activities'))) ?>

	<div class="row full-width">
	  <div class="small-7 medium-7 large-7 columns padding">
	  	<div class="jcarousel-wrapper carousel-width">

		  	<div class="jcarousel">
                <ul>
                    <?php foreach ($quests as $q): ?>

						<li>
							<div class = "missionblock postit" href="" data-reveal-id="<?= $q['Quest']['id'] ?>" data-reveal>
								<h1><?= $q['Quest']['title']?></h1>
							</div>
						

						<div id="<?= $q['Quest']['id'] ?>" class="reveal-modal large evoke lightbox" data-reveal>
						  <?= $this->element('quest', array('q' => $q, 'questionnaires' => $questionnaires, 'answers' => $answers))?>
						  <a class="evoke mission close-reveal-modal">&#215;</a>
						</div>
						</li>
					<?php endforeach; ?>
                </ul>
            </div>
        
		<a href="#" class="jcarousel-control-prev">&lsaquo;</a>
		<a href="#" class="jcarousel-control-next">&rsaquo;</a>

	    </div>
	  </div> 	
	  <div class="small-5 medium-5 large-5 columns padding-right">
	  	<?php if($missionPhase['Phase']['show_dossier'] == 1) : ?>
		  	<div class = "evoke titles-right">
		  		<img src = '<?= $this->webroot.'img/dossier.png' ?>'>
		  		<div>
		  		<dl class="tabs vertical evoke icons" data-tab>
				  <dd class="active"><a href="#panel31a"><i class="fa fa-file-text fa-2x"></i></a></dd>
				  <dd><a href="#panel32a"><i class="fa fa-link fa-2x"></i></a></dd>
				  <dd><a href="#panel33a"><i class="fa fa-picture-o fa-2x"></i></a></dd>
				  <dd><a href="#panel34a"><i class="fa fa-video-camera fa-2x"></i></a></dd>
				</dl>
				<div class="tabs-content vertical evoke icons">
				  <div class="content active" id="panel31a">

				  	<h1><?= __('Mission Dossier: Files')?></h1>
				    <ul>
					  	<?php 
							foreach ($dossier_files as $file):
								$type = explode('/', $file['Attachment']['type']);
								if($type[0] == 'application'): 
									$path = ' '.$this->webroot.'files/attachment/attachment/'.$file['Attachment']['dir'].'/'.$file['Attachment']['attachment'] . ''; ?>

								<li><a href="<?= $path ?>" data-reveal-id="<?= $file['Attachment']['id']?>" data-reveal><?= $file['Attachment']['attachment']?></a></li>

								<!-- <a href="#" data-reveal-id="myModal" data-reveal>Click Me For A Modal</a> -->
								<div id="<?= $file['Attachment']['id']?>" class="reveal-modal large" data-reveal>
								  <!-- <h2>Awesome. I have it.</h2>
								  <p class="lead">Your couch.  It is mine.</p>
								  <p>Im a cool paragraph that lives inside of an even cooler modal. Wins</p> -->
								  	<object data="<?= $path ?>" type="application/pdf" width="100%" height="100%" style = "height:900px">

									  <p>It appears you don't have a PDF plugin for this browser.
									  No biggie... you can <a href="myfile.pdf">click here to
									  download the PDF file.</a></p>
									  
									</object>
								  <a class="close-reveal-modal">&#215;</a> 
								</div>

						<?php endif; endforeach; ?>
					</ul>

				  </div>
				  <div class="content" id="panel32a">
				  	<h1><?= __('Mission Dossier: Links')?></h1>
				  </div>
				  <div class="content" id="panel33a">
				    <h1><?= __('Mission Dossier: Pictures')?></h1>
				    <ul>
					  	<?php 
							foreach ($dossier_files as $file):
								$type = explode('/', $file['Attachment']['type']);
								if($type[0] == 'image'): 
									$path = ' '.$this->webroot.'files/attachment/attachment/'.$file['Attachment']['dir'].'/'.$file['Attachment']['attachment'] . ''; ?>

								<li><a href="<?= $path ?>" data-reveal-id="<?= $file['Attachment']['id']?>" data-reveal><?= $file['Attachment']['attachment']?></a></li>

								<!-- <a href="#" data-reveal-id="myModal" data-reveal>Click Me For A Modal</a> -->
								<div id="<?= $file['Attachment']['id']?>" class="reveal-modal small" data-reveal>
								  <img src = "<?= $path?>"/>
								  <a class="close-reveal-modal">&#215;</a> 
								</div>

						<?php endif; endforeach; ?>
					</ul>

				  </div>
				  <div class="content" id="panel34a">
				    <h1><?= __('Mission Dossier: Videos')?></h1>
				    <ul>
					  	<?php 
							foreach ($dossier_files as $file):
								//echo $file['Attachment']['attachment'];
								//echo $file['Attachment']['type'];
								$type = explode('/', $file['Attachment']['type']);
								if($type[0] == 'video'): 
									$path = ' '.$this->webroot.'files/attachment/attachment/'.$file['Attachment']['dir'].'/'.$file['Attachment']['attachment'] . ''; ?>

								<li><a href="<?= $path ?>" data-reveal-id="<?= $file['Attachment']['id']?>" data-reveal><?= $file['Attachment']['attachment']?></a></li>

								<!-- <a href="#" data-reveal-id="myModal" data-reveal>Click Me For A Modal</a> -->
								<div id="<?= $file['Attachment']['id']?>" class="reveal-modal large" data-reveal>
								  <!-- <h2>Awesome. I have it.</h2>
								  <p class="lead">Your couch.  It is mine.</p>
								  <p>Im a cool paragraph that lives inside of an even cooler modal. Wins</p> -->
								  	<div class="flex-video">
									        <iframe width="420" height="315" src="<?= $path ?>" frameborder="0" allowfullscreen></iframe>
									</div>
								  <a class="close-reveal-modal">&#215;</a> 
								</div>

						<?php endif; endforeach; ?>
					</ul>
				  </div>
				</div>
				</div>

	  		</div>
	  	<?php endif; ?>
	  </div>
	</div>

    <div class="row full-width">
	  <div class="small-8 medium-8 large-8 columns">
	  	<div class = "evoke position">
			<img src = '<?= $this->webroot.'img/small_bar.png' ?>' class = "evoke horizontal_bar left">
			<dl class="tabs evoke titles" data-tab>
				  <dd><h4><?php echo strtoupper(__('Projects'));?></h4></dd>
				  <dd class="active"><a href="#panel2-1"><?= strtoupper(__('Most Voted'))?></a></dd>
				  <dd><a href="#panel2-2"><?= strtoupper(__('Most Recent'))?></a></dd>
			</dl>

			<div class="evoke tabs-content screen-box dashboard panel">
			  <div class="content active" id="panel2-1">
				<?php
					foreach($evokations as $e):
						echo $this->element('evokation_box', array('e' => $e));
					endforeach;?>
			  </div>
			  <div class="content" id="panel2-2">
			  </div>
			</div>
		</div>
	  </div>
	  <div class="small-4 medium-4 large-4 columns">
	  		

		<div class = "evoke position" style = "margin: 5% 15%;">
			<img src = '<?= $this->webroot.'img/espiral.png' ?>' style = " width: 100%;">
			<div class = "evoke todo-list">
				<div class = "evoke todo-list content">
					<h1><?= strtoupper(__('To-Do List')) ?></h1>
					<ul>
						<?php foreach($quests as $q):
							//only add to checklist quests that are mandatory
							if($q['Quest']['mandatory'] != 1) continue;
							
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

							//if its a group type quest, check to see if user owns or belongs to a group of this mission
							if($q['Quest']['type'] == 3) {
								if($hasGroup) {
									$evidence_exists = true;
								}
							}

							//debug($previous_answers);
							if($evidence_exists):?>
								<li><h2 class = "evoke item-complete"><?php echo $q['Quest']['title'];?></h2></li>
							<?php else: ?>
								<li><h2><?php echo $q['Quest']['title'];?></h2></li>
							<?php endif; 

						endforeach; ?>

				  	</ul>
                </div>
			</div>

			<?php if(isset($nextMP)){ ?>

		  	<a href = "<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'view', $mission['Mission']['id'], $nextMP['Phase']['position'])); ?>" class = "button general blue"><?php echo sprintf(__('Go to %s'), $nextMP['Phase']['name']);?>&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right fa-lg"></i></a> </br>

		  	<?php } if(isset($prevMP)) {?>

		  	<a href = "<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'view', $mission['Mission']['id'], $prevMP['Phase']['position'])); ?>" class = "button general green"><i class="fa fa-arrow-left fa-lg"></i>&nbsp;&nbsp;&nbsp;<?php echo sprintf(__('Go back to %s'), $prevMP['Phase']['name']);?></a>

		  	<?php } ?>

		</div>
	  	
	  </div>
	</div>

</section>

<?php

	echo $this->Html->script('/components/jquery/jquery.min', array('inline' => false));
	echo $this->Html->script('/components/jcarousel/dist/jquery.jcarousel', array('inline' => false));
	//echo $this->Html->script('/components/jcarousel/examples/basic/jcarousel.basic');
	//echo $this->Html->script('/components/jcarousel/examples/skeleton/jcarousel.skeleton');
	echo $this->Html->script('/components/jcarousel/examples/responsive/jcarousel.responsive', array('inline' => false));

?>

<script>

	$('.jcarousel').jcarousel('scroll', '3');

</script>