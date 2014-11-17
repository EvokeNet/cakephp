<!-- QUEST FORM -->
<div class="form-evoke-style">
	<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'register'))); ?>

	<div class="medium-6 columns">
		<?php
			echo $this->Form->input('title', array('required' => true, 'label' => __('Title'), 'errorMessage' => __('Please enter a title'), 'error' => array(
		        'attributes' => array('wrap' => 'div', 'class' => 'alert-box alert radius')
		    )));
			echo $this->Form->input('evidence_content', array('type' => 'textarea', 'required' => true, 'label' => __('Your evidence')));
		?>
	</div>
</div>