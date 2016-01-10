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
		<!-- TOPICS LINK -->
		<a href="/evoke/forum_categories/view/<?= $forumTopic['ForumTopic']['forum_categorie_id'] ?>"><h4 class="evoke text-glow forums link-title"><?php echo __('Topics'); ?></h4></a>
	</div>

	<!-- NEW POST BUTTON -->
	<div class="forums post-link centering">
		<!-- PAGING -->
		<div class="forums paging post-link">
			<div class="float">
				<?= $this->Paginator->prev('<<',array('class' => 'button thin')) ?>
				<?= $this->Paginator->numbers(array('separator' => ' ','class' => 'button thin')) ?>
				<?= $this->Paginator->next('>>',array('class' => 'button thin')) ?>
			</div>
		</div>

		<div class="forums post-link float">
			<a class="forums post-link box button thin" href="/evoke/forum_topics/post/<?= $forumTopic['ForumTopic']['id'] ?>">
				REPLY
			</a>
		</div>
	</div>	

	<!-- TOPIC FIRST POST -->
	<?php if ($this->Paginator->params()['page']==1): ?>
	<div class="forums post padding" id="0">
		<div class="panel callout radius forums post">
			<i class="forums post icon fa fa-quote-right fa-3x text-color-highlight padding right-1"></i>
			<h2 class="forums post title">
				<?= $forumTopic['ForumTopic']['title'] ?>
			</h2>
			<h5 class="forums post author">
				<a href="/evoke/users/profile/<?= $forumTopic['User']['id'] ?>">
					<?= $forumTopic['User']['name'] ?>		
				</a>
			</h5>
			<hr>
			<div class="forums post content">
				<?= $forumTopic['ForumTopic']['content'] ?>
			</div>
		</div>
	</div>	
	<?php endif; ?>

	<?php foreach ($forumPosts as $post): ?>
	<!-- POSTS -->
	<div class="forums post padding" id="<?= $post['ForumPost']['id'] ?>">
		<div class="panel callout radius forums post">

			<!-- CONFIG BUTTONS -->
			<?php if($post['User']['id'] == $loggedInUser['id']): ?>
			<div class="forums post-edit-link float">
				<!-- EDIT BUTTON -->
				<a class="forums post-edit-link box button thin" href="/evoke/forum_posts/edit/<?= $post['ForumPost']['id'] ?>">
					EDIT
				</a>

				<!-- DELETE BUTTON -->
				<form action="/evoke/forum_posts/delete/<?=$post['ForumPost']['id']?>" name="delete<?=$post['ForumPost']['id']?>" id="delete<?=$post['ForumPost']['id']?>" style="display:none;" method="post">
					<input type="hidden" name="_method" value="POST">
				</form>
				<a class="forums post-edit-link box button thin" href="#" onclick="if (confirm('Are you sure you want to delete # 1?')) { document.delete<?=$post['ForumPost']['id']?>.submit(); } event.returnValue = false; return false;">
					<i class="fa fa-trash-o fa-1x"></i>
				</a>
			</div>
			<?php endif; ?>

			<h2 class="forums post title">
				<?= $post['ForumPost']['title'] ?>
			</h2>
			<h5 class="forums post author">
				By 
				<a href="/evoke/users/profile/<?= $post['User']['id'] ?>">
					<?= $post['User']['name'] ?>		
				</a>
			</h5>
			<hr>
			<div class="forums post content">
				<?= $post['ForumPost']['content'] ?>
			</div>
		</div>
	</div>
	<?php endforeach; ?>

	<!-- NEW POST BUTTON -->
	<div class="forums post-link centering">
		<!-- PAGING -->
		<div class="forums paging post-link">
			<div class="float">
				<?= $this->Paginator->prev('<<',array('class' => 'button thin')) ?>
				<?= $this->Paginator->numbers(array('separator' => ' ','class' => 'button thin')) ?>
				<?= $this->Paginator->next('>>',array('class' => 'button thin')) ?>
			</div>
		</div>
		
		<div class="forums post-link float">
			<a class="forums post-link box button thin" href="/evoke/forum_topics/post/<?= $forumTopic['ForumTopic']['id'] ?>">
				REPLY
			</a>
		</div>
	</div>	

</div>	