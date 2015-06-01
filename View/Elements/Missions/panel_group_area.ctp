
<div class="row full-width">
	<!-- GROUP BOX -->
	<div class="margin top-2 bottom-3">
		<h2 class="text-color-highlight text-center">
			<?= $group['title'] ?>
		</h2>

		<?php
		//GROUP FORUM BUTTON
		$forum_group_id = '';

		if (isset($forum_group) && isset($forum_group['Forum'])) {
			$forum_group_id = $forum_group['Forum']['id'];
		} ?>

		<div class="text-center">
			<a class="button"
				id="tabForumGroup"
				data-forum-url="<?php echo rawurldecode($this->Html->url(array('plugin' => 'optimum', 'controller' => 'forum', 'action' => 'view', "#/".$forum_group_id))); ?>"
				data-tab-content="tabForum"
				data-forum-id="<?= $forum_group_id ?>">
				
				<?= __('Access group discussions') ?>

			</a>
		</div>

		<!-- GROUP BOX -->
		<?php echo $this->element('Groups/group_box',array('group' => $group, 'show_title' => false)); ?>
	</div>

	<!-- GROUP INFO -->
	<div class="text-center">
		<h5 class="text-color-highlight"><?= __('Team leader');?></h5>
		<p><?= $group['User']['name'] ?></p>
	</div>

	<!-- LIST OF MEMBERS -->	
	<div class="margin top-2">
		<h4 class="text-color-highlight text-center"><?= __('Members') ?><?= ': '.count($group['GroupsUser']) ?></h4>

		<?php echo $this->element('Groups/member_list',array(
			'group' => $group,
			'groupOwner' => $group['User'],
			'groupsUsers' => $group['GroupsUser'],
			'show_title' => false)); ?>

		<?php
		//OWNER CAN SEE REQUESTS
		if ($group['is_owner']): ?>
			<div class="margin top-2">
				<h4 class="text-color-highlight text-center"><?= __('Requests') ?></h4>

				<?php echo $this->element('Groups/request_tabs',array(
					'group' => $group,
					'groupsRequestsPending' => $group['requests_pending'],
					'groupsRequests' => $group['requests'],
					'show_title' => false)); ?>
			</div> <?php
		endif; ?>
	</div>
</div>