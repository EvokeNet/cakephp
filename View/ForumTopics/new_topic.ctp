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
		<a href="/evoke/forum_categories/view/<?= $forumCategory['ForumCategory']['id'] ?>"><h4 class="evoke text-glow forums link-title"><?= $forumCategory['ForumCategory']['title'] ?></h4></a>
	</div>

	<div class="forums newpost-form">
	<?php echo $this->Form->create('ForumTopic'); ?>
		<fieldset>
			<legend class="forums newpost-legend text-color-highlight uppercase"><?php echo __('New Topic'); ?></legend>
		<?=$this->Form->input('title') ?>
		<input type="hidden" name="data[ForumTopic][slug]" id="ForumTopicSlug" value=""/>
		<?=$this->Form->input('content') ?>
		
		<input type="hidden" name="data[ForumTopic][status]" id="ForumTopicStatus" value=""/>
		<input type="hidden" name="data[ForumTopic][view_count]" id="ForumTopicViewCount" value="0"/>
		<input type="hidden" name="data[ForumTopic][user_id]" id="ForumTopicUserId" value="<?= $loggedInUser['id'] ?>"/>
		<input type="hidden" name="data[ForumTopic][forum_categorie_id]" id="ForumTopicForumCategorieId" value="<?= $forumCategory['ForumCategory']['id'] ?>"/>
		</fieldset>
		<?php echo $this->Form->submit(__('Submit'),array('class' => 'button thin')); ?>
	</div>
</div>