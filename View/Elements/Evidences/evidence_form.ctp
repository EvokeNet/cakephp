<!-- EVIDENCE TYPE -->
<div class="">
	<div class="text-center">
		<span class="fa-stack fa-4x grow-on-hover">
			<i class="fa fa-circle fa-stack-2x text-color-highlight"></i>
			<i class="fa fa-pencil fa-stack-1x fa-inverse text-glow"></i>
		</span>
		<span class="fa-stack fa-4x grow-on-hover">
			<i class="fa fa-circle fa-stack-2x text-color-highlight"></i>
			<i class="fa fa-image fa-stack-1x fa-inverse text-glow"></i>
		</span>
		<span class="fa-stack fa-4x grow-on-hover">
			<i class="fa fa-circle fa-stack-2x text-color-highlight"></i>
			<i class="fa fa-video-camera fa-stack-1x fa-inverse text-glow"></i>
		</span>
		<span class="fa-stack fa-4x grow-on-hover">
			<i class="fa fa-circle fa-stack-2x text-color-highlight"></i>
			<i class="fa fa-link fa-stack-1x fa-inverse text-glow"></i>
		</span>
	</div>
</div>


<!-- EVIDENCE FORM -->
<div class="form-evoke-style">
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

			//TITLE
			echo $this->Form->input('title', array('required' => true, 'label' => __('Title'), 'value' => $evidence['title'], 'class' => 'radius', 'errorMessage' => __('Please enter a title'), 'error' => array(
				'attributes' => array('wrap' => 'div', 'class' => 'alert-box alert radius')
			)));

			//CONTENT
			if (!isset($content_class)) {
				$content_class = 'radius';
			}
			echo $this->Form->input('content', array('label' => __('Edit your evidence:'), 'type' => 'textarea', 'class' => $content_class, 'value' => $evidence['content'], 'id' => 'evidenceContentForm'));
		?>

		<?php
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
	//SCRIPT
	$this->Html->script('requirejs/app/Elements/Evidences/evidence_form.js', array('inline' => false));
?>