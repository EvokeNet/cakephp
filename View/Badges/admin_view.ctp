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
			'panels',
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
		<div class="badges">
		<h2><?php echo __('Badge'); ?></h2>
			<dl>
				<dt><?php echo __('Id'); ?></dt>
				<dd>
					<?php echo h($badge['Badge']['id']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Organization'); ?></dt>
				<dd>
					<?php echo $this->Html->link($badge['Organization']['name'], array('controller' => 'organizations', 'action' => 'view', $badge['Organization']['id'])); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Mission Id'); ?></dt>
				<dd>
					<?php echo h($badge['Badge']['mission_id']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Name'); ?></dt>
				<dd>
					<?php echo h($badge['Badge']['name']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Name Es'); ?></dt>
				<dd>
					<?php echo h($badge['Badge']['name_es']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Description'); ?></dt>
				<dd>
					<?php echo h($badge['Badge']['description']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Description Es'); ?></dt>
				<dd>
					<?php echo h($badge['Badge']['description_es']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Power Points Only'); ?></dt>
				<dd>
					<?php echo h($badge['Badge']['power_points_only']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Trigger'); ?></dt>
				<dd>
					<?php echo h($badge['Badge']['trigger']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Language'); ?></dt>
				<dd>
					<?php echo h($badge['Badge']['language']); ?>
					&nbsp;
				</dd>
			</dl>
		</div>
		<div class="actions">
			<h3><?php echo __('Actions'); ?></h3>
			<ul>
				<li><?php echo $this->Html->link(__('Edit Badge'), array('action' => 'edit', $badge['Badge']['id'])); ?> </li>
				<li><?php echo $this->Form->postLink(__('Delete Badge'), array('action' => 'delete', $badge['Badge']['id']), array(), __('Are you sure you want to delete # %s?', $badge['Badge']['id'])); ?> </li>
				<li><?php echo $this->Html->link(__('List Badges'), array('action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Badge'), array('action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List User Badges'), array('controller' => 'user_badges', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New User Badge'), array('controller' => 'user_badges', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List Attachments'), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Attachment'), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
			</ul>
		</div>
		<div class="related">
			<h3><?php echo __('Related User Badges'); ?></h3>
			<?php if (!empty($badge['UserBadge'])): ?>
			<table cellpadding = "0" cellspacing = "0">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('User Id'); ?></th>
				<th><?php echo __('Badge Id'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			<?php foreach ($badge['UserBadge'] as $userBadge): ?>
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
			<h3><?php echo __('Related Attachments'); ?></h3>
			<?php if (!empty($badge['Attachment'])): ?>
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
			<?php foreach ($badge['Attachment'] as $attachment): ?>
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
	</div>	
</div>