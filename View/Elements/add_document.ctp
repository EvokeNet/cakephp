<h1>Add document</h1>

<?php

	echo $this->Form->create();
		echo $this->Form->input('title', array(
			'label' => '',
			'type' => 'text',
			'placeholder' => 'Insert document title here'
		));
		echo $this->Form->input('description', array(
			'label' => '',
			'type' => 'textarea',
			'placeholder' => 'Insert document description here'
		));
		echo $this->Form->input('document', array(
			'type' => 'file'
		));
		echo '<button class="button" type="submit">Submit</button>';
	echo $this->Form->end();

?>