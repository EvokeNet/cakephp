<?php

$name = explode(' ', $c['User']['name']);
//echo $name[0];

?>

<div class="evoke row margin bottom-2">
  <div class="small-2 medium-2 large-2 columns evoke text-align">
  	<a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'profile', $c['User']['id'])) ?>">
	  	<?php if($c['User']['photo_attachment'] == null) : ?>
			<?php if($c['User']['facebook_id'] == null) : ?>
				<?php $pic = $this->webroot.'img/user_avatar.jpg';?>
			<?php else : ?>	
				<?php $pic = "https://graph.facebook.com/". $c['User']['facebook_id']."/picture?large";?>
			<?php endif; ?>
		<?php else : ?>
			<?php $pic = $this->webroot.'files/attachment/attachment/'.$c['User']['photo_dir'].'/'.$c['User']['photo_attachment'];?>
		<?php endif; ?>
		<div style="min-width: 5vw; min-height: 5vw; background-image: url(<?=$pic?>); background-position:center; background-size: 100% Auto;">
		</div>
	</a>

  	<!-- <img src="https://graph.facebook.com/<?php echo $c['User']['facebook_id']; ?>/picture?type=large" width="80px"/> -->
  	<a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'profile', $c['User']['id'])) ?>"><h4 style = "font-size: 0.9vw;"><?php echo (__('Agent ').$name[0]); ?></h4></a>
	<h6 style = "font-size: 0.7vw;"><?php echo date('F j, Y', strtotime($c['Comment']['created'])); ?></h6>
  </div>
  <div class="small-10 medium-10 large-10 columns">
  	<div class = "evoke bubble">
  		<div class="row">
		  <div class="small-10 medium-10 large-10 columns">
		  	<p><?php echo $c['Comment']['content']; ?></p>
		  </div>
		  <div class="small-2 medium-2 large-2 columns">
		  	<?php if($c['Comment']['user_id'] == $user['User']['id']): ?>

			  	<div class = "evoke comment-box-delete"><a href = "<?php echo $this->Html->url(array('controller'=> 'comments', 'action' => 'delete', $c['Comment']['id'])); ?>"><i class="fa fa-times-circle fa-lg"></i></a>
			  	</div>

			  	<a href = "#" class = "evoke comment-box-delete" data-reveal-id="<?= $c['Comment']['id'] ?>" data-reveal><i class="fa fa-pencil fa-lg"></i>&nbsp;&nbsp;
			  	</a>

			  	<!-- Lightbox for commenting form -->
				<div id="<?= $c['Comment']['id'] ?>" class="reveal-modal tiny evoke lightbox-bg" data-reveal>
				  	<?php if(isset($user['User'])) :?>
				  		<?php echo $this->element('edit_comment', array('evidence_id' => $evidence['Evidence']['id'], 'user_id' => $user['User']['id'], 'comment_id' => $c['Comment']['id'], 'content' => $c['Comment']['content'])); ?>
				  	<?php else :?>
				  		<?php echo $this->element('edit_comment', array('evidence_id' => $evidence['Evidence']['id'], 'user_id' => null, 'comment_id' => $c['Comment']['id'], 'content' => $c['Comment']['content'])); ?>
				  	<?php endif;?>
				  <a class="close-reveal-modal">&#215;</a>
				</div>

		  <?php endif; ?>
		  </div>
		</div>
	</div>
  </div>
</div>

<!-- <div style = "margin-bottom:50px"></div> -->