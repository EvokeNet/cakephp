<?php 
	$mtitle = $e['Mission']['title'];
	$ptitle = $e['Phase']['name'];
	$qtitle = $e['Quest']['title'];

	if($lang == 'es'){
		if(!empty($e['Mission']['title_es']))
			$mtitle = $e['Mission']['title_es'];
		if(!empty($e['Phase']['name_es']))
			$ptitle = $e['Phase']['name_es'];
		if(!empty($e['Quest']['title_es']))
			$qtitle = $e['Quest']['title_es'];
	}
?>

<div class='evoke evidence content-box'>
	<a href='<?php echo $this->Html->url(array("controller" => 'evidences', 'action' => 'view', $e['Evidence']['id']));?>'>
		<div class='evoke row full-width-alternate'>

		  <div class='small-3 medium-3 large-3 columns evoke text-align-end'>

		  	<h5 class='headings'><?= $e['User']['name']?></h5>
		  	<h6 class='headings'><?= date('F j, Y', strtotime($e['Evidence']['created']))?></h6><br>

		  	<?php if($e['Mission']['basic_training'] == 1): ?>
		  		<h6 class='headings'><?= $mtitle ?></h6>
		  	<?php else: ?>
		  		<h6 class='headings'><?= $mtitle ?>&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>&nbsp;&nbsp;<?= $ptitle ?>&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>&nbsp;&nbsp;<?= $qtitle ?></h6>
		  	<?php endif; ?>
		  </div>

		  <div class='small-2 medium-2 large-2 columns evoke text-align-center'>

		  	<?php if($e['User']['photo_attachment'] == null) : ?>
			  	<?php if($e['User']['facebook_id'] == null) : ?>
					<!-- <img src="<?= $this->webroot.'img/user_avatar.jpg' ?>"  style = "height:5vw"/> -->
					<?php $pic = $this->webroot.'img/user_avatar.jpg';?>
				<?php else : ?>	
					<!-- <img src="https://graph.facebook.com/<?php echo $e['User']['facebook_id']; ?>/picture?type=large" style = "height:5vw"/> -->
					<?php $pic = "https://graph.facebook.com/". $e['User']['facebook_id'] . "/picture?type=large";?>
				<?php endif; ?>
			<?php else : ?>
			  	<!-- <img src="<?= $this->webroot.'files/attachment/attachment/'.$e['User']['photo_dir'].'/thumb_'.$e['User']['photo_attachment'] ?>" style = "height:5vw"/> -->
			  	<?php $pic = $this->webroot.'files/attachment/attachment/'.$e['User']['photo_dir'].'/'.$e['User']['photo_attachment']; ?>
			<?php endif; ?>
			<div style="min-width: 5vw; min-height: 5vw; background-image: url(<?=$pic?>); background-position:center; background-size: 100% Auto;"></div>
		  </div>

		  <div class='small-7 medium-7 large-7 columns'>
		  	<div>
		  		<h4 class='headings'><?= $e['Evidence']['title'] ?></h4>
		  	</div>
		  </div>

		</div>
	</a>
</div>