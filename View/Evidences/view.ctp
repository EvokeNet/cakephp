<?php

	$comments_count = ' ('.count($comment). ') ';

?>
	<div class="row evidences">
	  <div class="small-6 large-2 columns bio">
	 	<?php echo $this->Html->link(__('Agent ').$evidence['User']['name'], array('controller' => 'users', 'action' => 'view', $evidence['User']['id']));?>
	 	<p><?php echo $evidence['User']['biography'] ?></p>
	 	<hr class="sexy_line" />
	  </div>
	  <div class="small-6 large-8 columns">
	  	<h1><?php echo h($evidence['Evidence']['title']); ?></h1>
	  	<h6><?php echo h($evidence['Evidence']['created']); ?></h6>
	  	<p><?php echo h($evidence['Evidence']['content']); ?></p>
	  	
	  	<h1><?php echo __('Share a Thought').$comments_count; ?></h1>
	  	<?php foreach ($comment as $c): ?>
	  		<div class = "comment">
				<tr>
					<td>
						<h5><?php echo (__('Agent ').$c['User']['name']); ?></h5>
						<h6><?php echo date('F j, Y', strtotime($c['Comment']['created'])); ?></h6>
						<p><?php echo $c['Comment']['content']; ?></p>
						<hr class="sexy_line" />
					</td>
				</tr>
			</div>
		<?php endforeach; ?>
	  </div>
	  <div class="small-12 large-2 columns">
	  	<button><?php echo $this->Html->link(__('Comment').$comments_count, array('controller' => 'comments', 'action' => 'add')); ?> </button>
	  	<div class="fb-share-button" data-href="http://developers.facebook.com/docs/plugins/" data-width="" data-type="button"></div>
	  	<div class="g-plus" data-action="share" data-annotation="none" data-height="24"></div>
	  	<button><a href="#" data-reveal-id="myModal" data-reveal>Click Me For A Modal</a></button>
	  </div>
	</div>

<div id="myModal" class="reveal-modal tiny" data-reveal>
  <h2>Awesome. I have it.</h2>
  <?php echo $this->element('votes');?>
  <p>Im a cool paragraph that lives inside of an even cooler modal. Wins</p>
  <a class="close-reveal-modal">&#215;</a>
</div>

<div id="fb-root"></div>

<script>
//Facebook Share button script
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

//Google Share button script
(function() {
	var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	po.src = 'https://apis.google.com/js/platform.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>

<!-- <div class="evidences view">
<h2><?php echo __('Evidence'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($evidence['Evidence']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($evidence['Evidence']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($evidence['Evidence']['content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($evidence['User']['name'], array('controller' => 'users', 'action' => 'view', $evidence['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quest'); ?></dt>
		<dd>
			<?php echo $this->Html->link($evidence['Quest']['title'], array('controller' => 'quests', 'action' => 'view', $evidence['Quest']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mission'); ?></dt>
		<dd>
			<?php echo $this->Html->link($evidence['Mission']['title'], array('controller' => 'missions', 'action' => 'view', $evidence['Mission']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($evidence['Evidence']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($evidence['Evidence']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Evidence'), array('action' => 'edit', $evidence['Evidence']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Evidence'), array('action' => 'delete', $evidence['Evidence']['id']), null, __('Are you sure you want to delete # %s?', $evidence['Evidence']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Evidences'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evidence'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Quests'), array('controller' => 'quests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Quest'), array('controller' => 'quests', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Missions'), array('controller' => 'missions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mission'), array('controller' => 'missions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Comments'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Votes'), array('controller' => 'votes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vote'), array('controller' => 'votes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Comments'); ?></h3>
	<?php if (!empty($evidence['Comment'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Evidence Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($evidence['Comment'] as $comment): ?>
		<tr>
			<td><?php echo $comment['id']; ?></td>
			<td><?php echo $comment['evidence_id']; ?></td>
			<td><?php echo $comment['user_id']; ?></td>
			<td><?php echo $comment['created']; ?></td>
			<td><?php echo $comment['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'comments', 'action' => 'view', $comment['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'comments', 'action' => 'edit', $comment['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'comments', 'action' => 'delete', $comment['id']), null, __('Are you sure you want to delete # %s?', $comment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Votes'); ?></h3>
	<?php if (!empty($evidence['Vote'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Evidence Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($evidence['Vote'] as $vote): ?>
		<tr>
			<td><?php echo $vote['id']; ?></td>
			<td><?php echo $vote['evidence_id']; ?></td>
			<td><?php echo $vote['user_id']; ?></td>
			<td><?php echo $vote['created']; ?></td>
			<td><?php echo $vote['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'votes', 'action' => 'view', $vote['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'votes', 'action' => 'edit', $vote['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'votes', 'action' => 'delete', $vote['id']), null, __('Are you sure you want to delete # %s?', $vote['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Vote'), array('controller' => 'votes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
 -->