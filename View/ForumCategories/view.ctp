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
			<?= $this->Paginator->prev('<<',array('class' => 'button thin')) ?>
			<?= $this->Paginator->numbers(array('separator' => ' ','class' => 'button thin')) ?>
			<?= $this->Paginator->next('>>',array('class' => 'button thin')) ?>
		</div>

		<!-- NEW TOPIC BUTTON -->
		<a class="forums post-link box button thin" href="/evoke/forum_topics/new_topic/<?= $forumCategory['ForumCategory']['id'] ?>">
			NEW TOPIC
		</a>
	
	</div>

	<!-- TOPICS -->
	<table class="forums table">
		<thead class="head">
			<th class="left head-cell"><?php echo $this->Paginator->sort('title','Topic'); ?></th>
			<th class="centered head-cell size1"><?php echo $this->Paginator->sort('answers','Answers'); ?></th>
			<th class="centered head-cell size1"><?php echo $this->Paginator->sort('view_count','Views'); ?></th>
			<th class="centered head-cell size2"><?php echo $this->Paginator->sort('User.name','Created By'); ?></th>
			<th class="centered head-cell size2"><?php echo $this->Paginator->sort('created','Date'); ?></th>
		</thead>

		<?php foreach ($forumTopics as $topic): ?>
			<?php if(isset($topic['ForumTopic']['title'])):?>
			<tbody>
				<tr>
					<td class="left cell">
						<a href="/evoke/forum_topics/view/<?= $topic['ForumTopic']['id'] ?>">
							<?= $topic['ForumTopic']['title'] ?>
						</a>
					</td>
					<td class="centered cell gray-cell">
						<?= $topic['0']['answers'] ?>	
					</td>
					<td class="centered cell gray-cell">
						<?= $topic['ForumTopic']['view_count'] ?>
					</td>
					<td class="left cell">
						<a href="/evoke/users/profile/<?= $topic['ForumTopic']['user_id'] ?>">
							<div class="user_picture centered-block square-30px background-cover background-center img-circular" style="background-image: url('/evoke/webroot/img/user_avatar.jpg');">
							</div>
						</a>
						<a href="/evoke/users/profile/<?= $topic['ForumTopic']['user_id'] ?>">
							<?= $topic['User']['name'] ?>
						</a>
					</td>
					<td class="centered cell gray-cell">
						<?= date("d-M-Y", strtotime($topic['ForumTopic']['created'])) ?>
					</td>
				</tr>
			</tbody>
			<?php endif; ?>
		<?php endforeach; ?>

	</table>

	<!-- PAGING -->
	<div class="forums paging">
		<?= $this->Paginator->prev('<<',array('class' => 'button thin')) ?>
		<?= $this->Paginator->numbers(array('separator' => ' ','class' => 'button thin')) ?>
		<?= $this->Paginator->next('>>',array('class' => 'button thin')) ?>
	</div>

</div>	