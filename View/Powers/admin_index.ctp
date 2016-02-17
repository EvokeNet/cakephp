<?php
	// TOPBAR MENU -->
	$this->start('topbar');
	echo $this->element('top-bar');
	$this->end();

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => __('Admin Panel'), 'imgSrc' => ($this->webroot.'img/header-leaderboard-2.jpg'), 'margin' => false, 'hidden' => true));
	$this->end();

	echo $this->Html->css(
		array(
			'evoke',
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
		<div class="powers index">
			<h2><?php echo __('Powers'); ?></h2>
			<table cellpadding="0" cellspacing="0">
			<tr>
					<th><?php echo $this->Paginator->sort('id'); ?></th>
					<th><?php echo $this->Paginator->sort('name'); ?></th>
					<th><?php echo $this->Paginator->sort('description'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			<?php foreach ($powers as $power): ?>
			<tr>
				<td><?php echo h($power['Power']['id']); ?>&nbsp;</td>
				<td><?php echo h($power['Power']['name']); ?>&nbsp;</td>
				<td><?php echo h($power['Power']['description']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $power['Power']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $power['Power']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $power['Power']['id']), array(), __('Are you sure you want to delete # %s?', $power['Power']['id'])); ?>
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
				<li><?php echo $this->Html->link(__('New Power'), array('action' => 'add')); ?></li>
			</ul>
		</div>
	</div>	
</div>