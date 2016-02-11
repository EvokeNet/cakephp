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
		<div class="forums index">
			<h2><?php echo __('Forums'); ?></h2>
			<table cellpadding="0" cellspacing="0">
			<tr>
					<th><?php echo $this->Paginator->sort('id'); ?></th>
					<th><?php echo $this->Paginator->sort('title'); ?></th>
					<th><?php echo $this->Paginator->sort('slug'); ?></th>
					<th><?php echo $this->Paginator->sort('description'); ?></th>
					<th><?php echo $this->Paginator->sort('user_id'); ?></th>
					<th><?php echo $this->Paginator->sort('created'); ?></th>
					<th><?php echo $this->Paginator->sort('modified'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			<?php foreach ($forums as $forum): ?>
			<tr>
				<td><?php echo h($forum['Forum']['id']); ?>&nbsp;</td>
				<td><?php echo h($forum['Forum']['title']); ?>&nbsp;</td>
				<td><?php echo h($forum['Forum']['slug']); ?>&nbsp;</td>
				<td><?php echo h($forum['Forum']['description']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($forum['User']['name'], array('controller' => 'users', 'action' => 'view', $forum['User']['id'])); ?>
				</td>
				<td><?php echo h($forum['Forum']['created']); ?>&nbsp;</td>
				<td><?php echo h($forum['Forum']['modified']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $forum['Forum']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $forum['Forum']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $forum['Forum']['id']), array(), __('Are you sure you want to delete # %s?', $forum['Forum']['id'])); ?>
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
				<li><?php echo $this->Html->link(__('New Forum'), array('action' => 'add')); ?></li>
				<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List Forum Categories'), array('controller' => 'forum_categories', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Forum Category'), array('controller' => 'forum_categories', 'action' => 'add')); ?> </li>
			</ul>
		</div>
	</div>	
</div>