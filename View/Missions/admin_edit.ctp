<div class="missions form">
<?php echo $this->Form->create('Mission'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Mission'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('organization_id');
		echo $this->Form->input('title');
		echo $this->Form->input('title_es');
		echo $this->Form->input('description');
		echo $this->Form->input('description_es');
		echo $this->Form->input('image_dir');
		echo $this->Form->input('image_attachment');
		echo $this->Form->input('cover_dir');
		echo $this->Form->input('cover_attachment');
		echo $this->Form->input('language');
		echo $this->Form->input('video_link');
		echo $this->Form->input('video_link_es');
		echo $this->Form->input('basic_training');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Mission.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Mission.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Missions'), array('action' => 'index')); ?></li>
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
