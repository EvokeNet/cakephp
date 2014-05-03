<?php

	echo $this->Html->css('jcarousel');
	echo $this->Html->css('sticky_note');
	echo $this->Html->css('ribbon');

	$this->extend('/Common/topbar');
	$this->start('menu');
	
	echo $this->element('header', array('user' => $user));
	$this->end(); 
	
?>

<section class="evoke background">

	<?= $this->element('menu', array('user' => $user)) ?>

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

	  		<div class="flex-video widescreen vimeo" style = "margin-top:50px">
			  <iframe src="http://player.vimeo.com/video/93164024" width="400" height="225" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
			</div>
			
	  		<p id="numero2"><?= $mission['Mission']['description'];?></p>
  		</div>

	  	<div class = "evoke position">
	  		<div style = "margin-left:100px" id="numero3"></div>
			<?= $this->element('left_titlebar', array('title' => __('Basic Training Activities'))) ?>
		</div>

		<ul class="small-block-grid-2 medium-block-grid-2 large-block-grid-2">
			<div style = "margin-left:400px" id="numero4"></div>
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
							<li>
								<div class = "missionblock postit postit-green" href="" data-reveal-id="<?= $q['Quest']['id'] ?>" data-reveal>
									<h1><?= $q['Quest']['title']?></h1>
								</div>
							

							<div id="<?= $q['Quest']['id'] ?>" class="reveal-modal large evoke lightbox" data-reveal>
							  <?= $this->element('quest', array('q' => $q, 'questionnaires' => $questionnaires, 'answers' => $answers))?>
							  <a class="evoke mission close-reveal-modal">&#215;</a>
							</div>
							</li>
						<?php else: ?>
							<li>
								<div class = "missionblock postit" href="" data-reveal-id="<?= $q['Quest']['id'] ?>" data-reveal>
									<h1><?= $q['Quest']['title']?></h1>
								</div>
							

							<div id="<?= $q['Quest']['id'] ?>" class="reveal-modal large evoke lightbox" data-reveal>
							  <?= $this->element('quest', array('q' => $q, 'questionnaires' => $questionnaires, 'answers' => $answers))?>
							  <a class="evoke mission close-reveal-modal">&#215;</a>
							</div>
							</li>
						<?php endif; 

					endforeach; ?>
		</ul>

		<div class = "evoke position">
	  		<div style = "margin-left:100px; margin-top:100px"></div>
			<?= $this->element('left_titlebar', array('title' => __('My Evidences'))) ?>

			<div class="evoke screen-box dashboard panel margin">
			  	<?php 
		    		//Lists all projects and evidences
		    		foreach($myevidences as $e): 
		    			echo $this->element('evidence_box', array('e' => $e));
		    		endforeach; 
	    		?>
			</div>
		</div>

	  </div>

	  <div class="small-5 medium-5 large-5 columns">

	  	<div class = "evoke position">
	  		<?php 
 				$language = 'ENGLISH';
 				if($lang == 'es') {
 					$language = 'SPANISH';
 				}
			?>

	  		<ul class="clearing-thumbs clearing-feature" data-clearing>
				<li class="clearing-featured-img "><a  href="<?= $this->webroot.'img/Evoke_00_'. $language .'_Pg01.jpg' ?>"><img src="<?= $this->webroot.'img/Evoke_00_'. $language .'_Pg01.jpg' ?>" width="60%"></a></li>
				<li><a href="<?= $this->webroot.'img/Evoke_00_'. $language .'_Pg02.jpg' ?>"><img src="<?= $this->webroot.'img/Evoke_00_'. $language .'_Pg02.jpg' ?>"></a></li>
				<li><a href="<?= $this->webroot.'img/Evoke_00_'. $language .'_Pg03.jpg' ?>"><img src="<?= $this->webroot.'img/Evoke_00_'. $language .'_Pg03.jpg' ?>"></a></li>
				<li><a href="<?= $this->webroot.'img/Evoke_00_'. $language .'_Pg04.jpg' ?>"><img src="<?= $this->webroot.'img/Evoke_00_'. $language .'_Pg04.jpg' ?>"></a></li>
				<li><a href="<?= $this->webroot.'img/Evoke_00_'. $language .'_Pg05.jpg' ?>"><img src="<?= $this->webroot.'img/Evoke_00_'. $language .'_Pg05.jpg' ?>"></a></li>
			</ul>
		</div>

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

			<?php if($missionPhase['Phase']['show_dossier'] == 1) : ?>
		  	<div class = "evoke titles-right" style = "width: 110%;">

		  	<div>
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
	  		</div>
	  	<?php endif; ?>
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
	echo $this->Html->script('/components/foundation/js/foundation.js', array('inline' => false));
	echo $this->Html->script('/components/foundation/js/foundation/foundation.clearing.js', array('inline' => false));
?>