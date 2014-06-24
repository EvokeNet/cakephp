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
            <h3 class = "margin top padding bottom-1"> <?php echo __('Edit Forum Post'); ?> </h3>
        </div>

        <div class="evoke sheer-background">
        	<?php echo $this->Form->create('ForumPost'); ?>
			<?php
				echo $this->Form->input('id');
				echo $this->Form->hidden('user_id');
				echo $this->Form->hidden('forum_id');
				echo $this->Form->hidden('forum_topic_id');
				echo $this->Form->input('content', array('label' => __('Content')));
				?>
			<?php echo $this->Form->end(__('Submit')); ?>
		</div>

      </div>
    </div>

</section>

<?php
	echo $this->Html->script('menu_height', array('inline' => false));
?>

<!-- <div class="forumPosts form">
<?php echo $this->Form->create('ForumPost'); ?>
	<fieldset>
		<legend><?php echo __('Edit Forum Post'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('forum_id');
		echo $this->Form->input('forum_topic_id');
		echo $this->Form->input('content');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ForumPost.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('ForumPost.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Forum Posts'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forums'), array('controller' => 'forums', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum'), array('controller' => 'forums', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forum Topics'), array('controller' => 'forum_topics', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum Topic'), array('controller' => 'forum_topics', 'action' => 'add')); ?> </li>
	</ul>
</div> -->
