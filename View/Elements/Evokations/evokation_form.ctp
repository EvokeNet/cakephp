<?php
$element_title = 'evidence';
if (isset($evokation_part) && ($evokation_part)) {
	$element_title = 'evokation part';
}

//SAMPLE FORM ALERT
if (isset($sample_form) && ($sample_form)): ?>
	<div data-alert class="alert-box warning radius margin top-2">
		<?= __('Alert: This is a sample form. In preview mode you cannot submit an actual evidence.'); ?>
	</div> <?php
endif;
?>

<div class="row">
	<div id="new-evidence-type">
		<!-- EXPLANATION -->
		<div id="evidence-type-title" class="row text-center margin top-3 bottom-2">
			<?= __('Your can choose the focus of your %s:', $element_title) ?>
		</div>

		<!-- BUTTONS TO CHOOSE EVIDENCE TYPE -->
		<div class="row text-center">
			<div class="centered-block text-glow-on-hover margin right-2">
				<!-- <a class="evidence-type" data-evidence-type="image">  -->
				<a href="#" data-reveal-id="imageLinkModal" class="evidence-type" data-evidence-type="image">
					<i class="fa fa-3x img-circular text-color-highlight ">
						<img src="../../../webroot/img/image_logo.png" height="100" width="100"></img>
					</i>
					<h4 class="text-color-highlight"><?= __('Image') ?></h4>
				</a>
			</div>
			<div class="centered-block text-glow-on-hover margin left-1 right-2">
				<a href="#" data-reveal-id="youTubeModal" >
					<!-- <a class="evidence-type" data-evidence-type="video"> -->
					<i class="fa fa-3x img-circular text-color-highlight ">
						<img src="../../../webroot/img/youtube_logo.png" height="100" width="100"></img>
					</i>
					<h4 class="text-color-highlight"><?= __('Video') ?></h4>
				</a>
			</div>
			<div class="centered-block text-glow-on-hover margin left-1 right-2">
				<a href="#" data-reveal-id="imageLinkModal" class="evidence-type" data-evidence-type="link">
					<i class="fa fa-3x img-circular text-color-highlight ">
						<img src="../../../webroot/img/link_logo.png" height="100" width="100"></img>
					</i>
					<h4 class="text-color-highlight"><?= __('Link') ?></h4>
				</a>
			</div>
			<div class="centered-block text-glow-on-hover margin left-1">
				<a href="#" data-reveal-id="googleDriveModal" ><!-- <a class="evidence-type" data-evidence-type="text"> -->
					<i class="fa fa-3x img-circular text-color-highlight ">
						<img src="../../../webroot/img/google_drive_logo.png" height="100" width="100"></img>
					</i>
					<h4 class="text-color-highlight"><?= __('Text') ?></h4>
				</a>
			</div>
		</div>
	</div>

	<!-- MODALS -->

	<!-- YOUTUBE -->
	<div id="youTubeModal" class="reveal-modal medium background-color-standard" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
	  <h2 id="modalTitle" class="text-glow">Show us your video:</h2>
	  <p>Insert here the link of your embeded video:</p>
	 
	  <?php 

	  		echo $this->Form->create('Evidence', array('url' => array('controller' => 'evidences', 'action' => 'addEvidence')));
			echo $this->Form->input('main_content', array('type' => 'text', 'label' => false, 'id' => 'embededLink'));
			//MISSION
			if (isset($mission_id)) {
				echo $this->Form->hidden('mission_id', array('value' => $mission_id));
			}
			//PHASE
			if (isset($phase_id)) {
				echo $this->Form->hidden('phase_id', array('value' => $phase_id));
			}
			//QUEST
			if (isset($quest_id)) {
				echo $this->Form->hidden('quest_id', array('value' => $quest_id));
			}
			//USER
			if (isset($loggedInUser)) {
				echo $this->Form->hidden('user_id', array('value' => $loggedInUser['id']));
			}
			echo $this->Form->end();  		
	  ?>
	  <br/>
	  <div class="text-right">
	  	<a href="#"  id="btnEmbededLink" class="button thin"><?= __("Preview") ?></a>
	  	<a href="#"  id="sendEmbededLink" class="button thin"><?php echo __("Submit") ?></a>
	  </div>
	  <div id="videoWrapper" class="text-center"></div>

	  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
	</div>

	<!-- GOGLE DRIVE -->
	<div id="googleDriveModal" class="reveal-modal medium background-color-standard" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
		<h2 id="modalTitle" class="text-glow">Create a google docs to work with your allies:</h2>
		<br/>
		<br/>
		<br/>
		<div class="text-center">
			<a class="button thin"><?= __("CREATE DOCUMENT") ?></a>
		</div>
		<a class="close-reveal-modal" aria-label="Close">&#215;</a>
	</div>

	<!-- LINK OR IMAGE -->
	<div id="imageLinkModal" class="reveal-modal medium background-color-standard" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
		<h2 id="modalTitle" class="text-glow">Create your evokation part:</h2>
		<br/>
		<br/>
		<br/>
		<!-- EVIDENCE FORM -->
		<div id="new-evidence-form" class="form-evoke-style">
			<?php
			//EDIT
			if (isset($this->request->data['Evidence'])) {
				echo $this->Form->create('Evidence', array('class' => 'formSubmitEvidence', 'url' => array('controller' => 'evidences', 'action' => 'editEvidence')));

				echo $this->Form->hidden('id');
			}
			//CREATE
			else {
				debug("CREATE");
				echo $this->Form->create('Evidence', array('class' => 'formSubmitEvidence', 'url' => array('controller' => 'evidences', 'action' => 'addEvidence')));
			}
			?>

			<div class="full-width">
				<?php
					$upload_path = "";
					
					//MISSION
					if (isset($mission_id)) {
						echo $this->Form->hidden('mission_id', array('value' => $mission_id));
						$upload_path .= "/".$mission_id;
					}
					//PHASE
					if (isset($phase_id)) {
						echo $this->Form->hidden('phase_id', array('value' => $phase_id));
						$upload_path .= "/".$phase_id;
					}
					//QUEST
					if (isset($quest_id)) {
						echo $this->Form->hidden('quest_id', array('value' => $quest_id));
						$upload_path .= "/".$quest_id;
					}
					//USER
					if (isset($loggedInUser)) {
						echo $this->Form->hidden('user_id', array('value' => $loggedInUser['id']));
						$upload_path .= "/".$loggedInUser['id'];
					}
				?>

				<!-- MAIN CONTENT -->
				<div id="evidence-main-content" class="margin top-2 bottom-2">
				</div>

				<?php echo $this->Form->hidden('main_content', array('id' => 'evidence-form-main-content')); ?>

				<?php echo $this->Form->hidden('type', array('id' => 'evidence-form-type')); ?>



				<!-- REGULAR CONTENT -->
				<?php
					//TITLE
					echo $this->Form->input('title', array('required' => true, 'label' => __('Title'), 'class' => 'radius', 'errorMessage' => __('Please enter a title'), 'error' => array(
						'attributes' => array('wrap' => 'div', 'class' => 'alert-box alert radius')
					)));

					//CONTENT
					echo $this->Form->input('content', array('label' => __('Edit your '.$element_title.':'), 'type' => 'textarea', 'class' => 'radius', 'id' => 'evidenceContentForm'));

					//EVOKATION
					if (isset($evokation_id) && $evokation_id != 'false') {
						//debug($evokation_id);
						echo $this->Form->hidden('evokation_id', array('value' => $evokation_id));
					}

					//SUBMIT BUTTON
					if (!isset($sample_form) || (!$sample_form)):
						if (!isset($button_class)) {
							$button_class = 'button thin right margin top-05 text-center text-glow-on-hover';
						}
						?>
						<button class="buttonSubmitEvidence <?= $button_class ?>" type="submit">

							<?php if (isset($button_icon) && ($button_icon)): ?>
								<i class="fa fa-floppy-o fa-2x"></i><br />
							<?php endif;?>
							
							<?= __('Submit') ?>
						</button> <?php
					//NO SUBMITTING SAMPLE FORM
					else: ?>
						<span data-tooltip aria-haspopup="true" class="has-tip" title="<?= __('In preview mode you cannot submit an actual evidence.') ?>">
							<button type="button" class="thin right margin top-05 text-center disabled">
								<?= __('Submit') ?>
							</button>
						</span><?php
					endif; ?>

				<?php 
			    echo $this->Form->end();
			    ?>
			</div>
		</div>
		<a class="close-reveal-modal" aria-label="Close">&#215;</a>
	</div>
</div>

<?php
	//HANDLEBARS TEMPLATES
	echo $this->element('Templates/FileUpload/upload-image', array(
		'alert'      => __('Format: .jpg, .png, or .gif'),
		'bucket'     => 'silabe',
		'identifier' => '1', //only used to get the element. In this case, there's just one upload element in the page
        'keyPath'    => 'Evidence'.$upload_path.'/',
		'legend'     => __('Upload image'),
        'safePath'   => 'Evidence/'
	));
	echo $this->element('Templates/FileUpload/upload-video', array(
		'alert'      => __('Formats: .mp4, .mov, or .flv'),
		'bucket'     => 'silabe',
		'identifier' => '1', //only used to get the element. In this case, there's just one upload element in the page
        'keyPath'    => 'Evidence'.$upload_path.'/',
		'legend'     => __('Upload video'),
        'safePath'   => 'Evidence/'
	));

	echo $this->element('Templates/Evidences/evidence-type-link');

	//SCRIPT
	$this->Html->script('requirejs/app/Elements/Evokations/evokation_form.js', array('inline' => false));
?>