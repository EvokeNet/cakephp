<div class="table full-width padding top-1 bottom-1 left-2 right-2 border-bottom-divisor background-color-standard background-color-light-dark-on-hover">
	<!-- USER PICTURE -->
	<div class="table-cell vertical-align-middle square-60px">
		<?php $pic = $this->UserPicture->getPictureAbsolutePath($comment['User']); ?>
		<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $comment['User']['id'])); ?>">
			<div class="square-60px background-cover background-center img-circular" style="background-image: url(<?= $pic ?>);">
				<img class="hidden" src="<?= $pic ?>" alt="<?= $comment['User']['name'] ?>'s profile picture" /> <!-- For accessibility -->
			</div>
		</a>
	</div>

	<!-- COMMENT INFO -->
	<div class="table-cell vertical-align-middle padding left-1">
		<a href="<?php echo $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $comment['User']['id'])); ?>">
			

			<!-- COMMENT -->
			<div class="small-10 medium-10 large-10 columns">
				<!-- AGENT NAME AND COMMENT DATE -->
				<h5>
					<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $comment['User']['id'])); ?>">
						<span class="text-color-highlight"><?= __('Agent ') ?><?= $comment['User']['name'] ?></span>
						<?php echo date('F j, Y', strtotime($comment['Comment']['created'])); ?>
					</a>
				</h5>

				<!-- CONTENT -->
				<p><?php echo $comment['Comment']['content']; ?></p>
			</div>

			<!-- EDIT -->
			<?php if(isset($loggedInUser) && $comment['Comment']['user_id'] == $loggedInUser['id']): ?>
				<div class="small-2 medium-2 large-2 columns">
					<div class="comment-box-delete margin bottom-1">
						<a href = "<?php echo $this->Html->url(array('controller'=> 'comments', 'action' => 'delete', $comment['Comment']['id'])); ?>">
							<i class="fa fa-times-circle fa-lg"></i>
						</a>
					</div>

					<a href="#" class="comment-box-edit" data-reveal-id="modalEvidenceComment<?= $comment['Comment']['id'] ?>" data-reveal>
						<i class="fa fa-pencil fa-lg"></i>&nbsp;&nbsp;
					</a>

					<!-- Lightbox for commenting form -->
					<div id="modalEvidenceComment<?= $comment['Comment']['id'] ?>" class="reveal-modal background-color-darkest" data-reveal>
						<h1><?= __('Edit comment') ?></h1>
						<?php 
							echo $this->element('comment_form', array(
								'evidence_id' => $evidence['Evidence']['id'],
								'user_id' => $loggedInUser['id'],
								'comment_id' => $comment['Comment']['id'],
								'content' => $comment['Comment']['content']
							));
						?>
						<a class="close-reveal-modal">&#215;</a>
					</div>
				</div>
			<?php endif; ?>
		</a>
	</div>
</div>