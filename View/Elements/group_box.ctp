<div class="row evoke evokation-red-box">
	<div class="medium-2 columns">
  		<div class = "evoke dashboard text-align">
  			<img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large" width="110px"/>

  			<a href = "<?php echo $this->Html->url(array('controller' => 'groups', 'action' => 'view', $e['Group']['id']));?>">
			<h6><?= $e['Group']['created']?></h6>
			</a>

			</div>
		</div>
	<div class="medium-8 columns">
		<h1><?= $e['Group']['title']?></h1>
	</div>

	<div class="medium-2 columns">
		<div class = "evoke text-align">
			<div class = "evoke evidence-icons social">
				<i class="fa fa-facebook-square fa-lg"></i>&nbsp;
				<i class="fa fa-google-plus-square fa-lg"></i>&nbsp;
				<i class="fa fa-twitter-square fa-lg"></i>
			</div>
			<a href = "<?php echo $this->Html->url(array('controller' => 'groupsUsers', 'action' => 'send', $user['User']['id'], $e['Group']['id'])); ?>" class = "button general green"><?php echo __('Send request to join');?></a>
		</div>
	</div>	
</div>