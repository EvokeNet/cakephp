<div class="row evoke evokation-red-box">
	<div class="small-2 medium-2 large-2 columns margin bottom-1">
  		<div class = "evoke dashboard text-align">
  			<!-- <img src="https://graph.facebook.com/<?php echo $e['User']['facebook_id']; ?>/picture?type=large" width="110px"/> -->

  			<a href = "<?php echo $this->Html->url(array('controller' => 'groups', 'action' => 'view', $e['Group']['id']));?>">
  				<?php if($e['Group']['photo_dir'] == null) :?>
  					<!-- <img src="https://graph.facebook.com//picture?type=large"/> -->
  					<?php $pic = $this->webroot.'img/user_avatar.jpg';?>
	  			<?php else : ?>
					<!-- <img src="<?= $this->webroot.'files/attachment/attachment/'.$e['Group']['photo_dir'].'/thumb_'.$e['Group']['photo_attachment'] ?>" /> -->
					<?php $pic = $this->webroot.'files/attachment/attachment/'.$e['Group']['photo_dir'].'/'.$e['Group']['photo_attachment'];?>
			  	<?php endif; ?>
			  	<div style="min-width: 5vw; min-height: 5vw; background-image: url(<?=$pic?>); background-position:center; background-size: 100% Auto;"></div>
				<!-- <h6><?= $e['Group']['created']?></h6> -->
			</a>

			</div>
		</div>
	
	<div class="small-7 medium-7 large-7 columns">

		<a href = "<?php echo $this->Html->url(array('controller' => 'evokations', 'action' => 'view', $e['Evokation']['id']));?>">
		
			<h1><?= $e['Evokation']['title']?></h1>
			<!-- <h5><?= $e['Group']['description']?></h5> -->

		</a>

	</div>

	<div class="small-3 medium-3 large-3 columns">
		<div class = "evoke text-align">
			<div class = "evoke evidence-icons social margin bottom-1 top">
				<i class="fa fa-facebook-square fa-lg"></i>&nbsp;
				<i class="fa fa-google-plus-square fa-lg"></i>&nbsp;
				<i class="fa fa-twitter-square fa-lg"></i>
			</div>
			<?php 
				$count_members = array();
				$member = false;
				if($e['Group']['user_id'] == $user['User']['id']) {
					$member = true;
				} else {
					foreach ($users as $u) {
						if($u['GroupsUser']['group_id'] == $e['Group']['id']) {
							if(isset($count_members[$e['Group']['id']]))
								$count_members[$e['Group']['id']]++;
							else
								$count_members[$e['Group']['id']] = 2;
							if($u['GroupsUser']['user_id'] == $user['User']['id']) {
								$member = true;
								break;
							}
						}
					}
				}

				if(!$member):?>
					<div style = "color: #20c475; font-size: 1.1vw; line-height: 1.5em; display: inline; font-family: 'AlegreyaRegular';"><?= __('Not a Member') ?>
					</div>
				<?php elseif($member && $e['Group']['user_id'] == $user['User']['id']): ?>
					<div style = "color: #20c475; font-size: 1.1vw; line-height: 1.5em; display: inline; font-family: 'AlegreyaRegular';">
						<i class="fa fa-check"></i>&nbsp;&nbsp;<?= __('Owner') ?>
					</div>
				<?php elseif($member && $e['Group']['user_id'] != $user['User']['id']): ?>
					<div style = "color: #20c475; font-size: 1.1vw; line-height: 1.5em; display: inline; font-family: 'AlegreyaRegular';">
						<i class="fa fa-check"></i>&nbsp;&nbsp;<?= __('Member') ?>
					</div>
				<?php endif; ?>

		</div>
	</div>	
</div>

<div id="<?= $e['Group']['id']?>" class="reveal-modal" data-reveal style = "background-color: #bc5660; border: 5px solid #000">
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