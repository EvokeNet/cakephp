<div class = "issues">
	
	<h1><?php //echo __('Mission Under Issues: ').$missionissues[0]['Issue']['name'];?></h1>
	
	<?php

	$title = $missionissues[0]['Issue']['name'];

	foreach($issues as $i):?>

		<!-- Print the category's name -->
		<h1><?php echo __('Mission Under Issues: ').$i['Issue']['name'];?></h1>
	
		<?php foreach($missionissues as $m):
		//If the mission belongs to that category, it is printed
			if($i['Issue']['name'] == $m['Issue']['name']):?>
				<h2><?php echo $this->Html->link($m['Mission']['title'], array('controller' => 'missions', 'action' => 'view', $m['Mission']['id'])); ?></h2>
				<p><?php echo $m['Mission']['description'];?></p>
			<?php endif;

		endforeach;
	endforeach; ?>
	
</div>

<?php //foreach ($missions as $mission): ?>
	<!-- <h2><?php echo $this->Html->link(__($mission['Mission']['title']), array('action' => 'view', $mission['Mission']['id'])); ?></h2>
	<p><?php echo h($mission['Mission']['description']); ?></p> -->
<?php //endforeach; ?>

<?php //foreach($missionissues as $m):?>
	<!-- <div>
		<?php if($title != $m['Issue']['name']):
			$title = $m['Issue']['name'];?>
			<h1><?php echo __('Mission Under Issues: ').$title;?></h1>
		<?php endif;?>
	
		<div>
			<h2><?php echo $this->Html->link($m['Mission']['title'], array('controller' => 'missions', 'action' => 'view', $m['Mission']['id'])); ?></h2>
			<p><?php echo $m['Mission']['description'];?></p>
		</div>
	</div> -->
<?php //endforeach; ?>

<!-- <div class="missions index">
	<h2><?php echo __('Missions'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('image'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($missions as $mission): ?>
	<tr>
		<td><?php echo h($mission['Mission']['id']); ?>&nbsp;</td>
		<td><?php echo h($mission['Mission']['title']); ?>&nbsp;</td>
		<td><?php echo h($mission['Mission']['description']); ?>&nbsp;</td>
		<td><?php echo h($mission['Mission']['image']); ?>&nbsp;</td>
		<td><?php echo h($mission['Mission']['created']); ?>&nbsp;</td>
		<td><?php echo h($mission['Mission']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $mission['Mission']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $mission['Mission']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $mission['Mission']['id']), null, __('Are you sure you want to delete # %s?', $mission['Mission']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Mission'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Evidences'), array('controller' => 'evidences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evidence'), array('controller' => 'evidences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Mission Issues'), array('controller' => 'mission_issues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mission Issue'), array('controller' => 'mission_issues', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Quests'), array('controller' => 'quests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Quest'), array('controller' => 'quests', 'action' => 'add')); ?> </li>
	</ul>
</div> -->
