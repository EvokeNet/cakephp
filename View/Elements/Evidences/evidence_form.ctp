<!-- EVIDENCE FORM -->
<div class="form-evoke-style">
	<?php
	//EDIT
	if (isset($evidence)) {
		echo $this->Form->create('Evidence', array('url' => array('controller' => 'evidences', 'action' => 'edit', $evidence['id'])));
	}
	//CREATE
	else {
		echo $this->Form->create('Evidence', array('url' => array('controller' => 'evidences', 'action' => 'add', $mission_id, $phase_id, $quest_id)));

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
			<button class="<?= $button_class ?>" type="submit">

				<?php if (isset($button_icon) && ($button_icon)): ?>
					<i class="fa fa-floppy-o fa-2x"></i><br />
				<?php endif;?>
				
				<?= __('Create evidence') ?>
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