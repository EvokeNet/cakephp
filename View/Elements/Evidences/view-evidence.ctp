<?php
if (isset($evidence)):
?>

<div class="row full-width">
	<?php
	//BREADCRUMBS MENU
	if (isset($show_breadcrumbs) && ($show_breadcrumbs == true)): ?>
	  	<nav class="breadcrumbs margin top-1 bottom-1">
	  		<!-- MISSION -->
			<?php echo $this->Html->link(
				__('Mission: ').$evidence['Mission']['title'], 
				array('controller' => 'missions', 'action' => 'view_mission', $evidence['Mission']['id'])
			); ?>

			<!-- PHASE -->
			<?php echo $this->Html->link($evidence['Phase']['name'], array('controller' => 'missions', 'action' => 'view', $evidence['Mission']['id'], $evidence['Phase']['position']));?>

			<!-- EVIDENCE -->
			<a class="current" href="#"><?php echo $evidence['Evidence']['title'];?></a>
		</nav> <?php 
	endif; ?>

	<!-- EVIDENCE CONTENT -->
	<div class="row full-width">
		<?php
		if (!$ajax): ?>
			<!-- DETAILS ON THE LEFT -->
			<div class="hide-for-small-only medium-4 large-3 columns padding right-2">
				<div class="text-center padding left-2 right-1">
					<!-- USER INFO - EVIDENCE CREATOR -->
					<a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'profile', $evidence['User']['id']))?>">
						<?php $pic = $this->UserPicture->getPictureAbsolutePath($evidence['User']); ?>
						<div class="margins-auto square-150px background-cover background-center img-circular" style="background-image: url(<?= $pic ?>);">
							<img class="hidden" src="<?= $pic ?>" alt="<?= $evidence['User']['name'] ?>'s profile picture" /> <!-- For accessibility -->
						</div>
						<h4 class="text-color-highlight"><?= __('By ').$evidence['User']['name']?></h4>
					</a>


					<?php 
					//USER OWNS THIS EVIDENCE - CAN EDIT AND DELETE
					if(isset($loggedInUser) && ($evidence['Evidence']['user_id'] == $loggedInUser['id'])): ?>
						<div class="row padding top-1 bottom-1 text-center font-size-small">
							<a id="buttonEditEvidence" href="<?php echo $this->Html->url(array('controller'=> 'evidences', 'action' => 'edit', $evidence['Evidence']['id'])); ?>" alt="<?= __('Edit Evidence') ?>" class="button thin">
								<?php echo __('Edit Evidence');?>
							</a>

							<a id="buttonDeleteEvidence" href="<?php echo $this->Html->url(array('controller'=> 'evidences', 'action' => 'delete', $evidence['Evidence']['id'])); ?>" alt="<?= __('Delete Evidence') ?>" class="button thin">
								<?php echo __('Delete Evidence');?>
							</a>
						</div><?php
					else: ?>
						<!-- SOCIAL NETWORKS -->
						<div class="row padding top-1 bottom-1 text-center">
							<?php echo $this->element('social_networks_bar', array('social_networks_user' => $evidence['User'])) ?>
						</div><?php
					endif; ?>

					<!-- QUEST DESCRIPTION -->
					<div class="row padding top-1 bottom-1 border-top-divisor text-center">
						<h4><?= __('Quest ').$evidence['Quest']['title']?></h4>
						<p>
							<?php
							if (isset($evidence['Quest']['description'])) {
								echo $this->Text->getExcerpt($evidence['Quest']['description'], 30, '...');
							}
							?>
						</p>
					</div>
				</div>
			</div><?php
		endif; ?>

		<!-- EVIDENCE CONTENT -->
		<div class="small-12 <?= (!$ajax) ? 'medium-8 large-9' : 'margin left-1' ?> columns">
		 	<div class="padding all-1">
		 		<!-- TITLE -->
				<h1 class="text-glow">
					<?php echo urldecode($evidence['Evidence']['title']); ?>
				</h1>

				<!-- USER INFO -->
				<p>
					<?= __("Created in ") ?>
					<?= h($evidence['Evidence']['created']) ?>
					<?php
						//ADDITIONAL USER INFO IF AJAX
						if ($ajax): ?>
							<?= __(' by ').$evidence['User']['name']?><?php
						endif; 
					?>

					<!-- EDIT/DELETE -->
					<?php
					if($ajax): 
						//USER OWNS THIS EVIDENCE - CAN EDIT AND DELETE
						if(isset($loggedInUser) && ($evidence['Evidence']['user_id'] == $loggedInUser['id'])): ?>
							<!-- EDIT -->
							<a id="buttonEditEvidence" href="<?php echo $this->Html->url(array('controller'=> 'evidences', 'action' => 'edit', $evidence['Evidence']['id'])); ?>" alt="<?= __('Edit Evidence') ?>" class="padding left-1">
								<i class="fa fa-pencil fa-lg"></i>
							</a>

							<!-- DELETE -->
							<a id="buttonDeleteEvidence" href="<?php echo $this->Html->url(array('controller'=> 'evidences', 'action' => 'delete', $evidence['Evidence']['id'])); ?>" alt="<?= __('Delete Evidence') ?>" class="padding left-1">
								<i class="fa fa-times-circle fa-lg"></i>
							</a><?php
						endif;
					endif; ?>
				</p>
			</div>

			<!-- RATING/SHARE BAR -->
			<div class="padding top-05 bottom-05 border-top-divisor">
				<ul class="inline-list margins-0">
					<!-- RATING -->
					<li>
						<h6 class="text-color-highlight"><?= __('VOTE') ?></h6>
					</li>
					<li>
						<?php
						//ALREADY VOTED
						if (count($like) > 0) : ?>
							<span data-tooltip aria-haspopup="true" class="has-tip" title="<?= __('You have already voted on this evidence') ?>">
								<a class="button-icon disabled" disabled
									href="<?= $this->Html->url(array('controller' => 'likes', 'action' => 'add', $evidence['Evidence']['id']))?>">
									<i class="fa fa-thumbs-up text-color-highlight-important fa-1x"></i>
								</a>
							</span><?php
						else: ?>
							<a class="button-icon"
								href="<?= $this->Html->url(array('controller' => 'likes', 'action' => 'add', $evidence['Evidence']['id']))?>">
								<i class="fa fa-thumbs-o-up text-color-yellow fa-1x"></i>
							</a><?php
						endif; ?>
						
					</li>
					<li class="margins-0">
						<span class="text-color-yellow">&nbsp; <?= count($likes) ?></span>
					</li>

					<!-- COMMENTS -->
					<li class="padding left-1">
						<h6 class="text-color-highlight"><?= __('COMMENTS') ?></h6>						
					</li>
					<li class="margins-0">
						<span class="text-color-yellow">&nbsp; <?= count($comments) ?></span>
					</li>

					<!-- SHARE -->
					<li class="padding left-1">
						<h6 class="text-color-highlight"><?= __('SHARE') ?></h6>
					</li>
					<li>
						<a class="button-icon" href="javascript:fbShare('<?= $_SERVER['SERVER_NAME']."/evidences/view/".$evidence['Evidence']['id'] ?>')" alt="<?= __('Share on facebook') ?>">
							<span class="fa-stack fa-small">
								<i class="fa fa-square fa-stack-1x fa-12x facebook-icon"></i>
								<i class="fa fa-facebook fa-stack-1x fa-07x fa-inverse "></i>
							</span>
						</a>
					</li>
					<li>
						<a class="button-icon" href="#" onclick="popUp=window.open('https://plus.google.com/share?url=<?= $_SERVER['SERVER_NAME']."/evidences/view/".$evidence['Evidence']['id'] ?>', 'popupwindow', 'scrollbars=yes,width=800,height=400');popUp.focus();return false" alt="<?= __('Share on google plus') ?>">
							<span class="fa-stack fa-small">
								<i class="fa fa-square fa-stack-1x fa-12x google-icon"></i>
								<i class="fa fa-google-plus fa-stack-1x fa-07x fa-inverse "></i>
							</span>
						</a>
					</li>

					<!-- VIEW FULL PAGE -->
					<?php
					if ($ajax): ?>
					<li class="padding left-1">
						<h6 class="text-color-highlight"><?= __('VIEW') ?></h6>
					</li>
					<li>
						<span data-tooltip aria-haspopup="true" class="has-tip" title="<?= __('Open evidence page') ?>">
							<a target="_blank" href="<?= $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $evidence['Evidence']['id']))?>">
								<span class="fa-stack fa-small">
									<i class="fa fa-square fa-stack-1x fa-12x"></i>
									<i class="fa fa-expand fa-stack-1x fa-07x fa-inverse text-color-dark"></i>
								</span>
							</a>
						</span>
					</li><?php
					endif;
					?>
				</ul>
			</div>

			<!-- CONTENT -->
			<div class="padding all-1 border-top-divisor" id="evidenceContentWrapper">
				<?php echo urldecode($evidence['Evidence']['content']); ?>
			</div>

			<!-- ATTACHMENTS -->
			<?php if(!empty($attachments)): ?>
			<div class="padding all-1 border-top-divisor text-center">
		  		<h4 class="text-color-highlight"><?= __("Evidence's attachments:")?></h4>
		  		<?php 
		  			$images = array();
		  			$pdfs = array();
		  			$docs = array();
		  			foreach ($attachments as $attachment) :
		  				$type = explode('/', $attachment['Attachment']['type']);
						if($type[0] == 'application' && $type[1] != 'octet-stream' && $type[1] == 'pdf'): 
							$pdfs[] = $attachment;
						elseif($type[0] == 'application' && ($type[1] == 'msword' || $type[1] == 'vnd.openxmlformats-officedocument.wordprocessingml.document')): 
							$docs[] = $attachment;
						else :
							if($type[0] == 'image')
								$images[] = $attachment;
						endif;

					endforeach; 
				?>

				<?php if(!empty($images)) :?>
			  	  	<ul class="clearing-thumbs" data-clearing>		

				  		<?php foreach ($images as $attachment) :?>
							<li>
			 					<a href="<?= $this->webroot.'files/attachment/attachment/'.$attachment['Attachment']['dir'].'/'.$attachment['Attachment']['attachment'].''; ?>">
			 						<img src="<?= $this->webroot.'files/attachment/attachment/'.$attachment['Attachment']['dir'].'/thumb_'.$attachment['Attachment']['attachment'] ?>" width="100%">
			 					</a>
		 					</li>
				  		<?php endforeach ?>
					</ul>
				<?php endif ?>

				<?php if(!empty($pdfs)) :?>
			  	  	
				  	<?php foreach ($pdfs as $attachment) :?>
				  		<?php $path = ' '.$this->webroot.'files/attachment/attachment/'.$attachment['Attachment']['dir'].'/'.$attachment['Attachment']['attachment'] . ''; ?>

						<li><a href="<?= $path ?>" data-reveal-id="<?= $attachment['Attachment']['id']?>" data-reveal><?= $attachment['Attachment']['attachment']?></a></li>

						
						<div id="<?= $attachment['Attachment']['id']?>" class="reveal-modal large" data-reveal>
						 	<object data="<?= $path ?>" type="application/pdf" width="100%" height="100%" style = "height:900px">

							  	<p>
							  		It appears you don't have a PDF plugin for this browser. No biggie... you can 
									<a href="myfile.pdf">click here to download the PDF file.</a>
								</p>
								  
							</object>
							<a class="close-reveal-modal">&#215;</a> 
						</div>
				  	<?php endforeach ?>
					
				<?php endif ?>

				<?php if(!empty($docs)) :?>
			  	  	
				  	<?php foreach ($docs as $attachment): ?>
				  		<?php $path = ' '.$this->webroot.'files/attachment/attachment/'.$attachment['Attachment']['dir'].'/'.$attachment['Attachment']['attachment'] . ''; ?>

						<li><a href="<?= $path ?>" target = '_blank'><?= $attachment['Attachment']['attachment']?></a></li>

				  	<?php endforeach; ?>
					
				<?php endif; ?>
			</div>  	
			<?php endif; ?>

			<!-- POST A COMMENT -->
			<div class="padding all-1 border-top-divisor clearfix">
				<h4 class="text-color-highlight"><?= strtoupper(__('Share a Thought')) ?></h4>

				<div class="padding left-2 right-2">
					<?php 
					// echo $this->fetch('script2');
						echo $this->element('comment_form', array(
							'evidence_id' => $evidence['Evidence']['id'],
							'user_id' => $loggedInUser['id'],
							'content' => '',
							'button_class' => 'button thin margin top-05 text-center text-glow-on-hover right',
							'button_icon' => false
						));

					?>
					<?php
						//Form with redis
						// echo $this->Form->input('mm', array('type' => 'textarea', 'label' => __('Comment:'), 'class' => 'radius'));
						// echo '<button id="commenties" class="button thin disabled">'.__('Send').'</button>';
					?>
				</div>
			</div>

			<!-- COMMENTS -->
			<div class="padding all-1 border-top-divisor">
				<?php 
					foreach ($comments as $c):
						echo $this->element('comment_box', array('comment' => $c));
					endforeach; 
				?>

				<div class="newcomments" id="ncom"></div>
			</div>
		</div>
	</div>
</div>

<?php
endif;
?>

<?php
	//SCRIPT
	$this->Html->script('requirejs/app/Elements/Evidences/view-evidence.js', array('inline' => false));
?>