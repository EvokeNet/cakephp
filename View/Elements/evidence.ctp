<div class = "evoke evidence content-box">
	<a href = "<?php echo $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $e['Evidence']['id']));?>">
		<div class="evoke row full-width-alternate">

		  <div class="small-3 medium-3 large-3 columns evoke text-align-end">

		  	<h5 class = "headings"><?= $e['User']['name']?></h5>
		  	<h6 class = "headings"><?= date('F j, Y', strtotime($e['Evidence']['created'])) ?></h6>
		  </div>

		  <div class="small-2 medium-2 large-2 columns evoke text-align-center">

		  	<?php if($e['User']['photo_attachment'] == null) : ?>
			  	<img src="https://graph.facebook.com/<?php echo $e['User']['facebook_id']; ?>/picture?type=large" style = "height:5vw"/>
			<?php else : ?>
			  	<img src="<?= $this->webroot.'files/attachment/attachment/'.$e['User']['photo_dir'].'/thumb_'.$e['User']['photo_attachment'] ?>" style = "height:5vw"/>
			<?php endif; ?>

		  </div>

		  <div class="small-7 medium-7 large-7 columns">
		  	<div>
		  		<h4 class = "headings"><?= $e['Evidence']['title'] ?></h4>
		  	</div>
		  </div>

		</div>
	</a>
</div>