<?php 
if(($user_id)): ?>

	<?php
	//EDIT
	if (isset($comment_id)) {
		echo $this->Form->create('Comment', array('class' => 'formPostComment', 'url' => array('controller' => 'comments', 'action' => 'edit', $comment_id)));
	}
	//CREATE
	else {
		echo $this->Form->create('Comment', array('class' => 'formPostComment', 'url' => array('controller' => 'comments', 'action' => 'add')));
	}
	?>
		<?php
			if (isset($comment_id)) {
				echo $this->Form->hidden('id', array('value' => $comment_id));
			}
			if (isset($evidence_id)) {
				echo $this->Form->hidden('evidence_id', array('value' => $evidence_id));
			}
			if (isset($user_id)) {
				echo $this->Form->hidden('user_id', array('value' => $user_id));
			}
			if (isset($content)) {
				if (!isset($content_class)) {
					$content_class = 'radius';
				}
				echo $this->Form->input('content', array('label' => 'Comment:', 'type' => 'textarea', 'class' => $content_class, 'value' => $content, 'id' => 'newCommentForm'));
			}
		?>

		<?php
		if (!isset($button_class)) {
			$button_class = 'button thin full-width margin top-05 text-center text-glow-on-hover';
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


<?php else:?>
	<div data-alert="" class="alert-box radius">
		<?php echo __('Agent, sign in to share a thought'); ?>
	</div>
	
	<a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'login')); ?>" class= "button thin">
		<?= strtoupper(__('Sign in')) ?>
	</a>
<?php endif; ?>