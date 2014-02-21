<?php $comments_count = ' ('.count($comment). ') '; ?>

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

  	<div class = "buttons">
		<div>
			<div id="fb-root"></div>
	  		<div class="fb-share-button" data-href="http://developers.facebook.com/docs/plugins/" data-width="" data-type="button"></div>
	  	</div>

	  	<div>
	  		<div class="g-plus" data-action="share" data-annotation="none" data-height="24"></div>
	  	</div>

	  	<div><a href="#" data-reveal-id="myModalVote" data-reveal><button><?php echo __('Vote');?></button></a></div>
	  	<div><a href="#" data-reveal-id="myModalComment" data-reveal><button><?php echo __('Comment').$comments_count;?></button></a></div>
	</div>
  </div>
</div>

<div id="myModalVote" class="reveal-modal tiny" data-reveal>
  <?php 
	if(!$vote) echo $this->element('vote', array('evidence_id' => $evidence['Evidence']['id'], 'user_id' => $userid));
	else echo $this->element('see_vote', array('evidence_id' => $evidence['Evidence']['id'], 'user_id' => $userid, 'vote_id' => $vote['Vote']['id']));
  ?>
  <a class="close-reveal-modal">&#215;</a>
</div>

<div id="myModalComment" class="reveal-modal tiny" data-reveal>
  <?php 
	echo $this->element('comment', array('evidence_id' => $evidence['Evidence']['id'], 'user_id' => $userid));
  ?>
  <a class="close-reveal-modal">&#215;</a>
</div>
