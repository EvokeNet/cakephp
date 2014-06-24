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
            <h3 class = "margin top"> <?= strtoupper(__('Forum')) ?> </h3>
        </div>

        <!-- <div class="text-align-end">
            <?php 
                if ($user['User']['role_id'] == 1): ?>

                <a href = "<?= $this->Html->url(array('controller' => 'forum_posts', 'action' => 'add', $forumTopic['ForumTopic']['id'])) ?>" class = 'button general green'><?= __('Add Post') ?></a>
            <?php
                endif;
            ?>
        </div> -->

        <div class="evoke sheer-background">
            <?php

            echo $this->element('forums/topic', array('topic' => $forumTopic));

            if (isset($posts)):
                foreach ($posts as $post): 
                	echo $this->element('forums/post', array('post' => $post)); 
            	endforeach; endif; 

        	?>

        </div>

     	<div class = "forum reply panel text-align-center">

            <div class = "margin bottom-1"><a class = "title" name = "anchor"><?php echo __d('forum', 'Reply'); ?></a></div>

            <div class="panel-body">
				<?php echo $this->Form->create('ForumPost'); ?>
				<?php
					echo $this->Form->hidden('user_id', array('value' => $user['User']['id']));
					echo $this->Form->hidden('forum_id', array('value' => $forumTopic['Forum']['id']));
					echo $this->Form->hidden('forum_topic_id', array('value' => $forumTopic['ForumTopic']['id']));
					echo $this->Media->ckeditor('content'); //echo $this->Form->input('content');
				?>
				<?php echo $this->Form->end(__('Submit')); ?>
			</div>
		</div>


	  </div>
	
	</div>

</section>

<?php
	echo $this->Html->script('menu_height', array('inline' => false));
?>

<!-- <div class="forumTopics view">
<h2><?php echo __('Forum Topic'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($forumTopic['ForumTopic']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($forumTopic['User']['name'], array('controller' => 'users', 'action' => 'view', $forumTopic['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Forum'); ?></dt>
		<dd>
			<?php echo $this->Html->link($forumTopic['Forum']['title'], array('controller' => 'forums', 'action' => 'view', $forumTopic['Forum']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($forumTopic['ForumTopic']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Slug'); ?></dt>
		<dd>
			<?php echo h($forumTopic['ForumTopic']['slug']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($forumTopic['ForumTopic']['content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($forumTopic['ForumTopic']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('View Count'); ?></dt>
		<dd>
			<?php echo h($forumTopic['ForumTopic']['view_count']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ForumPost Count'); ?></dt>
		<dd>
			<?php echo h($forumTopic['ForumTopic']['forumPost_count']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('FirstPost Id'); ?></dt>
		<dd>
			<?php echo h($forumTopic['ForumTopic']['firstPost_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('LastPost Id'); ?></dt>
		<dd>
			<?php echo h($forumTopic['ForumTopic']['lastPost_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('LastUser Id'); ?></dt>
		<dd>
			<?php echo h($forumTopic['ForumTopic']['lastUser_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($forumTopic['ForumTopic']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($forumTopic['ForumTopic']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Forum Topic'), array('action' => 'edit', $forumTopic['ForumTopic']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Forum Topic'), array('action' => 'delete', $forumTopic['ForumTopic']['id']), array(), __('Are you sure you want to delete # %s?', $forumTopic['ForumTopic']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Forum Topics'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum Topic'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forums'), array('controller' => 'forums', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum'), array('controller' => 'forums', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forum Posts'), array('controller' => 'forum_posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum Post'), array('controller' => 'forum_posts', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Forum Posts'); ?></h3>
	<?php if (!empty($forumTopic['ForumPost'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Forum Id'); ?></th>
		<th><?php echo __('Forum Topic Id'); ?></th>
		<th><?php echo __('Content'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($forumTopic['ForumPost'] as $forumPost): ?>
		<tr>
			<td><?php echo $forumPost['id']; ?></td>
			<td><?php echo $forumPost['user_id']; ?></td>
			<td><?php echo $forumPost['forum_id']; ?></td>
			<td><?php echo $forumPost['forum_topic_id']; ?></td>
			<td><?php echo $forumPost['content']; ?></td>
			<td><?php echo $forumPost['created']; ?></td>
			<td><?php echo $forumPost['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'forum_posts', 'action' => 'view', $forumPost['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'forum_posts', 'action' => 'edit', $forumPost['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'forum_posts', 'action' => 'delete', $forumPost['id']), array(), __('Are you sure you want to delete # %s?', $forumPost['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Forum Post'), array('controller' => 'forum_posts', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Forums'); ?></h3>
	<?php if (!empty($forumTopic['Forum'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Slug'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Topic Count'); ?></th>
		<th><?php echo __('Post Count'); ?></th>
		<th><?php echo __('Forum Topic Id'); ?></th>
		<th><?php echo __('Forum Post Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($forumTopic['Forum'] as $forum): ?>
		<tr>
			<td><?php echo $forum['id']; ?></td>
			<td><?php echo $forum['user_id']; ?></td>
			<td><?php echo $forum['title']; ?></td>
			<td><?php echo $forum['slug']; ?></td>
			<td><?php echo $forum['description']; ?></td>
			<td><?php echo $forum['topic_count']; ?></td>
			<td><?php echo $forum['post_count']; ?></td>
			<td><?php echo $forum['forum_topic_id']; ?></td>
			<td><?php echo $forum['forum_post_id']; ?></td>
			<td><?php echo $forum['created']; ?></td>
			<td><?php echo $forum['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'forums', 'action' => 'view', $forum['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'forums', 'action' => 'edit', $forum['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'forums', 'action' => 'delete', $forum['id']), array(), __('Are you sure you want to delete # %s?', $forum['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Forum'), array('controller' => 'forums', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div> -->
