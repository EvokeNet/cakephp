<div class = "evoke comment-box">
	<div class = "evoke comment-box-delete"><a href = "<?php echo $this->Html->url(array('controller'=> 'comments', 'action' => 'delete', $c['Comment']['id'])); ?>"><i class="fa fa-times-circle fa-lg"></i></a></div>
	<div class="row">
	  <div class="small-6 large-2 columns evoke text-align">
	  	<img src="https://graph.facebook.com/<?php echo $c['User']['facebook_id']; ?>/picture?type=large" width="110px"/>
	  	<h4><?php echo (__('Agent ').$c['User']['name']); ?></h4>
		<h6><?php echo date('F j, Y', strtotime($c['Comment']['created'])); ?></h6>
	  </div>
	  <div class="small-6 large-10 columns">
	  	<p><?php echo $c['Comment']['content']; ?></p>
	  </div>
	</div>
</div>