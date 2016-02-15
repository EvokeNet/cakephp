<?php
	
    $this->extend('/Common/admin_panel');

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

<?php $this->start('page_content'); ?>

<div class="row full-width" data-equalizer>

	<div class="large-10 columns" id="panel-content" data-equalizer-watch>			
		<div class="badges index">
			<h2><?php echo __('Badges'); ?></h2>
			<table class="evoke fixed-table" cellpadding="0" cellspacing="0" >
			<tr>
					<th><?php echo $this->Paginator->sort('id'); ?></th>
					<th><?php echo $this->Paginator->sort('organization_id'); ?></th>
					<th><?php echo $this->Paginator->sort('mission_id'); ?></th>
					<th><?php echo $this->Paginator->sort('name'); ?></th>
					<th><?php echo $this->Paginator->sort('name_es'); ?></th>
					<th><?php echo $this->Paginator->sort('description'); ?></th>
					<th><?php echo $this->Paginator->sort('description_es'); ?></th>
					<th><?php echo $this->Paginator->sort('power_points_only'); ?></th>
					<th><?php echo $this->Paginator->sort('trigger'); ?></th>
					<th><?php echo $this->Paginator->sort('language'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			<?php foreach ($badges as $badge): ?>
			<tr>
				<td><?php echo h($badge['Badge']['id']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($badge['Organization']['name'], array('controller' => 'organizations', 'action' => 'view', $badge['Organization']['id'])); ?>
				</td>
				<td><?php echo h($badge['Badge']['mission_id']); ?>&nbsp;</td>
				<td><?php echo h($badge['Badge']['name']); ?>&nbsp;</td>
				<td><?php echo h($badge['Badge']['name_es']); ?>&nbsp;</td>
				<td><?php echo h($badge['Badge']['description']); ?>&nbsp;</td>
				<td><?php echo h($badge['Badge']['description_es']); ?>&nbsp;</td>
				<td><?php echo h($badge['Badge']['power_points_only']); ?>&nbsp;</td>
				<td><?php echo h($badge['Badge']['trigger']); ?>&nbsp;</td>
				<td><?php echo h($badge['Badge']['language']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $badge['Badge']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $badge['Badge']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $badge['Badge']['id']), array(), __('Are you sure you want to delete # %s?', $badge['Badge']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
			</table>
			<!-- PAGING -->
			<div class="evoke paging">
				<?= $this->Paginator->prev('<<',array('class' => 'button thin')) ?>
				<?= $this->Paginator->numbers(array('separator' => ' ','class' => 'button thin')) ?>
				<?= $this->Paginator->next('>>',array('class' => 'button thin')) ?>
			</div>
		</div>
		<div class="actions">
			<h3><?php echo __('Actions'); ?></h3>
			<ul>
				<li><?php echo $this->Html->link(__('New Badge'), array('action' => 'add')); ?></li>
				<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List User Badges'), array('controller' => 'user_badges', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New User Badge'), array('controller' => 'user_badges', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List Attachments'), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Attachment'), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
			</ul>
		</div>
	</div>	
</div>

<?php $this->end(); ?>