<?php
	
    $this->extend('/Common/admin_panel');

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

<?php $this->start('page_content'); ?>

<div class="row full-width" data-equalizer>

	<div class="large-10 columns" id="panel-content" data-equalizer-watch>	
		<div class="socialInnovatorQualities index">
			<h2><?php echo __('Social Innovator Qualities'); ?></h2>
			<table cellpadding="0" cellspacing="0">
			<tr>
					<th><?php echo $this->Paginator->sort('id'); ?></th>
					<th><?php echo $this->Paginator->sort('name'); ?></th>
					<th><?php echo $this->Paginator->sort('short_name'); ?></th>
					<th><?php echo $this->Paginator->sort('description'); ?></th>
					<th><?php echo $this->Paginator->sort('created'); ?></th>
					<th><?php echo $this->Paginator->sort('modified'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			<?php foreach ($socialInnovatorQualities as $socialInnovatorQuality): ?>
			<tr>
				<td><?php echo h($socialInnovatorQuality['SocialInnovatorQuality']['id']); ?>&nbsp;</td>
				<td><?php echo h($socialInnovatorQuality['SocialInnovatorQuality']['name']); ?>&nbsp;</td>
				<td><?php echo h($socialInnovatorQuality['SocialInnovatorQuality']['short_name']); ?>&nbsp;</td>
				<td><?php echo h($socialInnovatorQuality['SocialInnovatorQuality']['description']); ?>&nbsp;</td>
				<td><?php echo h($socialInnovatorQuality['SocialInnovatorQuality']['created']); ?>&nbsp;</td>
				<td><?php echo h($socialInnovatorQuality['SocialInnovatorQuality']['modified']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $socialInnovatorQuality['SocialInnovatorQuality']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $socialInnovatorQuality['SocialInnovatorQuality']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $socialInnovatorQuality['SocialInnovatorQuality']['id']), array(), __('Are you sure you want to delete # %s?', $socialInnovatorQuality['SocialInnovatorQuality']['id'])); ?>
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
				<li><?php echo $this->Html->link(__('New Social Innovator Quality'), array('action' => 'add')); ?></li>
				<li><?php echo $this->Html->link(__('List Matching Answers'), array('controller' => 'matching_answers', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Matching Answer'), array('controller' => 'matching_answers', 'action' => 'add')); ?> </li>
			</ul>
		</div>
	</div>
</div>

<?php $this->end(); ?>