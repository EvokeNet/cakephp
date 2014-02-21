<?php echo $this->Form->create(array('controller' => 'groupsUsers', 'action' => 'send')); ?>
<fieldset>
	<?php echo $this->Form->input('to', array('label' => 'Para')); ?>
	<?php echo $this->Form->input('subject', array('label' => 'Assunto')); ?>
	<?php echo $this->Form->input('message', array('type' => 'textarea', 'label' => 'Mensagem')); ?>
</fieldset>
<?php echo $this->Form->end('Enviar Mensagem'); ?>