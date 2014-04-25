<a href = "<?php echo $this->Html->url(array('controller' => 'evokations', 'action' => 'view', $e['Evokation']['id']));?>">
	<div class="row evoke evokation-red-box">
		<div class="small-2 medium-2 large-2 columns">
	  		<div class = "evoke dashboard text-align">
	  			<h6><?= $e['Group']['title']?></h6>
			</div>
		</div>
		<div class="small-8 medium-8 large-8 columns">
			<h1><?= $e['Evokation']['title']?></h1>
		</div>

		<div class="small-2 medium-2 large-2 columns">
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
</a>