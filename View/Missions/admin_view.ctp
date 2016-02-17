<div class="missions view">
<h2><?php echo __('Mission'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($mission['Mission']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Organization Id'); ?></dt>
		<dd>
			<?php echo h($mission['Mission']['organization_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($mission['Mission']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title Es'); ?></dt>
		<dd>
			<?php echo h($mission['Mission']['title_es']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($mission['Mission']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description Es'); ?></dt>
		<dd>
			<?php echo h($mission['Mission']['description_es']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image Dir'); ?></dt>
		<dd>
			<?php echo h($mission['Mission']['image_dir']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image Attachment'); ?></dt>
		<dd>
			<?php echo h($mission['Mission']['image_attachment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cover Dir'); ?></dt>
		<dd>
			<?php echo h($mission['Mission']['cover_dir']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cover Attachment'); ?></dt>
		<dd>
			<?php echo h($mission['Mission']['cover_attachment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Language'); ?></dt>
		<dd>
			<?php echo h($mission['Mission']['language']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Video Link'); ?></dt>
		<dd>
			<?php echo h($mission['Mission']['video_link']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Video Link Es'); ?></dt>
		<dd>
			<?php echo h($mission['Mission']['video_link_es']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Basic Training'); ?></dt>
		<dd>
			<?php echo h($mission['Mission']['basic_training']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($mission['Mission']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($mission['Mission']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Mission'), array('action' => 'edit', $mission['Mission']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Mission'), array('action' => 'delete', $mission['Mission']['id']), array(), __('Are you sure you want to delete # %s?', $mission['Mission']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Missions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mission'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Dossier Links'), array('controller' => 'dossier_links', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dossier Link'), array('controller' => 'dossier_links', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Dossier Videos'), array('controller' => 'dossier_videos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dossier Video'), array('controller' => 'dossier_videos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Evidences'), array('controller' => 'evidences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evidence'), array('controller' => 'evidences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Mission Issues'), array('controller' => 'mission_issues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mission Issue'), array('controller' => 'mission_issues', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Phases'), array('controller' => 'phases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Phase'), array('controller' => 'phases', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Quests'), array('controller' => 'quests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Quest'), array('controller' => 'quests', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attachments'), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment'), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Dossiers'), array('controller' => 'dossiers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dossier'), array('controller' => 'dossiers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Novels'), array('controller' => 'novels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Novel'), array('controller' => 'novels', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Dossier Links'); ?></h3>
	<?php if (!empty($mission['DossierLink'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Link'); ?></th>
		<th><?php echo __('Mission Id'); ?></th>
		<th><?php echo __('Language'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($mission['DossierLink'] as $dossierLink): ?>
		<tr>
			<td><?php echo $dossierLink['id']; ?></td>
			<td><?php echo $dossierLink['title']; ?></td>
			<td><?php echo $dossierLink['description']; ?></td>
			<td><?php echo $dossierLink['link']; ?></td>
			<td><?php echo $dossierLink['mission_id']; ?></td>
			<td><?php echo $dossierLink['language']; ?></td>
			<td><?php echo $dossierLink['created']; ?></td>
			<td><?php echo $dossierLink['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'dossier_links', 'action' => 'view', $dossierLink['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'dossier_links', 'action' => 'edit', $dossierLink['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'dossier_links', 'action' => 'delete', $dossierLink['id']), array(), __('Are you sure you want to delete # %s?', $dossierLink['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Dossier Link'), array('controller' => 'dossier_links', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Dossier Videos'); ?></h3>
	<?php if (!empty($mission['DossierVideo'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Video Link'); ?></th>
		<th><?php echo __('Mission Id'); ?></th>
		<th><?php echo __('Language'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($mission['DossierVideo'] as $dossierVideo): ?>
		<tr>
			<td><?php echo $dossierVideo['id']; ?></td>
			<td><?php echo $dossierVideo['title']; ?></td>
			<td><?php echo $dossierVideo['description']; ?></td>
			<td><?php echo $dossierVideo['video_link']; ?></td>
			<td><?php echo $dossierVideo['mission_id']; ?></td>
			<td><?php echo $dossierVideo['language']; ?></td>
			<td><?php echo $dossierVideo['created']; ?></td>
			<td><?php echo $dossierVideo['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'dossier_videos', 'action' => 'view', $dossierVideo['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'dossier_videos', 'action' => 'edit', $dossierVideo['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'dossier_videos', 'action' => 'delete', $dossierVideo['id']), array(), __('Are you sure you want to delete # %s?', $dossierVideo['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Dossier Video'), array('controller' => 'dossier_videos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Evidences'); ?></h3>
	<?php if (!empty($mission['Evidence'])): ?>
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
	<?php foreach ($mission['Evidence'] as $evidence): ?>
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
	<h3><?php echo __('Related Groups'); ?></h3>
	<?php if (!empty($mission['Group'])): ?>
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
	<?php foreach ($mission['Group'] as $group): ?>
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
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'mission_issues', 'action' => 'delete', $missionIssue['id']), array(), __('Are you sure you want to delete # %s?', $missionIssue['id'])); ?>
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
	<h3><?php echo __('Related Phases'); ?></h3>
	<?php if (!empty($mission['Phase'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Name Es'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Description Es'); ?></th>
		<th><?php echo __('Mission Id'); ?></th>
		<th><?php echo __('Position'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Show Dossier'); ?></th>
		<th><?php echo __('Points'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($mission['Phase'] as $phase): ?>
		<tr>
			<td><?php echo $phase['id']; ?></td>
			<td><?php echo $phase['name']; ?></td>
			<td><?php echo $phase['name_es']; ?></td>
			<td><?php echo $phase['description']; ?></td>
			<td><?php echo $phase['description_es']; ?></td>
			<td><?php echo $phase['mission_id']; ?></td>
			<td><?php echo $phase['position']; ?></td>
			<td><?php echo $phase['type']; ?></td>
			<td><?php echo $phase['show_dossier']; ?></td>
			<td><?php echo $phase['points']; ?></td>
			<td><?php echo $phase['created']; ?></td>
			<td><?php echo $phase['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'phases', 'action' => 'view', $phase['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'phases', 'action' => 'edit', $phase['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'phases', 'action' => 'delete', $phase['id']), array(), __('Are you sure you want to delete # %s?', $phase['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Phase'), array('controller' => 'phases', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Quests'); ?></h3>
	<?php if (!empty($mission['Quest'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Position'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Title Es'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Description Es'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Points'); ?></th>
		<th><?php echo __('Mandatory'); ?></th>
		<th><?php echo __('Votable'); ?></th>
		<th><?php echo __('Mission Id'); ?></th>
		<th><?php echo __('Phase Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($mission['Quest'] as $quest): ?>
		<tr>
			<td><?php echo $quest['id']; ?></td>
			<td><?php echo $quest['position']; ?></td>
			<td><?php echo $quest['title']; ?></td>
			<td><?php echo $quest['title_es']; ?></td>
			<td><?php echo $quest['description']; ?></td>
			<td><?php echo $quest['description_es']; ?></td>
			<td><?php echo $quest['type']; ?></td>
			<td><?php echo $quest['points']; ?></td>
			<td><?php echo $quest['mandatory']; ?></td>
			<td><?php echo $quest['votable']; ?></td>
			<td><?php echo $quest['mission_id']; ?></td>
			<td><?php echo $quest['phase_id']; ?></td>
			<td><?php echo $quest['created']; ?></td>
			<td><?php echo $quest['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'quests', 'action' => 'view', $quest['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'quests', 'action' => 'edit', $quest['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'quests', 'action' => 'delete', $quest['id']), array(), __('Are you sure you want to delete # %s?', $quest['id'])); ?>
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
</div>
<div class="related">
	<h3><?php echo __('Related Attachments'); ?></h3>
	<?php if (!empty($mission['Attachment'])): ?>
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
	<?php foreach ($mission['Attachment'] as $attachment): ?>
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
<div class="related">
	<h3><?php echo __('Related Dossiers'); ?></h3>
	<?php if (!empty($mission['Dossier'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Mission Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($mission['Dossier'] as $dossier): ?>
		<tr>
			<td><?php echo $dossier['id']; ?></td>
			<td><?php echo $dossier['mission_id']; ?></td>
			<td><?php echo $dossier['created']; ?></td>
			<td><?php echo $dossier['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'dossiers', 'action' => 'view', $dossier['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'dossiers', 'action' => 'edit', $dossier['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'dossiers', 'action' => 'delete', $dossier['id']), array(), __('Are you sure you want to delete # %s?', $dossier['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Dossier'), array('controller' => 'dossiers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Novels'); ?></h3>
	<?php if (!empty($mission['Novel'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Mission Id'); ?></th>
		<th><?php echo __('Page'); ?></th>
		<th><?php echo __('Page Dir'); ?></th>
		<th><?php echo __('Page Attachment'); ?></th>
		<th><?php echo __('Language'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($mission['Novel'] as $novel): ?>
		<tr>
			<td><?php echo $novel['id']; ?></td>
			<td><?php echo $novel['mission_id']; ?></td>
			<td><?php echo $novel['page']; ?></td>
			<td><?php echo $novel['page_dir']; ?></td>
			<td><?php echo $novel['page_attachment']; ?></td>
			<td><?php echo $novel['language']; ?></td>
			<td><?php echo $novel['created']; ?></td>
			<td><?php echo $novel['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'novels', 'action' => 'view', $novel['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'novels', 'action' => 'edit', $novel['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'novels', 'action' => 'delete', $novel['id']), array(), __('Are you sure you want to delete # %s?', $novel['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Novel'), array('controller' => 'novels', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
