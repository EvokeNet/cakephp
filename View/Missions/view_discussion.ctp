<?php

	echo $this->Html->css('jcarousel');
	echo $this->Html->css('sticky_note');
	echo $this->Html->css('ribbon');

	$this->extend('/Common/topbar');
	$this->start('menu');
	
	echo $this->element('header', array('user' => $user));
	$this->end(); 
	
	if($lang == 'es') : 
		$video = $mission['Mission']['video_link_es'];
		$novels = $novels_es;
	else :
		$video = $mission['Mission']['video_link'];
		$novels = $novels_en;
	endif; 
?>

<section class="evoke default-background">

	<?php echo $this->Session->flash(); ?>

	<div class="evoke default row full-width-alternate">
		<div class="small-2 medium-2 large-2 columns">
	  		<?php echo $this->element('menu', array('user' => $user));?>
	  	</div>
		<div class = "small-9 medium-9 large-9 columns maincolumn">
			
			<div class = "evoke missions graphic-cover">
				<?php if(!empty($novels)) :?>
	 				<ul class="clearing-thumbs clearing-feature" data-clearing>		

		 				<li class="clearing-featured-img ">
		 					<div class = "evoke missions graphic-cover-img">
			 					<a href="<?= $this->webroot.'img/hq_cover.jpg'; ?>">
			 						<img src="<?= $this->webroot.'img/hq_cover.jpg'?>">
		 						</a>
	 						</div>
 						</li>
		 				
		 				<?php foreach ($novels as $novel) : ?>
							<li><a href="<?= $this->webroot.'files/attachment/attachment/'.$novel['Novel']['page_dir'].'/'.$novel['Novel']['page_attachment'].''; ?>"><img src="<?= $this->webroot.'files/attachment/attachment/'.$novel['Novel']['page_dir'].'/'.$novel['Novel']['page_attachment'] ?>" width="100%"></a></li>
						<?php endforeach; ?>

					</ul>
					<!-- <img src = '<?= $this->webroot.'img/episodio10.jpg' ?>'> -->
					<div class = "evoke ribbon-position">
				  		<div class="ribbon-wrapper">
							<div class="ribbon-front">
								<?= __('Graphic Novel') ?>
							</div>
							<div class="ribbon-edge-topleft"></div>
							<div class="ribbon-edge-topright"></div>
							<div class="ribbon-edge-bottomleft"></div>
							<div class="ribbon-edge-bottomright"></div>
							<div class="ribbon-back-left"></div>
							<div class="ribbon-back-right"></div>
						</div>
					</div>
				<?php endif ?>
			</div>

			<div class = "evoke missions header tint">
				<h3> <?= strtoupper($mission['Mission']['title']) ?> </h3>
				<?= $this->element('mission_status', array('missionPhases' => $missionPhases, 'missionPhase' => $missionPhase, 'completed' => $completed, 'total' => $total)) ?>
				<?php if(!is_null($mission['Mission']['cover_dir'])) :?>
					<img src="<?= $this->webroot.'files/attachment/attachment/'.$mission['Mission']['cover_dir'].'/'.$mission['Mission']['cover_attachment'] ?>" style = "height:22vw">
                <?php else :?>
					<img src = '<?= $this->webroot.'img/E01G01P02.jpg' ?>' style = "height:22vw">
                <?php endif ?>
			</div>

			<div class="row full-width-alternate">
			  <div class="small-9 medium-9 large-9 columns">
			  	<dl class="default tabs" data-tab>
				  <dd class="active"><a href="#panel2-1"><?= strtoupper(__('Mission Description')) ?></a></dd>
				  <dd><a href="#panel2-2"><?= strtoupper(__('Quests')) ?></a></dd>
				  <dd><a href="#panel2-3"><?= strtoupper(__('Dossier')) ?></a></dd>
				  <dd><a href="#panel2-4"><?= strtoupper(__('Evidence Stream')) ?></a></dd>
				</dl>
				<div class="evoke content-block default tabs-content mission tabs">
				  <div class="content active description" id="panel2-1">
				    
				    <?php if(!is_null($video) && $video != '') : ?>
				  		<div class="flex-video widescreen vimeo" style = "margin-top:50px">
						  <iframe src="<?= $video ?>" width="400" height="225" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
						</div>
					<?php endif; ?>

			  		<p><?= $mission['Mission']['description'];?></p>

				  </div>
				  <div class="content" id="panel2-2">
				    <ul class="small-block-grid-4">

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
									<div class = "quests" href="" data-reveal-id="<?= $q['Quest']['id'] ?>" data-reveal>
										<h1><?= $q['Quest']['title']?></h1>
									</div>
								

								<div id="<?= $q['Quest']['id'] ?>" class="reveal-modal large evoke lightbox" data-reveal>
								  <?= $this->element('quest', array('q' => $q, 'questionnaires' => $questionnaires, 'answers' => $answers))?>
								  <a class="evoke mission close-reveal-modal">&#215;</a>
								</div>
								</li>
							<?php else: ?>
								<li>
									<div class = "quests" href="" data-reveal-id="<?= $q['Quest']['id'] ?>" data-reveal>
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
				  </div>
				  <div class="content dossier" id="panel2-3">

				    <i class="fa fa-file-text fa-2x"></i><h2><?= __('Mission Dossier: Files')?></h2>
				    <ul>
					  	<?php 
							foreach ($dossier_files as $file):
								if($file['Attachment']['language']!=$lang) continue;
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

					<i class="fa fa-link fa-2x"></i><h2><?= __('Mission Dossier: Links')?></h2>
					<ul>
						<?php foreach($links as $link): ?>
							<li>
								<a href = "//<?= $link['DossierLink']['link'] ?>" target="_blank"><?= $link['DossierLink']['title'] ?></a>&nbsp;-&nbsp;
								<?= $link['DossierLink']['description'] ?>
							</li>
						<?php endforeach; ?>
					</ul>

					<i class="fa fa-picture-o fa-2x"></i><h2><?= __('Mission Dossier: Pictures')?></h2>

					    <ul class="small-block-grid-4">
						  	<?php 
								foreach ($dossier_files as $file):
									if($file['Attachment']['language']!=$lang) continue;
									$type = explode('/', $file['Attachment']['type']);
									if($type[0] == 'image'): 
										$path = ' '.$this->webroot.'files/attachment/attachment/'.$file['Attachment']['dir'].'/'.$file['Attachment']['attachment'] . ''; ?>

									<li><a href="<?= $path ?>" data-reveal-id="<?= $file['Attachment']['id']?>" data-reveal><img src = "<?= $path?>"/></a></li>

									<!-- <a href="#" data-reveal-id="myModal" data-reveal>Click Me For A Modal</a> -->
									<div id="<?= $file['Attachment']['id']?>" class="reveal-modal small" data-reveal>
									  <img src = "<?= $path?>"/>
									  <a class="close-reveal-modal">&#215;</a> 
									</div>

							<?php endif; endforeach; ?>
						</ul>

					<i class="fa fa-video-camera fa-2x"></i><h2><?= __('Mission Dossier: Videos')?></h2>
				    <ul>
					  	<?php 
							foreach ($dossier_files as $file):
								if($file['Attachment']['language']!=$lang) continue;
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

						<?php foreach ($video_links as $link): ?>

								<li><a href="#" data-reveal-id="<?= $link['DossierVideo']['id']?>" data-reveal><?= $link['DossierVideo']['title']?></a></li>

								<!-- <a href="#" data-reveal-id="myModal" data-reveal>Click Me For A Modal</a> -->
								<div id="<?= $link['DossierVideo']['id']?>" class="reveal-modal large" data-reveal>
								  <!-- <h2>Awesome. I have it.</h2>
								  <p class="lead">Your couch.  It is mine.</p>
								  <p>Im a cool paragraph that lives inside of an even cooler modal. Wins</p> -->
								  	<div class="flex-video">
									        <iframe width="420" height="315" src="<?= $link['DossierVideo']['video_link'] ?>" frameborder="0" allowfullscreen></iframe>
									</div>
								  <a class="close-reveal-modal">&#215;</a> 
								</div>

						<?php endforeach; ?>

					</ul>

				  </div>
				  <div class="content" id="panel2-4">
				    
				    <dl class="default tabs" data-tab>
						  <dd class="active"><a href="#panel12-1"><?= strtoupper(__('Most Liked'))?></a></dd>
						  <dd><a href="#panel12-2"><?= strtoupper(__('Most Recent'))?></a></dd>
						</dl>
					<div class="evoke content-block default tabs-content mission tabs">
					  <div class="content active" id="panel12-1">
						<?php 
				    		//Lists all projects and evidences
				    		foreach($liked_evidences as $likeds): 
				    				foreach ($likeds as $e) {
				    					echo $this->element('evidence', array('e' => $e)); 
				    				}
				    		endforeach; 
			    		?>
					  </div>
					  <div class="content" id="panel12-2">
					  		<?php 
					  			foreach($evidences as $e): 
					   				echo $this->element('evidence', array('e' => $e)); 
				    			endforeach; 
				    		?>
					  </div>
					</div>

				  </div>
				</div>
			  </div>

			  <div class="small-3 medium-3 large-3 columns padding top-2">

					<div class = "evoke todo-list content">
						<h1><?= strtoupper(__('To-Do List')) ?></h1>
						<ul class="small-block-grid-3">

							<?php if(isset($checklists)):
									foreach($checklists as $check):?>
								<li><h2><?= $check['PhaseChecklist']['item'] ?></h2></li>
							<?php endforeach; endif;?>

					  	</ul>

					  	<?php if(isset($nextMP)){ ?>

					  	<div class = "evoke text-align-center margin-top-20">
					  	<a href = "<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'view', $mission['Mission']['id'], $nextMP['Phase']['position'])); ?>" class = "button general blue"><?php echo sprintf(__('Go to %s'), $nextMP['Phase']['name']);?>&nbsp;&nbsp;&nbsp;<i class="fa fa-share-square fa-lg"></i></a>
					  	</div>

					  	<?php } if(isset($prevMP)) {?>

					  	<div class = "evoke text-align-center margin-top-20">
					  	<a href = "<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'view', $mission['Mission']['id'], $prevMP['Phase']['position'])); ?>" class = "button general green"><i class="fa fa-share-square fa-flip-horizontal fa-lg"></i>&nbsp;&nbsp;&nbsp;<?php echo sprintf(__('Go back to %s'), $prevMP['Phase']['name']);?></a>
					  	</div>

					  	<?php } ?>

	                </div>
				
			  </div>
			</div>

		</div>

		<div class="small-1 medium-1 large-1 end columns">
			
		</div>

	</div>

</section>

<?php
	echo $this->Html->script('menu_height', array('inline' => false));
?>