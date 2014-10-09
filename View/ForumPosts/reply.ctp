<?php

	$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $user));

	$this->end(); 
?>

<section class="evoke default-background">

	<div class="evoke default row full-width-alternate profile">

	  <div class="small-2 medium-2 large-2 columns padding-left">
	  	<?php echo $this->element('menu', array('user' => $user));?>
	  </div>

	  <div class="small-10 medium-10 large-10 columns maincolumn">
	  	<?php echo $this->Session->flash(); ?>

	  	<div class = "default">
            <h3 class = "margin top padding bottom-1"> <?php echo __('Add Post'); ?> </h3>
        </div>

        <div class="evoke sheer-background">
        	<?php echo $this->Form->create('ForumPost'); ?>
			<?php
				echo $this->Form->hidden('user_id', array('value' => $user['User']['id']));
				echo $this->Form->hidden('forum_id', array('value' => $forumTopic['Forum']['id']));
				echo $this->Form->hidden('forum_topic_id', array('value' => $forumTopic['ForumTopic']['id']));
				echo $this->Form->input('content');
			?>
			<?php echo $this->Form->end(__('Submit')); ?>
		</div>

      </div>
    </div>

</section>

<?php
	echo $this->Html->script('menu_height', array('inline' => false));
?>