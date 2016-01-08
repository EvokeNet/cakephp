<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['role_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo h($user['User']['role']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Firstname'); ?></dt>
		<dd>
			<?php echo h($user['User']['firstname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lastname'); ?></dt>
		<dd>
			<?php echo h($user['User']['lastname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Organization Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['organization_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Facebook Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['facebook_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Facebook Token'); ?></dt>
		<dd>
			<?php echo h($user['User']['facebook_token']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Google Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['google_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Google Token'); ?></dt>
		<dd>
			<?php echo h($user['User']['google_token']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Birthdate'); ?></dt>
		<dd>
			<?php echo h($user['User']['birthdate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sex'); ?></dt>
		<dd>
			<?php echo h($user['User']['sex']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Biography'); ?></dt>
		<dd>
			<?php echo h($user['User']['biography']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mini Biography'); ?></dt>
		<dd>
			<?php echo h($user['User']['mini_biography']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Level'); ?></dt>
		<dd>
			<?php echo h($user['User']['level']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Facebook'); ?></dt>
		<dd>
			<?php echo h($user['User']['facebook']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Twitter'); ?></dt>
		<dd>
			<?php echo h($user['User']['twitter']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Google Plus'); ?></dt>
		<dd>
			<?php echo h($user['User']['google_plus']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Instagram'); ?></dt>
		<dd>
			<?php echo h($user['User']['instagram']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Website'); ?></dt>
		<dd>
			<?php echo h($user['User']['website']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Blog'); ?></dt>
		<dd>
			<?php echo h($user['User']['blog']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo h($user['User']['country']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Language'); ?></dt>
		<dd>
			<?php echo h($user['User']['language']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Basic Training'); ?></dt>
		<dd>
			<?php echo h($user['User']['basic_training']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Photo Dir'); ?></dt>
		<dd>
			<?php echo h($user['User']['photo_dir']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Photo Attachment'); ?></dt>
		<dd>
			<?php echo h($user['User']['photo_attachment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($user['User']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Superhero Identity Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['superhero_identity_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), array(), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Admin Notifications Users'); ?></h3>
	<?php if (!empty($user['AdminNotificationsUser'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Admin Notification Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['AdminNotificationsUser'] as $adminNotificationsUser): ?>
		<tr>
			<td><?php echo $adminNotificationsUser['id']; ?></td>
			<td><?php echo $adminNotificationsUser['admin_notification_id']; ?></td>
			<td><?php echo $adminNotificationsUser['user_id']; ?></td>
			<td><?php echo $adminNotificationsUser['created']; ?></td>
			<td><?php echo $adminNotificationsUser['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'admin_notifications_users', 'action' => 'view', $adminNotificationsUser['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'admin_notifications_users', 'action' => 'edit', $adminNotificationsUser['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'admin_notifications_users', 'action' => 'delete', $adminNotificationsUser['id']), array(), __('Are you sure you want to delete # %s?', $adminNotificationsUser['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Admin Notifications User'), array('controller' => 'admin_notifications_users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Badges'); ?></h3>
	<?php if (!empty($user['UserBadge'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Badge Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['UserBadge'] as $userBadge): ?>
		<tr>
			<td><?php echo $userBadge['id']; ?></td>
			<td><?php echo $userBadge['user_id']; ?></td>
			<td><?php echo $userBadge['badge_id']; ?></td>
			<td><?php echo $userBadge['created']; ?></td>
			<td><?php echo $userBadge['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_badges', 'action' => 'view', $userBadge['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_badges', 'action' => 'edit', $userBadge['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_badges', 'action' => 'delete', $userBadge['id']), array(), __('Are you sure you want to delete # %s?', $userBadge['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Badge'), array('controller' => 'user_badges', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Matching Answers'); ?></h3>
	<?php if (!empty($user['UserMatchingAnswer'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Matching Question Id'); ?></th>
		<th><?php echo __('Matching Answer Id'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Order'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['UserMatchingAnswer'] as $userMatchingAnswer): ?>
		<tr>
			<td><?php echo $userMatchingAnswer['id']; ?></td>
			<td><?php echo $userMatchingAnswer['user_id']; ?></td>
			<td><?php echo $userMatchingAnswer['matching_question_id']; ?></td>
			<td><?php echo $userMatchingAnswer['matching_answer_id']; ?></td>
			<td><?php echo $userMatchingAnswer['description']; ?></td>
			<td><?php echo $userMatchingAnswer['order']; ?></td>
			<td><?php echo $userMatchingAnswer['created']; ?></td>
			<td><?php echo $userMatchingAnswer['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_matching_answers', 'action' => 'view', $userMatchingAnswer['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_matching_answers', 'action' => 'edit', $userMatchingAnswer['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_matching_answers', 'action' => 'delete', $userMatchingAnswer['id']), array(), __('Are you sure you want to delete # %s?', $userMatchingAnswer['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Matching Answer'), array('controller' => 'user_matching_answers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Comments'); ?></h3>
	<?php if (!empty($user['Comment'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Evidence Id'); ?></th>
		<th><?php echo __('Evokation Id'); ?></th>
		<th><?php echo __('Evokation Update Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Content'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Comment'] as $comment): ?>
		<tr>
			<td><?php echo $comment['id']; ?></td>
			<td><?php echo $comment['evidence_id']; ?></td>
			<td><?php echo $comment['evokation_id']; ?></td>
			<td><?php echo $comment['evokation_update_id']; ?></td>
			<td><?php echo $comment['user_id']; ?></td>
			<td><?php echo $comment['content']; ?></td>
			<td><?php echo $comment['created']; ?></td>
			<td><?php echo $comment['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'comments', 'action' => 'view', $comment['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'comments', 'action' => 'edit', $comment['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'comments', 'action' => 'delete', $comment['id']), array(), __('Are you sure you want to delete # %s?', $comment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Evidences'); ?></h3>
	<?php if (!empty($user['Evidence'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Main Content'); ?></th>
		<th><?php echo __('Content'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Quest Id'); ?></th>
		<th><?php echo __('Mission Id'); ?></th>
		<th><?php echo __('Phase Id'); ?></th>
		<th><?php echo __('Evokation Id'); ?></th>
		<th><?php echo __('Editing User Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Evidence'] as $evidence): ?>
		<tr>
			<td><?php echo $evidence['id']; ?></td>
			<td><?php echo $evidence['title']; ?></td>
			<td><?php echo $evidence['type']; ?></td>
			<td><?php echo $evidence['main_content']; ?></td>
			<td><?php echo $evidence['content']; ?></td>
			<td><?php echo $evidence['user_id']; ?></td>
			<td><?php echo $evidence['quest_id']; ?></td>
			<td><?php echo $evidence['mission_id']; ?></td>
			<td><?php echo $evidence['phase_id']; ?></td>
			<td><?php echo $evidence['evokation_id']; ?></td>
			<td><?php echo $evidence['editing_user_id']; ?></td>
			<td><?php echo $evidence['created']; ?></td>
			<td><?php echo $evidence['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'evidences', 'action' => 'view', $evidence['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'evidences', 'action' => 'edit', $evidence['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'evidences', 'action' => 'delete', $evidence['id']), array(), __('Are you sure you want to delete # %s?', $evidence['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Evidence'), array('controller' => 'evidences', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Evokation Followers'); ?></h3>
	<?php if (!empty($user['EvokationFollower'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Evokation Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['EvokationFollower'] as $evokationFollower): ?>
		<tr>
			<td><?php echo $evokationFollower['id']; ?></td>
			<td><?php echo $evokationFollower['user_id']; ?></td>
			<td><?php echo $evokationFollower['evokation_id']; ?></td>
			<td><?php echo $evokationFollower['created']; ?></td>
			<td><?php echo $evokationFollower['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'evokation_followers', 'action' => 'view', $evokationFollower['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'evokation_followers', 'action' => 'edit', $evokationFollower['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'evokation_followers', 'action' => 'delete', $evokationFollower['id']), array(), __('Are you sure you want to delete # %s?', $evokationFollower['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Evokation Follower'), array('controller' => 'evokation_followers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Group Requests'); ?></h3>
	<?php if (!empty($user['GroupRequest'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Group Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['GroupRequest'] as $groupRequest): ?>
		<tr>
			<td><?php echo $groupRequest['id']; ?></td>
			<td><?php echo $groupRequest['user_id']; ?></td>
			<td><?php echo $groupRequest['group_id']; ?></td>
			<td><?php echo $groupRequest['status']; ?></td>
			<td><?php echo $groupRequest['created']; ?></td>
			<td><?php echo $groupRequest['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'group_requests', 'action' => 'view', $groupRequest['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'group_requests', 'action' => 'edit', $groupRequest['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'group_requests', 'action' => 'delete', $groupRequest['id']), array(), __('Are you sure you want to delete # %s?', $groupRequest['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Group Request'), array('controller' => 'group_requests', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Groups'); ?></h3>
	<?php if (!empty($user['Group'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Mission Id'); ?></th>
		<th><?php echo __('Phase Id'); ?></th>
		<th><?php echo __('Quest Id'); ?></th>
		<th><?php echo __('Max Local'); ?></th>
		<th><?php echo __('Max Global'); ?></th>
		<th><?php echo __('Photo Dir'); ?></th>
		<th><?php echo __('Photo Attachment'); ?></th>
		<th><?php echo __('Facebook'); ?></th>
		<th><?php echo __('Twitter'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Group'] as $group): ?>
		<tr>
			<td><?php echo $group['id']; ?></td>
			<td><?php echo $group['title']; ?></td>
			<td><?php echo $group['description']; ?></td>
			<td><?php echo $group['user_id']; ?></td>
			<td><?php echo $group['mission_id']; ?></td>
			<td><?php echo $group['phase_id']; ?></td>
			<td><?php echo $group['quest_id']; ?></td>
			<td><?php echo $group['max_local']; ?></td>
			<td><?php echo $group['max_global']; ?></td>
			<td><?php echo $group['photo_dir']; ?></td>
			<td><?php echo $group['photo_attachment']; ?></td>
			<td><?php echo $group['facebook']; ?></td>
			<td><?php echo $group['twitter']; ?></td>
			<td><?php echo $group['created']; ?></td>
			<td><?php echo $group['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'groups', 'action' => 'view', $group['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'groups', 'action' => 'edit', $group['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'groups', 'action' => 'delete', $group['id']), array(), __('Are you sure you want to delete # %s?', $group['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Points'); ?></h3>
	<?php if (!empty($user['Point'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Value'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Origin'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Origin Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Point'] as $point): ?>
		<tr>
			<td><?php echo $point['id']; ?></td>
			<td><?php echo $point['value']; ?></td>
			<td><?php echo $point['user_id']; ?></td>
			<td><?php echo $point['origin']; ?></td>
			<td><?php echo $point['created']; ?></td>
			<td><?php echo $point['modified']; ?></td>
			<td><?php echo $point['origin_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'points', 'action' => 'view', $point['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'points', 'action' => 'edit', $point['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'points', 'action' => 'delete', $point['id']), array(), __('Are you sure you want to delete # %s?', $point['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Point'), array('controller' => 'points', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Friends'); ?></h3>
	<?php if (!empty($user['UserFriend'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Friend Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['UserFriend'] as $userFriend): ?>
		<tr>
			<td><?php echo $userFriend['id']; ?></td>
			<td><?php echo $userFriend['user_id']; ?></td>
			<td><?php echo $userFriend['friend_id']; ?></td>
			<td><?php echo $userFriend['created']; ?></td>
			<td><?php echo $userFriend['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_friends', 'action' => 'view', $userFriend['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_friends', 'action' => 'edit', $userFriend['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_friends', 'action' => 'delete', $userFriend['id']), array(), __('Are you sure you want to delete # %s?', $userFriend['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Friend'), array('controller' => 'user_friends', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Issues'); ?></h3>
	<?php if (!empty($user['UserIssue'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Issue Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['UserIssue'] as $userIssue): ?>
		<tr>
			<td><?php echo $userIssue['id']; ?></td>
			<td><?php echo $userIssue['user_id']; ?></td>
			<td><?php echo $userIssue['issue_id']; ?></td>
			<td><?php echo $userIssue['created']; ?></td>
			<td><?php echo $userIssue['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_issues', 'action' => 'view', $userIssue['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_issues', 'action' => 'edit', $userIssue['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_issues', 'action' => 'delete', $userIssue['id']), array(), __('Are you sure you want to delete # %s?', $userIssue['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Issue'), array('controller' => 'user_issues', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Organizations'); ?></h3>
	<?php if (!empty($user['UserOrganization'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Organization Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['UserOrganization'] as $userOrganization): ?>
		<tr>
			<td><?php echo $userOrganization['id']; ?></td>
			<td><?php echo $userOrganization['user_id']; ?></td>
			<td><?php echo $userOrganization['organization_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_organizations', 'action' => 'view', $userOrganization['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_organizations', 'action' => 'edit', $userOrganization['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_organizations', 'action' => 'delete', $userOrganization['id']), array(), __('Are you sure you want to delete # %s?', $userOrganization['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Organization'), array('controller' => 'user_organizations', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Missions'); ?></h3>
	<?php if (!empty($user['UserMission'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Mission Id'); ?></th>
		<th><?php echo __('Completed'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['UserMission'] as $userMission): ?>
		<tr>
			<td><?php echo $userMission['id']; ?></td>
			<td><?php echo $userMission['user_id']; ?></td>
			<td><?php echo $userMission['mission_id']; ?></td>
			<td><?php echo $userMission['completed']; ?></td>
			<td><?php echo $userMission['created']; ?></td>
			<td><?php echo $userMission['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_missions', 'action' => 'view', $userMission['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_missions', 'action' => 'edit', $userMission['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_missions', 'action' => 'delete', $userMission['id']), array(), __('Are you sure you want to delete # %s?', $userMission['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Mission'), array('controller' => 'user_missions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Votes'); ?></h3>
	<?php if (!empty($user['Vote'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Evokation Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Evokation Update Id'); ?></th>
		<th><?php echo __('Value'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Vote'] as $vote): ?>
		<tr>
			<td><?php echo $vote['id']; ?></td>
			<td><?php echo $vote['evokation_id']; ?></td>
			<td><?php echo $vote['user_id']; ?></td>
			<td><?php echo $vote['evokation_update_id']; ?></td>
			<td><?php echo $vote['value']; ?></td>
			<td><?php echo $vote['created']; ?></td>
			<td><?php echo $vote['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'votes', 'action' => 'view', $vote['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'votes', 'action' => 'edit', $vote['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'votes', 'action' => 'delete', $vote['id']), array(), __('Are you sure you want to delete # %s?', $vote['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Vote'), array('controller' => 'votes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Likes'); ?></h3>
	<?php if (!empty($user['Like'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Evidence Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Like'] as $like): ?>
		<tr>
			<td><?php echo $like['id']; ?></td>
			<td><?php echo $like['evidence_id']; ?></td>
			<td><?php echo $like['user_id']; ?></td>
			<td><?php echo $like['created']; ?></td>
			<td><?php echo $like['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'likes', 'action' => 'view', $like['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'likes', 'action' => 'edit', $like['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'likes', 'action' => 'delete', $like['id']), array(), __('Are you sure you want to delete # %s?', $like['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Like'), array('controller' => 'likes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Attachments'); ?></h3>
	<?php if (!empty($user['Attachment'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Model'); ?></th>
		<th><?php echo __('Foreign Key'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Attachment'); ?></th>
		<th><?php echo __('Dir'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Size'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Language'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Attachment'] as $attachment): ?>
		<tr>
			<td><?php echo $attachment['id']; ?></td>
			<td><?php echo $attachment['model']; ?></td>
			<td><?php echo $attachment['foreign_key']; ?></td>
			<td><?php echo $attachment['name']; ?></td>
			<td><?php echo $attachment['attachment']; ?></td>
			<td><?php echo $attachment['dir']; ?></td>
			<td><?php echo $attachment['type']; ?></td>
			<td><?php echo $attachment['size']; ?></td>
			<td><?php echo $attachment['active']; ?></td>
			<td><?php echo $attachment['language']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'attachments', 'action' => 'view', $attachment['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'attachments', 'action' => 'edit', $attachment['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'attachments', 'action' => 'delete', $attachment['id']), array(), __('Are you sure you want to delete # %s?', $attachment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Attachment'), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
