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

<div class="missions index">
	<h2><?php echo __('Missions'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('organization_id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('title_es'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('description_es'); ?></th>
			<th><?php echo $this->Paginator->sort('image_dir'); ?></th>
			<th><?php echo $this->Paginator->sort('image_attachment'); ?></th>
			<th><?php echo $this->Paginator->sort('cover_dir'); ?></th>
			<th><?php echo $this->Paginator->sort('cover_attachment'); ?></th>
			<th><?php echo $this->Paginator->sort('language'); ?></th>
			<th><?php echo $this->Paginator->sort('video_link'); ?></th>
			<th><?php echo $this->Paginator->sort('video_link_es'); ?></th>
			<th><?php echo $this->Paginator->sort('basic_training'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($missions as $mission): ?>
	<tr>
		<td><?php echo h($mission['Mission']['id']); ?>&nbsp;</td>
		<td><?php echo h($mission['Mission']['organization_id']); ?>&nbsp;</td>
		<td><?php echo h($mission['Mission']['title']); ?>&nbsp;</td>
		<td><?php echo h($mission['Mission']['title_es']); ?>&nbsp;</td>
		<td><?php echo h($mission['Mission']['description']); ?>&nbsp;</td>
		<td><?php echo h($mission['Mission']['description_es']); ?>&nbsp;</td>
		<td><?php echo h($mission['Mission']['image_dir']); ?>&nbsp;</td>
		<td><?php echo h($mission['Mission']['image_attachment']); ?>&nbsp;</td>
		<td><?php echo h($mission['Mission']['cover_dir']); ?>&nbsp;</td>
		<td><?php echo h($mission['Mission']['cover_attachment']); ?>&nbsp;</td>
		<td><?php echo h($mission['Mission']['language']); ?>&nbsp;</td>
		<td><?php echo h($mission['Mission']['video_link']); ?>&nbsp;</td>
		<td><?php echo h($mission['Mission']['video_link_es']); ?>&nbsp;</td>
		<td><?php echo h($mission['Mission']['basic_training']); ?>&nbsp;</td>
		<td><?php echo h($mission['Mission']['created']); ?>&nbsp;</td>
		<td><?php echo h($mission['Mission']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $mission['Mission']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $mission['Mission']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $mission['Mission']['id']), array(), __('Are you sure you want to delete # %s?', $mission['Mission']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
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
