<div class = "evoke evidence content-box">
	<a href = "<?php echo $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $e['Evidence']['id']));?>">
		<div class="evoke row full-width-alternate">

		  <div class="small-3 medium-3 large-3 columns evoke text-align-end">

		  	<?php foreach($missionIssues as $mi): 
				if($e['Mission']['id'] == $mi['Mission']['id']):?>
					<h5 class = "headings"><?= $mi['Issue']['name'] ?></h5>
			<?php break; endif; endforeach;?>

		  	<h5 class = "headings"><?= $e['User']['name']?></h5>
		  	<h6 class = "headings"><?= date('F j, Y', strtotime($e['Evidence']['created'])) ?></h6>
		  </div>

		  <div class="small-2 medium-2 large-2 columns">

		  	<?php if($e['User']['photo_attachment'] == null) : ?>
			  	<img src="https://graph.facebook.com/<?php echo $e['User']['facebook_id']; ?>/picture?type=large" width="90px"/>
			<?php else : ?>
			  	<img src="<?= $this->webroot.'files/attachment/attachment/'.$e['User']['photo_dir'].'/thumb_'.$e['User']['photo_attachment'] ?>" width="90px"/>
			<?php endif; ?>

		  </div>

		  <div class="small-7 medium-7 large-7 columns">
		  	<h4 class = "headings"><?= $e['Evidence']['title'] ?></h4>
		  </div>

		</div>
	</a>
</div>