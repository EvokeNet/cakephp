<div class="evidenceTags view">
<h2><?php echo __('Evidence Tag'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($evidenceTag['EvidenceTag']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Evidence'); ?></dt>
		<dd>
			<?php echo $this->Html->link($evidenceTag['Evidence']['title'], array('controller' => 'evidences', 'action' => 'view', $evidenceTag['Evidence']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tag'); ?></dt>
		<dd>
			<?php echo $this->Html->link($evidenceTag['Tag']['name'], array('controller' => 'tags', 'action' => 'view', $evidenceTag['Tag']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($evidenceTag['EvidenceTag']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($evidenceTag['EvidenceTag']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Evidence Tag'), array('action' => 'edit', $evidenceTag['EvidenceTag']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Evidence Tag'), array('action' => 'delete', $evidenceTag['EvidenceTag']['id']), null, __('Are you sure you want to delete # %s?', $evidenceTag['EvidenceTag']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Evidence Tags'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evidence Tag'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Evidences'), array('controller' => 'evidences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evidence'), array('controller' => 'evidences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
