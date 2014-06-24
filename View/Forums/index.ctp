<?php

	$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $user));

	$this->end(); 
?>

<section class="evoke default-background">

	<div class="evoke default row full-width-alternate profile">

	  <div class="small-2 medium-2 large-2 columns padding-left">
	  	<?php echo $this->element('menu', array('user' => $user));?>
	  </div>

	  <div class="small-10 medium-10 large-10 columns maincolumn">
	  	<?php echo $this->Session->flash(); ?>

	  	<div class = "default">
            <h3 class = "padding bottom-1"> <?= strtoupper(__('Forum')) ?> </h3>
        </div>

        <div class="text-align-end">
            <?php 
                if ($user['User']['role_id'] == 1): ?>

                <a href = "<?= $this->Html->url(array('controller' => 'forums', 'action' => 'add')) ?>" class = 'button general green'><?= __('Add Forum') ?></a>
            <?php
                endif;
            ?>
        </div>

        <div class="evoke sheer-background forum index">

        	<ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4">
                <li><h2><?= strtoupper(__("Forum")) ?></h2></li>
                <li><h2><?= strtoupper(__("Topics")) ?></h2></li>
                <li><h2><?= strtoupper(__("Posts")) ?></h2></li>
                <li><h2><?= strtoupper(__("Last Activity")) ?></h2></li>
            </ul>

            <?php
            
            if (isset($forums)):
                foreach ($forums as $forum): ?>

            <ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4">
                <li><h2><a href = "<?= $this->Html->url(array('controller' => 'forums', 'action' => 'view', $forum['Forum']['id'])) ?>"><?= $forum['Forum']['title'] ?></a></h2></li>
                <li><h2><?= $forum['Forum']['topic_count'] ?></h2></li>
                <li><h2><?= $forum['Forum']['post_count'] ?></h2></li>
                <li><h2><?= $forum['Forum']['lastPost_id'] ?></h2></li>
            </ul>

            <?php endforeach; endif; ?>
        	

        </div>

	  </div>
	
	</div>

</section>

<?php
	echo $this->Html->script('menu_height', array('inline' => false));
?>

<!-- <div class="forums index">
	<h2><?php echo __('Forums'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('slug'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('topic_count'); ?></th>
			<th><?php echo $this->Paginator->sort('post_count'); ?></th>
			<th><?php echo $this->Paginator->sort('forum_topic_id'); ?></th>
			<th><?php echo $this->Paginator->sort('forum_post_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($forums as $forum): ?>
	<tr>
		<td><?php echo h($forum['Forum']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($forum['User']['name'], array('controller' => 'users', 'action' => 'view', $forum['User']['id'])); ?>
		</td>
		<td><?php echo h($forum['Forum']['title']); ?>&nbsp;</td>
		<td><?php echo h($forum['Forum']['slug']); ?>&nbsp;</td>
		<td><?php echo h($forum['Forum']['description']); ?>&nbsp;</td>
		<td><?php echo h($forum['Forum']['topic_count']); ?>&nbsp;</td>
		<td><?php echo h($forum['Forum']['post_count']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($forum['ForumTopic']['title'], array('controller' => 'forum_topics', 'action' => 'view', $forum['ForumTopic']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($forum['ForumPost']['id'], array('controller' => 'forum_posts', 'action' => 'view', $forum['ForumPost']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Forum'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forum Topics'), array('controller' => 'forum_topics', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum Topic'), array('controller' => 'forum_topics', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forum Posts'), array('controller' => 'forum_posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum Post'), array('controller' => 'forum_posts', 'action' => 'add')); ?> </li>
	</ul>
</div> -->
