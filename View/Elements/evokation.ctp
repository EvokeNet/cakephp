<?php 

	echo $this->Html->css('follow_hover');

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
		<div class="evoke row full-width-alternate">

		  <div class="small-3 medium-3 large-3 columns evoke text-align-end">

		  	<div class="blue-btn">

			  <a class="first-link" href="">
			    <h5 class = "headings"><?= $e['Group']['title']?></h5>
		  		<h6 class = "headings"><?= date('F j, Y', strtotime($e['Evokation']['created'])) ?></h6>
			  </a>

			  <a href="">
			    <?php if($showFollowButton) : ?>
			  		<?php if($follows) : ?>
			  			<div class = "evoke evokation follow" style = "margin-left: 10px;">
			  			<div style = "margin-bottom: -20px; font-size: 1.0vw;"><i class="fa fa-comment-o fa-horizontal"></i>&nbsp;&nbsp;<?= count($e['Comment']) ?></div>
			  			<a href = "<?php echo $this->Html->url(array('controller' => 'evokationFollowers', 'action' => 'delete', $follower['EvokationFollower']['id'])); ?>" class = "evoke button general" style = "font-size: 0.8vw"><?php echo __('Unfollow');?></a></div>
			  		<?php else : ?>
			  			<div class = "evoke evokation follow" style = "margin-left: 10px;">
			  			<div style = "margin-bottom: -20px; font-size: 1.0vw;"><i class="fa fa-comment-o fa-horizontal"></i>&nbsp;&nbsp;<?= count($e['Comment']) ?></div>
			  			<a href = "<?php echo $this->Html->url(array('controller' => 'evokationFollowers', 'action' => 'add', $e['Evokation']['id'], $users['User']['id'])); ?>" class = "evoke button general" style = "font-size: 0.8vw"><?php echo __('Follow');?></a></div>
			  		<?php endif; ?>
			  	<?php else: ?>

			  		<div class = "evoke evokation follow" style = "margin-left: 10px;">
			  		<div style = "margin-bottom: -20px; font-size: 1.0vw;"><i class="fa fa-comment-o fa-horizontal"></i>&nbsp;&nbsp;<?= count($e['Comment']) ?></div>
			  		<a href = "<?php echo $this->Html->url(array('controller' => 'groupsUsers', 'action' => 'edit', $e['Group']['id'])); ?>" class = "evoke button general" style = "font-size: 0.8vw"><?php echo __('GO TO PROJECT');?></a></div>
			  	<?php endif; ?>
			  </a>

			</div>
		  	
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
		  		<a href = "<?php echo $this->Html->url(array('controller' => 'evokations', 'action' => 'view', $e['Evokation']['id']));?>"><h4 class = "headings"><?= $e['Evokation']['title']?></h4></a>
		  	</div>
		  </div>

		</div>
</div>