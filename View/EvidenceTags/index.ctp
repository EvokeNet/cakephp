<div class="evidenceTags index">
	<h2><?php echo __('Evidence Tags'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('evidence_id'); ?></th>
			<th><?php echo $this->Paginator->sort('tag_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($evidenceTags as $evidenceTag): ?>
	<tr>
		<td><?php echo h($evidenceTag['EvidenceTag']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($evidenceTag['Evidence']['title'], array('controller' => 'evidences', 'action' => 'view', $evidenceTag['Evidence']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($evidenceTag['Tag']['name'], array('controller' => 'tags', 'action' => 'view', $evidenceTag['Tag']['id'])); ?>
		</td>
		<td><?php echo h($evidenceTag['EvidenceTag']['created']); ?>&nbsp;</td>
		<td><?php echo h($evidenceTag['EvidenceTag']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $evidenceTag['EvidenceTag']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $evidenceTag['EvidenceTag']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $evidenceTag['EvidenceTag']['id']), null, __('Are you sure you want to delete # %s?', $evidenceTag['EvidenceTag']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Evidence Tag'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Evidences'), array('controller' => 'evidences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evidence'), array('controller' => 'evidences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
