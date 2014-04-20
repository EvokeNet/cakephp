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

	<div class="row full-width">

		<div class="row">
		  <div class="small-3 small-centered columns" id="firstStop"></div>
		</div>

		<div class="row">
		  <div class="small-3 small-centered columns" id="numero"></div>
		</div>

	  <div class="small-7 medium-7 large-7 columns padding-left">

	  	<div class = "evoke missions data">
	  		<h2 id="numero1"><?php echo __('Mission: '); echo h($mission['Mission']['title']); ?></h2>
	  		<p id="numero2"><?= $mission['Mission']['description'];?></p>
  		</div>

	  	<div class = "evoke position">
	  		<div style = "margin-left:100px" id="numero3"></div>
			<?= $this->element('left_titlebar', array('title' => __('Basic Training Activities'))) ?>
		</div>

		<ul class="small-block-grid-2 medium-block-grid-2 large-block-grid-2">
			<div style = "margin-left:400px" id="numero4"></div>
			<?php foreach ($quests as $q): ?>

				<li>
					<div class = "missionblock postit postit-2" href="" data-reveal-id="<?= $q['Quest']['id'] ?>" data-reveal>
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

	  <div class="small-5 medium-5 large-5 columns">

	  	<div class = "evoke position" style = "margin: 5% 15%;">
	  		<div style = "margin-left:100px" id="numero5"></div>
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
			</div>
	  	</div>
	</div>

	<ol class="joyride-list" data-joyride>
	  <li data-id="firstStop" data-text="Next" data-options="tip_location: top">
	    <p><?= __('Hello '.$user['User']['name'].'! Welcome to your Basic Training to become an active agent') ?></p>
	  </li>
	  <li data-id="numero" data-text="Next" data-options="tip_location: top">
	    <p><?= __('Here you will find tips on how to succeed in a Mission') ?></p>
	  </li>
	  <li data-id="numero1" data-class="custom so-awesome" data-text="Next">
	    <h4><?= __('Mission Description') ?></h4>
	    <p><?= __("Here's the Mission's Brief") ?></p>
	  </li>
	  <li data-id="numero2" data-button="Next" data-options="tip_location:top;tip_animation:fade">
	    <h4><?= __('Mission Description') ?></h4>
	    <p><?= __("You will have the mission's description along with its video and graphic novel") ?></p>
	  </li>
	  <li data-id="numero3" data-button="Next" data-options="tip_location:top;tip_animation:fade">
	    <h4><?= __('Activities') ?></h4>
	    <p><?= __("These are a series of tasks to do") ?></p>
	  </li>
	  <li data-id="numero4" data-button="Next" data-options="tip_location:top;tip_animation:fade">
	    <h4><?= __('Activities') ?></h4>
	    <p><?= __("Hou have to complete each one of these before you can move on to the next phase") ?></p>
	  </li>
	  <li data-id="numero5" data-button="Next" data-options="tip_location:top;tip_animation:fade">
	    <h4><?= __('Activities - TO-DO List') ?></h4>
	    <p><?= __("The obligatory ones will be listed here so you can keep track of them") ?></p>
	  </li>
	  <li data-id="numero10" data-button="Next" data-options="tip_location:top;tip_animation:fade">
	    <h4>Stop #3</h4>
	    <p>Get the details right by styling Joyride with a custom stylesheet!</p>
	  </li>
	  <li data-button="End">
	    <h4><?= __('Good luck!') ?></h4>
	    <p><?= __("Now, go out there and become an agent of change!") ?></p>
	  </li>
	</ol>

</section>

<?php
	// echo $this->Html->script("https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js", array('inline' => false));
	//echo $this->Html->script('/components/jquery/jquery.min');
	// echo $this->Html->script('/components/foundation/js/foundation.min.js', array('inline' => false));
	// echo $this->Html->script('/components/foundation/js/foundation/foundation.joyride.js', array('inline' => false));
	echo $this->Html->script('joyride', array('inline' => false));
	echo $this->Html->script('/components/foundation/js/vendor/jquery.cookie.js', array('inline' => false));
?>