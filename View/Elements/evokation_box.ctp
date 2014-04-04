<div class="row evoke evokation-box adjust-row">
	<div class="medium-1 columns">
  		<div class = "evoke dashboard text-align">
  			<img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large" width="110px"/>

  			<a href = "<?php echo $this->Html->url(array('controller' => 'groups', 'action' => 'view', $e['Group']['id']));?>">
			<h6><?= $e['Group']['title']?></h6>
			</a>

			</div>
		</div>
	<div class="medium-9 columns">

		<a href = "<?php echo $this->Html->url(array('controller' => 'evokations', 'action' => 'view', $e['Evokation']['id']));?>">
		<h1><?= $e['Evokation']['title']?></h1>
		</a>

	</div>

	<div class="medium-2 columns">
		<div>
			<ul>
		  		<li><i class="fa fa-comment-o fa-horizontal fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-heart-o fa-2x"></i>&nbsp;</li>
		  		<li><div class = "evoke evokation follow"><a href = "<?php echo $this->Html->url(array('controller' => 'evokationFollowers', 'action' => 'add', $e['Evokation']['id'], $users['User']['id'])); ?>" class = "evoke button general"><?php echo __('Follow');?></a></div></li>
			</ul>
		</div>
	</div>	
</div>