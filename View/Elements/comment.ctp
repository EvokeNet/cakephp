<?php if(($user_id)) : ?>

	<?php echo $this->Form->create('Comment', array('controller' => 'comments', 'action' => 'add')); ?>
		<h1><?php echo __('Share a Thought'); ?></h1>
		<?php
			echo $this->Form->hidden('evidence_id', array('value' => $evidence_id));
			echo $this->Form->hidden('user_id', array('value' => $user_id));
			echo $this->Form->input('content', array('label' => false));
		?>

	<button type="submit" id = "AddComment" class= "evoke button general submit-button-margin">
		<i class="fa fa-floppy-o fa-2x">&nbsp;&nbsp;</i>
		<?= strtoupper(__('Post')) ?>
	</button>

	<?php echo $this->Form->end(); ?>
	
<?php else :?>
	<h1><?php echo __('Agent, log in to share a thought'); ?></h1>
	
	<a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'login')); ?>" class= "evoke button general submit-button-margin">
		<?= strtoupper(__('Log in')) ?>
	</a>
<?php endif; ?>

<?php 
	echo $this->Html->script('/components/jquery/jquery.min.js');
?>

<!-- <script src="/socket.io/socket.io.js"></script>
<script>
	jQuery('#AddComment').click(function(event) {
        // jQuery.getScript("/evoke/webroot/js/notifications/send.js");
        var socket = io('http://localhost');
  
		socket.emit('notification_from_server', { hey: 'it works' });

		alert('YAY');

        return false;
    });
</script> -->