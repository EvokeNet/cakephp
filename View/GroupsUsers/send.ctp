<?php echo $this->Form->create(array('controller' => 'groupsUsers', 'action' => 'send')); ?>
<fieldset>
	<?php echo $this->Form->input('to', array('label' => __('To'))); ?>
	<?php echo $this->Form->input('subject', array('label' => __('Subject'))); ?>
	<?php echo $this->Form->input('message', array('type' => 'textarea', 'label' => __('Message'))); ?>
</fieldset>
<?php echo $this->Form->end(__('Send message')); ?>