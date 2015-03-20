<div id="new-evidence-type">
	<!-- EXPLANATION -->
	<div class="row text-center margin top-3 bottom-2">
		<?= __('Your can choose the focus of your evidence:') ?>
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
		echo $this->Form->create('Evidence', array('class' => 'formSubmitEvidence', 'url' => array('controller' => 'evidences', 'action' => 'edit', $evidence['id'])));
	}
	//CREATE
	else {
		echo $this->Form->create('Evidence', array('class' => 'formSubmitEvidence', 'url' => array('controller' => 'evidences', 'action' => 'addEvidence')));

		$evidence['title'] = "";
		$evidence['content'] = "";
	}
	?>

	<div class="full-width">
		<?php
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

			//Text-area formatting
			if (!isset($content_class)) {
				$content_class = 'radius';
			}
		?>

		<!-- MAIN CONTENT -->
		<div id="evidence-main-content" class="margin top-2 bottom-2">
		</div>

		<?php //echo $this->element('Templates/FileUploader/uploader'); ?>


		<!-- REGULAR CONTENT -->
		<?php
			//TITLE
			echo $this->Form->input('title', array('required' => true, 'label' => __('Title'), 'value' => $evidence['title'], 'class' => 'radius', 'errorMessage' => __('Please enter a title'), 'error' => array(
				'attributes' => array('wrap' => 'div', 'class' => 'alert-box alert radius')
			)));

			//CONTENT
			echo $this->Form->input('content', array('label' => __('Edit your evidence:'), 'type' => 'textarea', 'class' => $content_class, 'value' => $evidence['content'], 'id' => 'evidenceContentForm'));

			//SUBMIT BUTTON
			if (!isset($button_class)) {
				$button_class = 'button thin right margin top-05 text-center text-glow-on-hover';
			}
			?>
			<button class="buttonSubmitEvidence <?= $button_class ?>" type="submit">

				<?php if (isset($button_icon) && ($button_icon)): ?>
					<i class="fa fa-floppy-o fa-2x"></i><br />
				<?php endif;?>
				
				<?= __('Submit') ?>
			</button>

		<?php 
	    echo $this->Form->end();
	    ?>
	</div>
</div>

<?php
	//HANDLEBARS TEMPLATES
	echo $this->element('Templates/FileUpload/upload-image');
	echo $this->element('Templates/FileUpload/upload-video');
	echo $this->element('Templates/Evidences/evidence-type-link');

	//SCRIPT
	$this->Html->script('requirejs/app/Elements/Evidences/evidence_form.js', array('inline' => false));
	$this->Html->script('requirejs/app/file-upload.js', array('inline' => false));
?>