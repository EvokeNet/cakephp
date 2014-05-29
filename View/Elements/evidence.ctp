<div class='evoke evidence content-box'>
	<a href='<?php echo $this->Html->url(array("controller" => 'evidences', 'action' => 'view', $e['Evidence']['id']));?>'>
		<div class='evoke row full-width-alternate'>

		  <div class='small-3 medium-3 large-3 columns evoke text-align-end'>

		  	<h5 class='headings'><?= $e['User']['name']?></h5>
		  	<h6 class='headings'><?= date('F j, Y', strtotime($e['Evidence']['created']))?></h6><br>

		  	<?php if($e['Mission']['basic_training'] == 1): ?>
		  		<h6 class='headings'><?= $e['Mission']['title'] ?></h6>
		  	<?php else: ?>
		  		<h6 class='headings'><?= $e['Mission']['title'] ?>&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>&nbsp;&nbsp;<?= $e['Phase']['name'] ?>&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>&nbsp;&nbsp;<?= $e['Quest']['title'] ?></h6>
		  	<?php endif; ?>
		  </div>

		  <div class='small-2 medium-2 large-2 columns evoke text-align-center'>

		  	<?php if($e['User']['photo_attachment'] == null) : ?>
			  	<?php if($e['User']['facebook_id'] == null) : ?>
					<img src="<?= $this->webroot.'img/user_avatar.jpg' ?>"  style = "height:5vw"/>
				<?php else : ?>	
					<img src="https://graph.facebook.com/<?php echo $e['User']['facebook_id']; ?>/picture?type=large" style = "height:5vw"/>
				<?php endif; ?>
			<?php else : ?>
			  	<img src="<?= $this->webroot.'files/attachment/attachment/'.$e['User']['photo_dir'].'/thumb_'.$e['User']['photo_attachment'] ?>" style = "height:5vw"/>
			<?php endif; ?>

		  </div>

		  <div class='small-7 medium-7 large-7 columns'>
		  	<div>
		  		<h4 class='headings'><?= $e['Evidence']['title'] ?></h4>
		  	</div>
		  </div>

		</div>
	</a>
</div>