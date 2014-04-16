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
<div class="row evoke evokation-box">
	<div class="small-2 medium-2 large-2 columns">
  		<div class = "evoke dashboard text-align">
  			<!-- <img src="https://graph.facebook.com/<?php echo $e['User']['facebook_id']; ?>/picture?type=large" width="110px"/> -->

  			<a href = "<?php echo $this->Html->url(array('controller' => 'groups', 'action' => 'view', $e['Group']['id']));?>">
			<h6><?= $e['Group']['title']?></h6>
			</a>

			</div>
		</div>
	
	<div class="small-6 medium-6 large-7 columns">

		<a href = "<?php echo $this->Html->url(array('controller' => 'evokations', 'action' => 'view', $e['Evokation']['id']));?>">
		<h1><?= $e['Evokation']['title']?></h1>
		</a>

	</div>

	<div class="small-4 medium-4 large-3 columns padding">
		<div>
			<ul>
		  		<li><i class="fa fa-comment-o fa-horizontal fa-lg"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-heart-o fa-lg"></i>&nbsp;</li>
			  	<?php if($showFollowButton) : ?>
			  		<?php if($follows) : ?>
			  			<li><div class = "evoke evokation follow"><a href = "<?php echo $this->Html->url(array('controller' => 'evokationFollowers', 'action' => 'delete', $follower['EvokationFollower']['id'])); ?>" class = "evoke button general"><?php echo __('Unfollow');?></a></div></li>
			  		<?php else : ?>
			  			<li><div class = "evoke evokation follow"><a href = "<?php echo $this->Html->url(array('controller' => 'evokationFollowers', 'action' => 'add', $e['Evokation']['id'], $users['User']['id'])); ?>" class = "evoke button general"><?php echo __('Follow');?></a></div></li>
			  		<?php endif; ?>
			  	<?php else: ?>
			  		<li><div class = "evoke evokation follow"><a href = "<?php echo $this->Html->url(array('controller' => 'groupsUsers', 'action' => 'edit', $e['Group']['id'])); ?>" class = "evoke button general"><?php echo __('GO TO PROJECT');?></a></div></li>
			  	<?php endif; ?>
			</ul>
		</div>
	</div>	
</div>