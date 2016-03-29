<?php
/* CSS */
	echo $this->Html->css('forums');

/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();
?>
<div class="evoke centering-block">

	<!-- HEAD -->
	<div class="forums index">
		<!-- TOPIC LINK -->
		<a href="<?php echo $this->Html->url(array('controller' => 'ForumTopics', 'action' => 'view', 'admin' => false, $forumTopic['ForumTopic']['id'])); ?>">
			<h4 class="evoke text-glow forums link-title">
				<?= $forumTopic['ForumTopic']['title'] ?>
			</h4>
		</a>
	</div>

	<div class="forums newpost-form">
	<?php echo $this->Form->create('ForumPost'); ?>
		<fieldset>
			<legend class="forums newpost-legend text-color-highlight uppercase"><?php echo __('New Post'); ?></legend>
		<?php
			echo $this->Form->input('title');
			echo $this->Form->input('content');
		?>
		<input type="hidden" name="data[ForumPost][slug]" id="ForumPostSlug" value=""/>
		<input type="hidden" name="data[ForumPost][user_id]" id="ForumPostUserId" value="<?= $loggedInUser['id'] ?>"/>
		<input type="hidden" name="data[ForumPost][forum_topic_id]" id="ForumPostForumTopicId" value="<?= $forumTopic['ForumTopic']['id'] ?>"/>
		</fieldset>
		<?php echo $this->Form->submit(__('Submit'),array('class' => 'button thin')); ?>
	</div>
</div>