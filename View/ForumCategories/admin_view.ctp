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
		<div class="forumCategories">
		<h2><?php echo __('Forum Category'); ?></h2>
			<dl>
				<dt><?php echo __('Id'); ?></dt>
				<dd>
					<?php echo h($forumCategory['ForumCategory']['id']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Title'); ?></dt>
				<dd>
					<?php echo h($forumCategory['ForumCategory']['title']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Slug'); ?></dt>
				<dd>
					<?php echo h($forumCategory['ForumCategory']['slug']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Description'); ?></dt>
				<dd>
					<?php echo h($forumCategory['ForumCategory']['description']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('User'); ?></dt>
				<dd>
					<?php echo $this->Html->link($forumCategory['User']['name'], array('controller' => 'users', 'action' => 'view', $forumCategory['User']['id'])); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Forum'); ?></dt>
				<dd>
					<?php echo $this->Html->link($forumCategory['Forum']['title'], array('controller' => 'forums', 'action' => 'view', $forumCategory['Forum']['id'])); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Created'); ?></dt>
				<dd>
					<?php echo h($forumCategory['ForumCategory']['created']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Modified'); ?></dt>
				<dd>
					<?php echo h($forumCategory['ForumCategory']['modified']); ?>
					&nbsp;
				</dd>
			</dl>
		</div>
		<div class="actions">
			<h3><?php echo __('Actions'); ?></h3>
			<ul>
				<li><?php echo $this->Html->link(__('Edit Forum Category'), array('action' => 'edit', $forumCategory['ForumCategory']['id'])); ?> </li>
				<li><?php echo $this->Form->postLink(__('Delete Forum Category'), array('action' => 'delete', $forumCategory['ForumCategory']['id']), array(), __('Are you sure you want to delete # %s?', $forumCategory['ForumCategory']['id'])); ?> </li>
				<li><?php echo $this->Html->link(__('List Forum Categories'), array('action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Forum Category'), array('action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List Forums'), array('controller' => 'forums', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Forum'), array('controller' => 'forums', 'action' => 'add')); ?> </li>
			</ul>
		</div>
	</div>
</div>	