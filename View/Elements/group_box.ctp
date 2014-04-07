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
		<h4><?= $e['Group']['description']?></h4>
	</div>

	<div class="medium-2 columns">
		<div class = "evoke text-align">
			<div class = "evoke evidence-icons social">
				<i class="fa fa-facebook-square fa-lg"></i>&nbsp;
				<i class="fa fa-google-plus-square fa-lg"></i>&nbsp;
				<i class="fa fa-twitter-square fa-lg"></i>
			</div>

			<a href="#" data-reveal-id="myModal" data-reveal class = "button general green"><?= __('Send request to join')?></a>

		</div>
	</div>	
</div>

<div id="myModal" class="reveal-modal" data-reveal style = "background-color: #bc5660; border: 5px solid #000">
  <h2><?= __("Message below will be sent to owner's group")?></h2>
  <p class="lead"></p>
  <p></p>

  <!-- <table style = "background-color: #283954; padding:20px; border-spacing: 0px;"> -->
	<div class = "screen-box" style = "padding:20px 30px">

	  <h1 style = "font-size:2.0em; color:#fff; font-weight:bold; font-family: 'AlegreyaRegular';"><?php echo sprintf(__('Hi %s', $user['User']['name']));?></h1>
	  <h2 style = "font-size:1.5em; color:#fff; font-weight:bold; font-family: 'AlegreyaRegular';"><?php echo sprintf(__('You have one invite request for your group %s'), $e['Group']['title']);?></h2>

	  <div style = "background-color:#fff; min-height: 200px; padding: 20px; border-radius: 10px; border: 2px solid #000; ">
	    <div style = "position:relative; float:left"><img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large" style = "max-height:150px"/></div>
	    <div style = "margin-left: 160px;">
	      <ul style = "list-style:none; font-family: 'AlegreyaRegular'; margin-left:50px">
	        <li style = "font-family: 'AlegreyaRegular"><?php echo $user['User']['name'];?></li>
	        <li style = "font-family: 'AlegreyaRegular"><?php echo $user['User']['email'];?></li>
	        <li style = "font-family: 'AlegreyaRegular"><?php echo $user['User']['birthdate'];?></li>
	        <li style = "font-family: 'AlegreyaRegular"><?php echo $user['User']['biography'];?></li>
	      </ul>
	    </div>
	  </div>

	  <button class = "evoke button general green" style = "margin-top:30px"><?php echo __('Accept User');?></a></button>

	  <button class = "evoke button general red" style = "margin-top:30px"><?php echo __('Decline User');?></button>
	</div>

	<a href = "<?php echo $this->Html->url(array('controller' => 'groupsUsers', 'action' => 'send', $user['User']['id'], $e['Group']['id'])); ?>" class = "button general green"><?php echo __('Send request to join');?></a>

  <a class="close-reveal-modal">&#215;</a>
</div>