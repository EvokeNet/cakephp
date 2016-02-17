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
		<div>
		<h2><?php echo __('Forum'); ?></h2>
			<dl>
				<dt><?php echo __('Id'); ?></dt>
				<dd>
					<?php echo h($forum['Forum']['id']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Title'); ?></dt>
				<dd>
					<?php echo h($forum['Forum']['title']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Slug'); ?></dt>
				<dd>
					<?php echo h($forum['Forum']['slug']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Description'); ?></dt>
				<dd>
					<?php echo h($forum['Forum']['description']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('User'); ?></dt>
				<dd>
					<?php echo $this->Html->link($forum['User']['name'], array('controller' => 'users', 'action' => 'view', $forum['User']['id'])); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Created'); ?></dt>
				<dd>
					<?php echo h($forum['Forum']['created']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Modified'); ?></dt>
				<dd>
					<?php echo h($forum['Forum']['modified']); ?>
					&nbsp;
				</dd>
			</dl>
		</div>
		<div class="actions">
			<h3><?php echo __('Actions'); ?></h3>
			<ul>
				<li><?php echo $this->Html->link(__('Edit Forum'), array('action' => 'edit', $forum['Forum']['id'])); ?> </li>
				<li><?php echo $this->Form->postLink(__('Delete Forum'), array('action' => 'delete', $forum['Forum']['id']), array(), __('Are you sure you want to delete # %s?', $forum['Forum']['id'])); ?> </li>
				<li><?php echo $this->Html->link(__('List Forums'), array('action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Forum'), array('action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List Forum Categories'), array('controller' => 'forum_categories', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Forum Category'), array('controller' => 'forum_categories', 'action' => 'add')); ?> </li>
			</ul>
		</div>
		<div class="related">
			<h3><?php echo __('Related Forum Categories'); ?></h3>
			<?php if (!empty($forum['ForumCategory'])): ?>
			<table cellpadding = "0" cellspacing = "0">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Title'); ?></th>
				<th><?php echo __('Slug'); ?></th>
				<th><?php echo __('Description'); ?></th>
				<th><?php echo __('User Id'); ?></th>
				<th><?php echo __('Forum Id'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			<?php foreach ($forum['ForumCategory'] as $forumCategory): ?>
				<tr>
					<td><?php echo $forumCategory['id']; ?></td>
					<td><?php echo $forumCategory['title']; ?></td>
					<td><?php echo $forumCategory['slug']; ?></td>
					<td><?php echo $forumCategory['description']; ?></td>
					<td><?php echo $forumCategory['user_id']; ?></td>
					<td><?php echo $forumCategory['forum_id']; ?></td>
					<td><?php echo $forumCategory['created']; ?></td>
					<td><?php echo $forumCategory['modified']; ?></td>
					<td class="actions">
						<?php echo $this->Html->link(__('View'), array('controller' => 'forum_categories', 'action' => 'view', $forumCategory['id'])); ?>
						<?php echo $this->Html->link(__('Edit'), array('controller' => 'forum_categories', 'action' => 'edit', $forumCategory['id'])); ?>
						<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'forum_categories', 'action' => 'delete', $forumCategory['id']), array(), __('Are you sure you want to delete # %s?', $forumCategory['id'])); ?>
					</td>
				</tr>
			<?php endforeach; ?>
			</table>
		<?php endif; ?>

			<div class="actions">
				<ul>
					<li><?php echo $this->Html->link(__('New Forum Category'), array('controller' => 'forum_categories', 'action' => 'add')); ?> </li>
				</ul>
			</div>
		</div>
	</div>
</div>