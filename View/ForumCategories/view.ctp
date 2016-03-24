<?php

/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();
?>

	<div class="row forums background-color">
      <div class="large-8 small-centered columns">

      	<a class="forums post-link box button thin" href="/evoke/forum_topics/new_topic/<?= $forumCategory['ForumCategory']['id'] ?>">
			NEW TOPIC
		</a>

		<h2 class = "margin-top-1em text-align-left uppercase">
			<?= $forumCategory['ForumCategory']['title'] ?>
		</h2>

        <!-- TOPICS -->
		<table class="forums table">
			 <thead class="head">
				<th class=""><?php echo $this->Paginator->sort('title','Topic'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('answers','Answers'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('view_count','Views'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('User.name','Created By'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('created','Date'); ?></th>
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
    </div>
