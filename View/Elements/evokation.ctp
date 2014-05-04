<?php 
	$showFollowButton = true;
	if(!isset($mine)) {
		$follows = false;
		$follower = null;

		foreach ($evokationsFollowing as $following) {
			if($following['Evokation']['id'] == $e['Evokation']['id']){
				$follows = true;
				$follower = $following;
				break;
			}
		}
	} else {
		$showFollowButton = false;
	}
?>

<div class = "evoke evidence content-box">
	<a href = "<?php echo $this->Html->url(array('controller' => 'evokations', 'action' => 'view', $e['Evokation']['id']));?>">
		<div class="evoke row full-width-alternate">

		  <div class="small-3 medium-3 large-3 columns evoke text-align-end">

		  	<h5 class = "headings"><?= $e['Group']['title']?></h5>
		  	<h6 class = "headings"><?= date('F j, Y', strtotime($e['Evokation']['created'])) ?></h6>
		  </div>

		  <div class="small-2 medium-2 large-2 columns evoke text-align-center">

		  	<?php if($e['Group']['photo_dir'] == null) :?>
  				<img src="https://graph.facebook.com//picture?type=large"/>
	  		<?php else : ?>
					<img src="<?= $this->webroot.'files/attachment/attachment/'.$e['Group']['photo_dir'].'/thumb_'.$e['Group']['photo_attachment'] ?>" />
			<?php endif; ?>

		  </div>

		  <div class="small-7 medium-7 large-7 columns">
		  	<div>
		  		<h4 class = "headings"><?= $e['Evokation']['title']?></h4>
		  	</div>
		  </div>

		</div>
	</a>
</div>