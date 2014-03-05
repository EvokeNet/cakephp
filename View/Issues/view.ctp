<div class="issues view">
<h2><?php echo __('Issue'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($issue['Issue']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Issue'); ?></dt>
		<dd>
			<?php echo $this->Html->link($issue['ParentIssue']['name'], array('controller' => 'issues', 'action' => 'view', $issue['ParentIssue']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($issue['Issue']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Slug'); ?></dt>
		<dd>
			<?php echo h($issue['Issue']['slug']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($issue['Issue']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($issue['Issue']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Issue'), array('action' => 'edit', $issue['Issue']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Issue'), array('action' => 'delete', $issue['Issue']['id']), null, __('Are you sure you want to delete # %s?', $issue['Issue']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Issues'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Issue'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Issues'), array('controller' => 'issues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Issue'), array('controller' => 'issues', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Issues'); ?></h3>
	<?php if (!empty($issue['ChildIssue'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Slug'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($issue['ChildIssue'] as $childIssue): ?>
		<tr>
			<td><?php echo $childIssue['id']; ?></td>
			<td><?php echo $childIssue['parent_id']; ?></td>
			<td><?php echo $childIssue['name']; ?></td>
			<td><?php echo $childIssue['slug']; ?></td>
			<td><?php echo $childIssue['created']; ?></td>
			<td><?php echo $childIssue['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'issues', 'action' => 'view', $childIssue['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'issues', 'action' => 'edit', $childIssue['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'issues', 'action' => 'delete', $childIssue['id']), null, __('Are you sure you want to delete # %s?', $childIssue['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Issue'), array('controller' => 'issues', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
