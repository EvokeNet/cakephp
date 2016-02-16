<div class="superheroIdentities index">
	<h2><?php echo __('Superhero Identities'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('quality_1'); ?></th>
			<th><?php echo $this->Paginator->sort('quality_2'); ?></th>
			<th><?php echo $this->Paginator->sort('primaryPower'); ?></th>
			<th><?php echo $this->Paginator->sort('secondaryPower'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($superheroIdentities as $superheroIdentity): ?>
	<tr>
		<td><?php echo h($superheroIdentity['SuperheroIdentity']['id']); ?>&nbsp;</td>
		<td><?php echo h($superheroIdentity['SuperheroIdentity']['name']); ?>&nbsp;</td>
		<td><?php echo h($superheroIdentity['SuperheroIdentity']['quality_1']); ?>&nbsp;</td>
		<td><?php echo h($superheroIdentity['SuperheroIdentity']['quality_2']); ?>&nbsp;</td>
		<td><?php echo h($superheroIdentity['SuperheroIdentity']['primaryPower']); ?>&nbsp;</td>
		<td><?php echo h($superheroIdentity['SuperheroIdentity']['secondaryPower']); ?>&nbsp;</td>
		<td><?php echo h($superheroIdentity['SuperheroIdentity']['created']); ?>&nbsp;</td>
		<td><?php echo h($superheroIdentity['SuperheroIdentity']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $superheroIdentity['SuperheroIdentity']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $superheroIdentity['SuperheroIdentity']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $superheroIdentity['SuperheroIdentity']['id']), array(), __('Are you sure you want to delete # %s?', $superheroIdentity['SuperheroIdentity']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Superhero Identity'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Social Innovator Qualities'), array('controller' => 'social_innovator_qualities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Quality1'), array('controller' => 'social_innovator_qualities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Powers'), array('controller' => 'powers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Power1'), array('controller' => 'powers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
