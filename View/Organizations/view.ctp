<div class="organizations view">
<h2><?php echo __('Organization'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Birthdate'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['birthdate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Website'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['website']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Facebook'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['facebook']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Twitter'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['twitter']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Blog'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['blog']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Organization'), array('action' => 'edit', $organization['Organization']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Organization'), array('action' => 'delete', $organization['Organization']['id']), array(), __('Are you sure you want to delete # %s?', $organization['Organization']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Badges'), array('controller' => 'badges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Badge'), array('controller' => 'badges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Missions'), array('controller' => 'missions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mission'), array('controller' => 'missions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Badges'); ?></h3>
	<?php if (!empty($organization['Badge'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Organization Id'); ?></th>
		<th><?php echo __('Mission Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Name Es'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Description Es'); ?></th>
		<th><?php echo __('Power Points Only'); ?></th>
		<th><?php echo __('Trigger'); ?></th>
		<th><?php echo __('Language'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($organization['Badge'] as $badge): ?>
		<tr>
			<td><?php echo $badge['id']; ?></td>
			<td><?php echo $badge['organization_id']; ?></td>
			<td><?php echo $badge['mission_id']; ?></td>
			<td><?php echo $badge['name']; ?></td>
			<td><?php echo $badge['name_es']; ?></td>
			<td><?php echo $badge['description']; ?></td>
			<td><?php echo $badge['description_es']; ?></td>
			<td><?php echo $badge['power_points_only']; ?></td>
			<td><?php echo $badge['trigger']; ?></td>
			<td><?php echo $badge['language']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'badges', 'action' => 'view', $badge['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'badges', 'action' => 'edit', $badge['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'badges', 'action' => 'delete', $badge['id']), array(), __('Are you sure you want to delete # %s?', $badge['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Badge'), array('controller' => 'badges', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Missions'); ?></h3>
	<?php if (!empty($organization['Mission'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Organization Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Title Es'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Description Es'); ?></th>
		<th><?php echo __('Image Dir'); ?></th>
		<th><?php echo __('Image Attachment'); ?></th>
		<th><?php echo __('Cover Dir'); ?></th>
		<th><?php echo __('Cover Attachment'); ?></th>
		<th><?php echo __('Language'); ?></th>
		<th><?php echo __('Video Link'); ?></th>
		<th><?php echo __('Video Link Es'); ?></th>
		<th><?php echo __('Basic Training'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($organization['Mission'] as $mission): ?>
		<tr>
			<td><?php echo $mission['id']; ?></td>
			<td><?php echo $mission['organization_id']; ?></td>
			<td><?php echo $mission['title']; ?></td>
			<td><?php echo $mission['title_es']; ?></td>
			<td><?php echo $mission['description']; ?></td>
			<td><?php echo $mission['description_es']; ?></td>
			<td><?php echo $mission['image_dir']; ?></td>
			<td><?php echo $mission['image_attachment']; ?></td>
			<td><?php echo $mission['cover_dir']; ?></td>
			<td><?php echo $mission['cover_attachment']; ?></td>
			<td><?php echo $mission['language']; ?></td>
			<td><?php echo $mission['video_link']; ?></td>
			<td><?php echo $mission['video_link_es']; ?></td>
			<td><?php echo $mission['basic_training']; ?></td>
			<td><?php echo $mission['created']; ?></td>
			<td><?php echo $mission['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'missions', 'action' => 'view', $mission['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'missions', 'action' => 'edit', $mission['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'missions', 'action' => 'delete', $mission['id']), array(), __('Are you sure you want to delete # %s?', $mission['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Mission'), array('controller' => 'missions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($organization['User'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Role Id'); ?></th>
		<th><?php echo __('Facebook Id'); ?></th>
		<th><?php echo __('Facebook Token'); ?></th>
		<th><?php echo __('Google Id'); ?></th>
		<th><?php echo __('Google Token'); ?></th>
		<th><?php echo __('Organization Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Firstname'); ?></th>
		<th><?php echo __('Lastname'); ?></th>
		<th><?php echo __('Birthdate'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Sex'); ?></th>
		<th><?php echo __('Biography'); ?></th>
		<th><?php echo __('Mini Biography'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Level'); ?></th>
		<th><?php echo __('Facebook'); ?></th>
		<th><?php echo __('Twitter'); ?></th>
		<th><?php echo __('Google Plus'); ?></th>
		<th><?php echo __('Instagram'); ?></th>
		<th><?php echo __('Website'); ?></th>
		<th><?php echo __('Blog'); ?></th>
		<th><?php echo __('Country'); ?></th>
		<th><?php echo __('Language'); ?></th>
		<th><?php echo __('Basic Training'); ?></th>
		<th><?php echo __('Photo Dir'); ?></th>
		<th><?php echo __('Photo Attachment'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Superhero Identity Id'); ?></th>
		<th><?php echo __('Primary Power Quantity'); ?></th>
		<th><?php echo __('Secondary Power Quantity'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($organization['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['role_id']; ?></td>
			<td><?php echo $user['facebook_id']; ?></td>
			<td><?php echo $user['facebook_token']; ?></td>
			<td><?php echo $user['google_id']; ?></td>
			<td><?php echo $user['google_token']; ?></td>
			<td><?php echo $user['organization_id']; ?></td>
			<td><?php echo $user['name']; ?></td>
			<td><?php echo $user['firstname']; ?></td>
			<td><?php echo $user['lastname']; ?></td>
			<td><?php echo $user['birthdate']; ?></td>
			<td><?php echo $user['email']; ?></td>
			<td><?php echo $user['sex']; ?></td>
			<td><?php echo $user['biography']; ?></td>
			<td><?php echo $user['mini_biography']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['level']; ?></td>
			<td><?php echo $user['facebook']; ?></td>
			<td><?php echo $user['twitter']; ?></td>
			<td><?php echo $user['google_plus']; ?></td>
			<td><?php echo $user['instagram']; ?></td>
			<td><?php echo $user['website']; ?></td>
			<td><?php echo $user['blog']; ?></td>
			<td><?php echo $user['country']; ?></td>
			<td><?php echo $user['language']; ?></td>
			<td><?php echo $user['basic_training']; ?></td>
			<td><?php echo $user['photo_dir']; ?></td>
			<td><?php echo $user['photo_attachment']; ?></td>
			<td><?php echo $user['status']; ?></td>
			<td><?php echo $user['superhero_identity_id']; ?></td>
			<td><?php echo $user['primary_power_quantity']; ?></td>
			<td><?php echo $user['secondary_power_quantity']; ?></td>
			<td><?php echo $user['created']; ?></td>
			<td><?php echo $user['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), array(), __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
