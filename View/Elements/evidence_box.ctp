<div class="row evoke evidence blue-box">
	<div class="small-2 medium-2 large-2 columns">
  		<div class = "evoke text-align">
  			<img src="https://graph.facebook.com/<?php echo $e['User']['facebook_id']; ?>/picture?type=large" width="90px"/>
  			<!-- <h6><?php echo $this->Html->link($e['User']['name'], array('controller' => 'users', 'action' => 'dashboard', $e['User']['id']));?></h6> -->

  			<a href = "<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $e['User']['id']));?>">
			<h6><?= $e['User']['name']?></h6>
			</a>
  		</div>
	</div>

	<div class="small-6 medium-6 large-7 columns">
		<!-- <h1><?php echo $this->Html->link($e['Evidence']['title'], array('controller' => 'evidences', 'action' => 'view', $e['Evidence']['id']));?></h1> -->

		<a href = "<?php echo $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $e['Evidence']['id']));?>">
		<h1><?= $e['Evidence']['title']?></h1>
		</a>
	</div>

	<div class="small-4 medium-4 large-3 columns padding">
		<div>
			<?php foreach($missionIssues as $mi): 
			if($e['Mission']['id'] == $mi['Mission']['id']):?>

			<ul>
				<li><i class="fa fa-comment-o fa-horizontal fa-lg"></i>&nbsp;&nbsp;<h5><?= count($e['Comment']) ?></h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-heart-o fa-lg"></i>&nbsp;&nbsp;<h5><?= count($e['Like']) ?></h5></li>
				<li><h6><?= $mi['Issue']['name'] ?></h6></li>
				<li><h6><?= date('F j, Y', strtotime($e['Evidence']['created'])) ?></h6></li>
			</ul>
			
		<?php break; endif; endforeach;?>
		</div>
	</div>	
</div>