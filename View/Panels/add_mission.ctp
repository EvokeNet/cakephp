<?php
	$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $user));
	$this->end(); 
	
?>

<section class="evoke margin top-2">
	<div class="row evoke max-width">
		<div class="small-12 medium-12 large-12 columns">
			<!-- <h1><?= __('Creating Mission')?><?php if(isset($id) && !is_null($id)) : echo ': ' . $mission['Mission']['title']; endif;?></h1> -->
			<dl class="tabs vertical" data-tab>
				<dd class="<?php echo $mission_tag ?>"><a href="#mission"><?= __('Mission Data') ?></a></dd>
			</dl>
			<div class="tabs-content vertical">
				<div class="content <?php echo $mission_tag ?> large-10 columns" id="mission">
					<div class="form">

						<?php 
							echo $this->Form->create('Mission', array(
 							   	'url' => array(
 							   		'controller' => 'panels',
 							   		'action' => 'add_mission'
 								),
 								'enctype' => 'multipart/form-data'
							));
							 
						?>
						<fieldset>
							<?php
								
								echo '<legend>'. __('Add a Mission') . '</legend>'; 
								echo $this->Form->input('Mission.title.eng', array('label' => __('Title'), 'required' => true));
								echo $this->Form->input('Mission.title.spa', array('label' => __('Spanish Title')));
								echo $this->Form->input('Mission.title.por_br', array('label' => __('Portuguese Title')));
								//echo $this->Form->input('title_es', array('label' => __('Spanish Title')));
								echo $this->Form->input('Mission.description.eng', array('label' => __('Description'), 'required' => true));
								echo $this->Form->input('Mission.description.spa', array('label' => __('Spanish Description')));
								echo $this->Form->input('Mission.description.por_br', array('label' => __('Portuguese Description')));
								//echo $this->Form->input('description_es', array('label' => __('Spanish Description')));
								echo $this->Form->input('video_link', array('label' => __('Video Link')));
								echo $this->Form->input('video_link_es', array('label' => __('Spanish Video Link')));
								echo $this->Form->radio('basic_training', array(0 => 'No', 1=>'Yes'), array('required' => true, 'default'=> 0));
								if(!is_null($mission['Mission']['image_dir'])) :
									echo '<img src="' . $this->webroot.'files/attachment/attachment/'.$mission['Mission']['image_dir'].'/thumb_'.$mission['Mission']['image_attachment'] . '"/>';
									echo '<div class="input file"><label for="AttachmentImgAttachment">Change Image</label><input type="file" name="data[Attachment][Img][attachment]" id="AttachmentImgAttachment"></div>';
								else :
									echo '<div class="input file"><label for="AttachmentImgAttachment">Image</label><input type="file" name="data[Attachment][Img][attachment]" id="AttachmentImgAttachment"></div>';
								endif;
								if(!is_null($mission['Mission']['cover_dir'])) :
									echo '<img src="' . $this->webroot.'files/attachment/attachment/'.$mission['Mission']['cover_dir'].'/thumb_'.$mission['Mission']['cover_attachment'] . '"/>';
									echo '<div class="input file"><label for="AttachmentCoverAttachment">Change Cover</label><input type="file" name="data[Attachment][Cover][attachment]" id="AttachmentCoverAttachment"></div>';
								else :
									echo '<div class="input file"><label for="AttachmentCoverAttachment">Cover</label><input type="file" name="data[Attachment][Cover][attachment]" id="AttachmentCoverAttachment"></div>';
								endif;
								echo $this->Form->hidden('form_type', array('value' => 'mission'));
								echo $this->Form->input('MissionIssue.issue_id', array(
        							'options' => $issues
        						));
        						echo $this->Form->input('organization_id', array(
										'label' => __('Created by'),
										'options' => $organizations
								));
							?>
						</fieldset>
						<button class="button small" type="submit">
							<?php echo __('Save and continue') ?>
						</button>
						<?php echo $this->Form->end(); ?>
					</div>
				</div>
			</div>
			<!-- encerrar tudo -->
			<?php 
				if((empty($phases) || is_null($phases)) && isset($id) && !is_null($id)):?>
					<button class="button small" href="#" data-reveal-id="myModalExit" data-reveal><?php echo __('Return to Admin Panel');?></button>
					<div id="myModalExit" class="reveal-modal tiny" data-reveal>
						<h4><?= __('Are you sure you want to exit to Admin Panel?') ?></h4>
						<p><?= __('Your mission has no Phase and, therefore, will not be displayed to other agents. Please add a Phase to your mission!') ?></p>
						<br><br>
						<?= $this->Html->Link(__('Stay in this page'), array('controller' => 'panels', 'action' => 'add_mission', $id), array( 'class' => 'button small')); ?>
						<?= $this->Html->Link(__('Exit anyway'), array('controller' => 'panels', 'action' => 'index', 'missions'), array( 'class' => 'button small alert')); ?>
						<a class="close-reveal-modal">&#215;</a>
					</div>
				<?php else :
					echo $this->Html->Link(__('Return to Admin Panel'), array('controller' => 'panels', 'action' => 'index', 'missions'), array( 'class' => 'button small')); 
				endif; ?>
		</div>
	</div>
</section>
<?php 
	echo $this->Html->script('/components/jquery/jquery.min.js');//, array('inline' => false));
?>