<?php

$name = explode(' ', $c['User']['name']);
//echo $name[0];

?>

<!-- <div class = "evoke comment-box">
	<div class = "evoke comment-box-delete"><a href = "<?php echo $this->Html->url(array('controller'=> 'comments', 'action' => 'delete', $c['Comment']['id'])); ?>"><i class="fa fa-times-circle fa-lg"></i></a></div>
	<div class="row">
	  <div class="small-2 medium-2 large-2 columns evoke text-align">
	  	<img src="https://graph.facebook.com/<?php echo $c['User']['facebook_id']; ?>/picture?type=large" width="110px"/>
	  	<h4><?php echo (__('Agent ').$c['User']['name']); ?></h4>
		<h6><?php echo date('F j, Y', strtotime($c['Comment']['created'])); ?></h6>
	  </div>
	  <div class="small-10 medium-10 large-10 columns">
	  	<p><?php echo $c['Comment']['content']; ?></p>
	  </div>
	</div>
</div>

<div style = "margin-bottom:100px"></div> -->

<div class="row">
  <div class="small-2 medium-2 large-2 columns evoke text-align">
  	<img src="https://graph.facebook.com/<?php echo $c['User']['facebook_id']; ?>/picture?type=large" width="80px"/>
  	<h4 style = "font-size: 0.9vw;"><?php echo (__('Agent ').$name[0]); ?></h4>
	<h6 style = "font-size: 0.7vw;"><?php echo date('F j, Y', strtotime($c['Comment']['created'])); ?></h6>
  </div>
  <div class="small-10 medium-10 large-10 columns">
  	<div class = "evoke bubble">
  		<div class="row">
		  <div class="small-11 medium-11 large-11 columns">
		  	<p><?php echo $c['Comment']['content']; ?></p>
		  </div>
		  <div class="small-1 medium-1 large-1 columns">
		  	<div class = "evoke comment-box-delete"><a href = "<?php echo $this->Html->url(array('controller'=> 'comments', 'action' => 'delete', $c['Comment']['id'])); ?>"><i class="fa fa-times-circle fa-lg"></i></a></div>
		  </div>
		</div>
	</div>
  </div>
</div>

<!-- <div style = "margin-bottom:100px"></div> -->

<!-- <div class = "evoke bubble2">
<img src="https://graph.facebook.com/<?php echo $c['User']['facebook_id']; ?>/picture?type=large" width="60px"/>
<h4 style = "display:inline"><?php echo (__('Agent ').$c['User']['name']); ?> - <?php echo date('F j, Y', strtotime($c['Comment']['created'])); ?></h4>
</div>
<p><?php echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content']; ?></p>

<div style = "margin-bottom:100px"></div> -->

<!-- <div class = "evoke bubble2">
<img src="https://graph.facebook.com/<?php echo $c['User']['facebook_id']; ?>/picture?type=large" width="60px"/>
<h4 style = "display:inline"><?php echo (__('Agent ').$c['User']['name']); ?> - <?php echo date('F j, Y', strtotime($c['Comment']['created'])); ?></h4>
</div>
<p><?php echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content'];echo $c['Comment']['content']; ?></p> -->

<div style = "margin-bottom:100px"></div>