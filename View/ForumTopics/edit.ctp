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
		<a href="<?php echo $this->Html->url(array('controller' => 'ForumCategories', 'action' => 'view', 'admin' => false, $forumTopic['ForumCategory']['id'])); ?>">
			<h4 class="evoke text-glow forums link-title">
				<?= $forumTopic['ForumCategory']['title'] ?>
			</h4>
		</a>
	</div>

	<div class="forums newpost-form">
	<?php echo $this->Form->create('ForumTopic'); ?>
		<fieldset>
			<legend class="forums newpost-legend text-color-highlight uppercase"><?php echo __('New Topic'); ?></legend>
		<?=$this->Form->input('title') ?>
		<input type="hidden" name="data[ForumTopic][slug]" id="ForumTopicSlug" value=""/>
		<?=$this->Form->input('content') ?>
		
		<input type="hidden" name="data[ForumTopic][status]" id="ForumTopicStatus" value="<?= $forumTopic['ForumTopic']['status'] ?>"/>
		<input type="hidden" name="data[ForumTopic][view_count]" id="ForumTopicViewCount" value="<?= $forumTopic['ForumTopic']['view_count'] ?>"/>
		<input type="hidden" name="data[ForumTopic][user_id]" id="ForumTopicUserId" value="<?= $loggedInUser['id'] ?>"/>
		<input type="hidden" name="data[ForumTopic][forum_categorie_id]" id="ForumTopicForumCategorieId" value="<?= $forumTopic['ForumCategory']['id'] ?>"/>
		<input type="hidden" name="data[ForumTopic][id]" id="ForumTopicId" value="<?= $forumTopic['ForumTopic']['id'] ?>"/>
		</fieldset>
		<?php echo $this->Form->submit(__('Submit'),array('class' => 'button thin')); ?>
	</div>
</div>