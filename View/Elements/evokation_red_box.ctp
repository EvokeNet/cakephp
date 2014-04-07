<div class="row evoke evokation-red-box">
	<div class="medium-2 columns">
  		<div class = "evoke dashboard text-align">
  			<img src="https://graph.facebook.com/<?php echo $e['User']['facebook_id']; ?>/picture?type=large" width="110px"/>

  			<a href = "<?php echo $this->Html->url(array('controller' => 'groups', 'action' => 'view', $e['Group']['id']));?>">
			<h6><?= $e['Group']['title']?></h6>
			</a>

		</div>
	</div>
	<div class="medium-8 columns">

		<a href = "<?php echo $this->Html->url(array('controller' => 'evokations', 'action' => 'view', $e['Evokation']['id']));?>">
		<h1><?= $e['Evokation']['title']?></h1>
		</a>

	</div>

	<div class="medium-2 columns">
		<div class = "evoke text-align">
			<div class = "evoke evidence-icons social">
				<i class="fa fa-facebook-square fa-lg"></i>&nbsp;
				<i class="fa fa-google-plus-square fa-lg"></i>&nbsp;
				<i class="fa fa-twitter-square fa-lg"></i>
			</div>
			<a href = "<?php echo $this->Html->url(array('controller' => 'evokations', 'action' => 'view', $e['Evokation']['id']));?>" class = "evoke button general green"><?php echo __('View this project');?></a>
		</div>
	</div>	
</div>