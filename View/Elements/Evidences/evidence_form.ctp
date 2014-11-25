<!-- EVIDENCE FORM -->
<div class="form-evoke-style">
	<?php
	//EDIT
	if (isset($evidence)) {
		echo $this->Form->create('Evidence', array('url' => array('controller' => 'evidences', 'action' => 'edit', $evidence['id'])));
	}
	//CREATE
	else {
		echo $this->Form->create('Evidence', array('url' => array('controller' => 'evidences', 'action' => 'add')));

		$evidence['title'] = "";
		$evidence['content'] = "";
	}
	?>
	

	<div class="full-width">
		<?php
			echo $this->Form->input('title', array('required' => true, 'label' => __('Title'), 'value' => $evidence['title'], 'class' => 'radius', 'errorMessage' => __('Please enter a title'), 'error' => array(
				'attributes' => array('wrap' => 'div', 'class' => 'alert-box alert radius')
			)));
		?>

		<?php
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
				
				<?= __('Post') ?>
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