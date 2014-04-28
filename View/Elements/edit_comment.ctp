<?php if(($user_id)) : ?>

	<?php echo $this->Form->create('Comment', array('url' => array('controller' => 'comments', 'action' => 'edit', $comment_id))); ?>
		<h1><?php echo __('Share a Thought'); ?></h1>
		<?php
			echo $this->Form->input('id', array('value' => $comment_id));
			echo $this->Form->hidden('evidence_id', array('value' => $evidence_id));
			echo $this->Form->hidden('user_id', array('value' => $user_id));
			echo $this->Form->input('content', array('value' => $content));
		?>

<!-- 	<button type="submit" class= "evoke button general submit-button-margin">
		<i class="fa fa-floppy-o fa-2x">&nbsp;&nbsp;</i>
		<?php echo $this->Form->end(__('Post')); ?>
	</button> -->

	<?php 
		echo $this->Form->submit(__('Post', true), array('class'=>'evoke button general submit-button-margin')); 
    	echo $this->Form->end();
    ?>

<?php else :?>
	<h1><?php echo __('Agent, log in to share a thought'); ?></h1>
	
	<a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'login')); ?>" class= "evoke button general submit-button-margin">
		<?= strtoupper(__('Log in')) ?>
	</a>
<?php endif; ?>