<a href = "<?php echo $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $e['Evidence']['id']));?>">
	<div class="row evoke evidence blue-box">
		<div class="small-2 medium-2 large-2 columns">
	  		<div class = "evoke text-align">
	  			
	  			<?php if($e['User']['photo_attachment'] == null) : ?>
				  	<img src="https://graph.facebook.com/<?php echo $e['User']['facebook_id']; ?>/picture?type=large" width="90px"/>
				<?php else : ?>
				  	<img src="<?= $this->webroot.'files/attachment/attachment/'.$e['User']['photo_dir'].'/thumb_'.$e['User']['photo_attachment'] ?>" width="90px"/>
				<?php endif; ?>
				<h6><?= $e['User']['name']?></h6>
  			</div>
		</div>

		<div class="small-6 medium-6 large-7 columns">
			<h1><?= $e['Evidence']['title']?></h1>
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
</a>
