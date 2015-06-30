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
			<?= __('Your can choose the focus of your '.$element_title.':') ?>
		</div>

		<!-- BUTTONS TO CHOOSE EVIDENCE TYPE -->
		<div class="row text-center">
			<div class="centered-block text-glow-on-hover margin right-2">
				<a class="evidence-type" data-evidence-type="image">
					<i class="fa fa-image fa-3x img-circular text-color-highlight border-width-01 border-style-solid border-color-highlight padding all-05"></i>
					<h4 class="text-color-highlight"><?= __('Image') ?></h4>
				</a>
			</div>
			<div class="centered-block text-glow-on-hover margin left-1 right-2">
				<a class="evidence-type" data-evidence-type="video">
					<i class="fa fa-video-camera fa-3x img-circular text-color-highlight border-width-01 border-style-solid border-color-highlight padding all-05"></i>
					<h4 class="text-color-highlight"><?= __('Video') ?></h4>
				</a>
			</div>
			<div class="centered-block text-glow-on-hover margin left-1 right-2">
				<a class="evidence-type" data-evidence-type="link">
					<i class="fa fa-link fa-3x img-circular text-color-highlight border-width-01 border-style-solid border-color-highlight padding all-05"></i>
					<h4 class="text-color-highlight"><?= __('Link') ?></h4>
				</a>
			</div>
			<div class="centered-block text-glow-on-hover margin left-1">
				<a class="evidence-type" data-evidence-type="text">
					<i class="fa fa-font fa-3x img-circular text-color-highlight border-width-01 border-style-solid border-color-highlight padding all-05"></i>
					<h4 class="text-color-highlight"><?= __('Text') ?></h4>
				</a>
			</div>
		</div>
	</div>


	<!-- EVIDENCE FORM -->
	<div id="new-evidence-form" class="form-evoke-style hidden">
		<?php
		//EDIT
		if (isset($evidence)) {
			echo $this->Form->create('Evidence', array('class' => 'formSubmitEvidence', 'url' => array('controller' => 'evidences', 'action' => 'editEvidence')));


			echo $this->Form->hidden('id', array('value' => $evidence['id']));
		}
		//CREATE
		else {
			echo $this->Form->create('Evidence', array('class' => 'formSubmitEvidence', 'url' => array('controller' => 'evidences', 'action' => 'addEvidence')));

			$evidence['type'] = "";
			$evidence['main_content'] = "";
			$evidence['title'] = "";
			$evidence['content'] = "";
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

			<?php echo $this->Form->hidden('main_content', array('value' => $evidence['main_content'], 'id' => 'evidence-form-main-content')); ?>

			<?php echo $this->Form->hidden('type', array('value' => $evidence['type'], 'id' => 'evidence-form-type')); ?>


			<!-- REGULAR CONTENT -->
			<?php
				//TITLE
				echo $this->Form->input('title', array('required' => true, 'label' => __('Title'), 'value' => $evidence['title'], 'class' => 'radius', 'errorMessage' => __('Please enter a title'), 'error' => array(
					'attributes' => array('wrap' => 'div', 'class' => 'alert-box alert radius')
				)));

				//CONTENT
				echo $this->Form->input('content', array('label' => __('Edit your '.$element_title.':'), 'type' => 'textarea', 'class' => 'radius', 'value' => $evidence['content'], 'id' => 'evidenceContentForm'));

				//EVOKATION
				if (isset($evokation_id)) {
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

	echo $this->element('Templates/Evidences/evidence-type-link', array('evidence' => $evidence));

	//SCRIPT
	$this->Html->script('requirejs/app/Elements/Evidences/evidence_form.js', array('inline' => false));
?>