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
		<a href="<?php echo $this->Html->url(array('controller' => 'ForumTopics', 'action' => 'view', 'admin' => false, $forumPost['ForumTopic']['id'])); ?>">
			<h4 class="evoke text-glow forums link-title">
				<?= $forumPost['ForumTopic']['title'] ?>
			</h4>
		</a>
	</div>

	<div class="forums newpost-form">
	<?php echo $this->Form->create('ForumPost'); ?>
		<fieldset>
			<legend class="forums newpost-legend text-color-highlight uppercase"><?php echo __('Edit Post'); ?></legend>
		<?php
			echo $this->Form->input('title');
			echo $this->Form->input('content');
		?>
		<input type="hidden" name="data[ForumPost][slug]" id="ForumPostSlug" value="<?= $forumPost['ForumPost']['slug'] ?>"/>
		<input type="hidden" name="data[ForumPost][id]" id="ForumPostUserId" value="<?= $forumPost['ForumPost']['id'] ?>"/>
		<input type="hidden" name="data[ForumPost][user_id]" id="ForumPostUserId" value="<?= $forumPost['User']['id'] ?>"/>
		<input type="hidden" name="data[ForumPost][forum_topic_id]" id="ForumPostForumTopicId" value="<?= $forumPost['ForumTopic']['id'] ?>"/>
		</fieldset>
		<?php echo $this->Form->submit(__('Submit'),array('class' => 'button thin')); ?>
	</div>
</div>