<h2><?php echo __('Mission: '); echo h($mission['Mission']['title']); ?></h2>

<h2><?php echo __('Mission Brief'); ?></h2>
<p><?php echo h($mission['Mission']['description']); ?></p>

<h2><?php echo __('Quests: '); echo h($mission['Mission']['title']); ?></h2>

<?php foreach ($mission['Quest'] as $quest): ?>
	<p><?php echo $this->Html->link(($quest['title']), array('controller' => 'quests', 'action' => 'view', $quest['id'])); ?><p>
<?php endforeach; ?>

<h2><?php echo __('Discussions: '); echo h($mission['Mission']['title']); ?></h2>

<?php foreach ($mission['Evidence'] as $evidence): ?>
	<p><?php echo $this->Html->link(($evidence['title']), array('controller' => 'evidences', 'action' => 'view', $evidence['id'])); ?></p>
<?php endforeach; ?>

<!-- <dl class="tabs" data-tab>
  <dd class="active"><a href="#panel2-1">Tab 1</a></dd>
  <dd><a href="#panel2-2">Tab 2</a></dd>
  <dd><a href="#panel2-3">Tab 3</a></dd>
  <dd><a href="#panel2-4">Tab 4</a></dd>
</dl>
<div class="tabs-content">
  <div class="content active" id="panel2-1">
    <p>First panel content goes here...</p>
  </div>
  <div class="content" id="panel2-2">
    <p>Second panel content goes here...</p>
  </div>
  <div class="content" id="panel2-3">
    <p>Third panel content goes here...</p>
  </div>
  <div class="content" id="panel2-4">
    <p>Fourth panel content goes here...</p>
  </div>
</div>

<script>
  $('#myTabs').on('toggled', function (event, tab) {
    console.log(tab);
  });
</script>
 -->
<!-- <div class="related">
	<h3><?php echo __('Related Evidences'); ?></h3>
	<?php if (!empty($mission['Evidence'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Content'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Quest Id'); ?></th>
		<th><?php echo __('Mission Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($mission['Evidence'] as $evidence): ?>
		<tr>
			<td><?php echo $evidence['id']; ?></td>
			<td><?php echo $evidence['title']; ?></td>
			<td><?php echo $evidence['content']; ?></td>
			<td><?php echo $evidence['user_id']; ?></td>
			<td><?php echo $evidence['quest_id']; ?></td>
			<td><?php echo $evidence['mission_id']; ?></td>
			<td><?php echo $evidence['created']; ?></td>
			<td><?php echo $evidence['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'evidences', 'action' => 'view', $evidence['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'evidences', 'action' => 'edit', $evidence['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'evidences', 'action' => 'delete', $evidence['id']), null, __('Are you sure you want to delete # %s?', $evidence['id'])); ?>
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
	<h3><?php echo __('Related Mission Issues'); ?></h3>
	<?php if (!empty($mission['MissionIssue'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Mission Id'); ?></th>
		<th><?php echo __('Issue Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($mission['MissionIssue'] as $missionIssue): ?>
		<tr>
			<td><?php echo $missionIssue['id']; ?></td>
			<td><?php echo $missionIssue['mission_id']; ?></td>
			<td><?php echo $missionIssue['issue_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'mission_issues', 'action' => 'view', $missionIssue['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'mission_issues', 'action' => 'edit', $missionIssue['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'mission_issues', 'action' => 'delete', $missionIssue['id']), null, __('Are you sure you want to delete # %s?', $missionIssue['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Mission Issue'), array('controller' => 'mission_issues', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Quests'); ?></h3>
	<?php if (!empty($mission['Quest'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Mission Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($mission['Quest'] as $quest): ?>
		<tr>
			<td><?php echo $quest['id']; ?></td>
			<td><?php echo $quest['title']; ?></td>
			<td><?php echo $quest['description']; ?></td>
			<td><?php echo $quest['mission_id']; ?></td>
			<td><?php echo $quest['created']; ?></td>
			<td><?php echo $quest['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'quests', 'action' => 'view', $quest['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'quests', 'action' => 'edit', $quest['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'quests', 'action' => 'delete', $quest['id']), null, __('Are you sure you want to delete # %s?', $quest['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Quest'), array('controller' => 'quests', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div> -->