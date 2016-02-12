
<?php
	// TOPBAR MENU -->
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => __('Admin Panel'), 'imgSrc' => ($this->webroot.'img/header-leaderboard-2.jpg'), 'margin' => false, 'hidden' => true));
	$this->end();

	echo $this->Html->css(
		array(
			'evoke',
			'circle'
		)
	);

?>

<div class="row full-width" data-equalizer>
	
	<?php
		echo $this->element('panel/admin_sidebar');
		$this->end();
	?>

	<div class="large-10 columns hidden" id="panel-content" data-equalizer-watch>	
		<div class="users index">
			<h2><?php echo __('Users'); ?></h2>
			<table cellpadding="0" cellspacing="0">
			<tr>
					<th><?php echo $this->Paginator->sort('id'); ?></th>
					<th><?php echo $this->Paginator->sort('name'); ?></th>
					<th><?php echo $this->Paginator->sort('created'); ?></th>
					<th><?php echo $this->Paginator->sort('modified'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			<?php foreach ($users as $user): ?>
			<tr>
				<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array(), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
			</table>
			<!-- PAGING -->
			<div class="evoke paging">
				<?= $this->Paginator->prev('<<',array('class' => 'button thin')) ?>
				<?= $this->Paginator->numbers(array('separator' => ' ','class' => 'button thin')) ?>
				<?= $this->Paginator->next('>>',array('class' => 'button thin')) ?>
			</div>
		</div>
		<div class="actions">
			<h3><?php echo __('Actions'); ?></h3>
			<ul>
				<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
				<li><?php echo $this->Html->link(__('List Admin Notifications Users'), array('controller' => 'admin_notifications_users', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Admin Notifications User'), array('controller' => 'admin_notifications_users', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List User Badges'), array('controller' => 'user_badges', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New User Badge'), array('controller' => 'user_badges', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List User Matching Answers'), array('controller' => 'user_matching_answers', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New User Matching Answer'), array('controller' => 'user_matching_answers', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List Comments'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List Evidences'), array('controller' => 'evidences', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Evidence'), array('controller' => 'evidences', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List Evokation Followers'), array('controller' => 'evokation_followers', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Evokation Follower'), array('controller' => 'evokation_followers', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List Group Requests'), array('controller' => 'group_requests', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Group Request'), array('controller' => 'group_requests', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List Points'), array('controller' => 'points', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Point'), array('controller' => 'points', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List User Friends'), array('controller' => 'user_friends', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New User Friend'), array('controller' => 'user_friends', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List User Issues'), array('controller' => 'user_issues', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New User Issue'), array('controller' => 'user_issues', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List User Organizations'), array('controller' => 'user_organizations', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New User Organization'), array('controller' => 'user_organizations', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List User Missions'), array('controller' => 'user_missions', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New User Mission'), array('controller' => 'user_missions', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List Votes'), array('controller' => 'votes', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Vote'), array('controller' => 'votes', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List Likes'), array('controller' => 'likes', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Like'), array('controller' => 'likes', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List Attachments'), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Attachment'), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
			</ul>
		</div>
	</div>
