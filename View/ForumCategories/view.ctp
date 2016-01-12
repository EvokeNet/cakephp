<?php
/* CSS */
	echo $this->Html->css('forums');

/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();
?>
<div class="evoke centering-block">

	<!-- HEAD -->
	<div class="forums index">
		<!-- FORUM LINK -->
		<a href="/evoke/forums"><h4 class="evoke text-glow forums link-title"><?php echo __('Forums'); ?></h4></a>
		<!-- FORUM TITLE -->
		<h2 class="evoke text-glow"><?= $forumCategory['ForumCategory']['title'] ?></h2>

		<!-- PAGING -->
		<div class="forums paging">
			<?= $this->Paginator->prev('<<') ?>
			<?= $this->Paginator->numbers(array('separator' => ' ')) ?>
			<?= $this->Paginator->next('>>') ?>
		</div>

	</div>

	<!-- TOPICS -->

	<table class="forums table">

		<thead>
			<th><?php echo $this->Paginator->sort('title','Topic'); ?></th>
			<th><?php echo $this->Paginator->sort('.answers','Answers'); ?></th>
			<th><?php echo $this->Paginator->sort('view_count','Views'); ?></th>
			<th><?php echo $this->Paginator->sort('User.name','Created By'); ?></th>
			<th><?php echo $this->Paginator->sort('created','Date'); ?></th>
		</thead>

		<?php foreach ($forumTopics as $topic): ?>
			<?php if(isset($topic['ForumTopic']['title'])):?>
			<tbody>
				<tr>
					<td>
						<a href="../../forum_topics/view/<?= $topic['ForumTopic']['id'] ?>">
							<?= $topic['ForumTopic']['title'] ?>
						</a>
					</td>
					<td>
						<?= $topic['0']['answers'] ?>	
					</td>
					<td>
						<?= $topic['ForumTopic']['view_count'] ?>
					</td>
					<td>
						<a href="../../users/profile/<?= $topic['ForumTopic']['user_id'] ?>">
							<?= $topic['User']['name'] ?>
						</a>
					</td>
					<td>
						<?= date("d-M-Y", strtotime($topic['ForumTopic']['created'])) ?>
					</td>
				</tr>
			</tbody>
			<?php endif; ?>
		<?php endforeach; ?>

	</table>

	<!-- PAGING -->
	<div class="forums paging">
		<?= $this->Paginator->prev('<<') ?>
		<?= $this->Paginator->numbers(array('separator' => ' ')) ?>
		<?= $this->Paginator->next('>>') ?>
	</div>

</div>	