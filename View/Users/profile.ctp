<?php

	echo $this->Html->css('mycarousel');

	echo $this->Html->css('/components/tinyscrollbar/examples/responsive/tinyscrollbar');

	// echo $this->Html->css('breadcrumb');

	$this->extend('/Common/topbar');
	$this->start('menu');

	$name = explode(' ', $users['User']['name']);

	echo $this->element('header', array('user' => $users));

	$this->end(); 
?>

<section class="evoke default-background">

	<div class="evoke default row full-width-alternate profile">

	  <div class="small-2 medium-2 large-2 columns padding-left">
	  	<?php echo $this->element('menu', array('user' => $users));?>
	  </div>

	  <div class="small-10 medium-10 large-10 columns maincolumn">

	  	<?php echo $this->Session->flash(); ?>
	  	
	  <div class = "tint">
	  	<div class="row margin-left-0 margin-right-0 padding top-1">
		  <div class="small-4 medium-4 large-4 columns padding bottom-2">

		  	<h3 class = "margin bottom-1"><?= strtoupper(__('Agent')) ?></h3>

		  	<div class = "tag">
		  		<img src='<?= $this->webroot.'img/chip105.png' ?>' width = "100%"/>

		  		<div class="row">
					  <div class="small-4 medium-4 large-4 columns profile pic no-right-padding">
					  	<a href = "#">
					  		<?php if($user['User']['photo_attachment'] == null) : ?>
								<?php if($user['User']['facebook_id'] == null) : ?>
									<div class = "icon"><img src="<?= $this->webroot.'img/user_avatar.jpg' ?>"/></div>
								<?php else : ?>	
									<div class = "icon"><img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large"/></div>
								<?php endif; ?>
							<?php else : ?>
								<div class = "icon"><img src="<?= $this->webroot.'files/attachment/attachment/'.$user['User']['photo_dir'].'/'.$user['User']['photo_attachment'] ?>"/></div>
							<?php endif; ?>
					  	</a>
					  </div>
					  <div class="small-8 medium-8 large-8 columns info margin bottom-1">
						
							<h6><?php echo strtoupper(__("Evoke Agent"));?></h6>
							<h4><?php echo $user['User']['name']; ?></h4>
							<h5><?php echo __('Level');?>&nbsp;&nbsp;&nbsp;<span><?= $level ?></span></h5>
							<div class="evoke progress small-9 large-9 round">
							  <span class="meter" style="width: <?= $percentage ?>%"></span>
							</div>

							<h5><?php echo __('Points');?>&nbsp;&nbsp;<span><?= $sumPoints ?></span></h5>
						
					  </div>
				</div>

				<div class = "text-align-end">
					<?php if((!$is_friend) && ($user['User']['id'] != $users['User']['id'])):?>
						<a href = "<?php echo $this->Html->url(array('controller' => 'userFriends', 'action' => 'add', $users['User']['id'], $user['User']['id'])); ?>" class = "info button general"><?php echo __('Follow this agent');?></a>
					<?php else: 
						if($user['User']['id'] != $users['User']['id']){ ?>
						<a href = "<?php echo $this->Html->url(array('controller' => 'userFriends', 'action' => 'delete', $is_friend['UserFriend']['id'])); ?>" class = "info button general"><?php echo __('Unfollow this agent');?></a>
					<?php } endif; ?>
				</div>

		  	</div>

		  </div>
		  <div class="small-4 medium-4 large-4 columns">

		  	<div class="row">
			  <div class="large-6 columns"><h3 class = "margin bottom-1"><?= strtoupper(__('Badges')) ?></h3></div>
			  <div class="large-6 columns text-align-end"><a href = "<?php echo $this->Html->url(array('controller' => 'badges', 'action' => 'index')); ?>" class = "info button general"><?php echo __('See All');?></a></div>
			</div>

		  	<ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4">

				<?php foreach($badges as $badge): 
					if(isset($badge['Badge']['img_dir'])) : ?>
						<li><img src = '<?= $this->webroot.'files/attachment/attachment/'.$badge['Badge']['img_dir'].'/'.$badge['Badge']['img_attachment'] ?>'></li>
					<?php else: ?>
						<li><img src = '<?= $this->webroot.'img/badge4.png' ?>'></li>
					<?php endif ?>
				<?php endforeach;?>

			</ul>
		  </div>
		  <div class="small-4 medium-4 large-4 columns">

		  	<div class="row">
			  <div class="large-6 columns"><h3 class = "margin bottom-1"><?= strtoupper(__('Following')) ?>&nbsp;&nbsp;(<?= count($allies) ?>)</h3></div>
			  <div class="large-6 columns text-align-end"><a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'allies', $user['User']['id'])) ?>" class = "info button general"><?php echo __('See All');?></a></div>
			</div>

		  	<ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4">
				<?php 
					$k = 0;
					foreach($allies as $ally):
						$k++;
						if($k > 4) break;
						$name = explode(' ', $ally['User']['name']); ?>
						<li>
							<a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'profile', $ally['User']['id'])) ?>">
								
								<?php if($ally['User']['photo_attachment'] == null) : ?>
									<?php if($ally['User']['facebook_id'] == null) : ?>
										<div class = "profile icon"><img src="<?= $this->webroot.'img/user_avatar.jpg' ?>"/></div>
									<?php else : ?>	
										<div class = "profile icon"><img src="https://graph.facebook.com/<?php echo $ally['User']['facebook_id']; ?>/picture?type=large"/></div>
									<?php endif; ?>
								<?php else : ?>
									<div class = "profile icon"><img src="<?= $this->webroot.'files/attachment/attachment/'.$ally['User']['photo_dir'].'/'.$ally['User']['photo_attachment'] ?>"/></div>
								<?php endif; ?>
								
								<span><?= $name[0] ?></span>
							</a>
						</li>
			  	<?php endforeach;?>
			</ul>

			<div class="row">
			  <div class="large-6 columns"><h3 class = "margin bottom-1"><?= strtoupper(__('Followers')) ?>&nbsp;&nbsp;(<?= count($followers) ?>)</h3></div>
			  <div class="large-6 columns text-align-end"><a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'allies', $user['User']['id'])) ?>" class = "info button general"><?php echo __('See All');?></a></div>
			</div>

		  	<ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4">
				<?php 
					$k = 0;
					foreach($followers as $ally):
						$k++;
						if($k > 4) break;
						$name = explode(' ', $ally['User']['name']); ?>
						<li>
							<a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'profile', $ally['User']['id'])) ?>">
								
								<?php if($ally['User']['photo_attachment'] == null) : ?>
									<?php if($ally['User']['facebook_id'] == null) : ?>
										<div class = "profile icon"><img src="<?= $this->webroot.'img/user_avatar.jpg' ?>"/></div>
									<?php else : ?>	
										<div class = "profile icon"><img src="https://graph.facebook.com/<?php echo $ally['User']['facebook_id']; ?>/picture?type=large"/></div>
									<?php endif; ?>
								<?php else : ?>
									<div class = "profile icon"><img src="<?= $this->webroot.'files/attachment/attachment/'.$ally['User']['photo_dir'].'/'.$ally['User']['photo_attachment'] ?>"/></div>
								<?php endif; ?>
								
								<span><?= $name[0] ?></span>
							</a>
						</li>
			  	<?php endforeach;?>
			</ul>

			<!-- <div id="myModalAllies" class="reveal-modal small evoke lightbox" data-reveal>
			  <h2><?= __('Allies') ?></h2>

			  	<ul class="small-block-grid-1 medium-block-grid-1 large-block-grid-1">
			  	<?php foreach($allies as $ally):?>
					<li>
						<a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'profile', $ally['User']['id'])) ?>">

			  				<?php if($ally['User']['photo_attachment'] == null) : ?>
								<?php if($ally['User']['facebook_id'] == null) : ?>
									<img src="<?= $this->webroot.'img/user_avatar.jpg' ?>"/>
								<?php else : ?>	
									<img src="https://graph.facebook.com/<?php echo $ally['User']['facebook_id']; ?>/picture?type=large"/>
								<?php endif; ?>
							<?php else : ?>
								<img src="<?= $this->webroot.'files/attachment/attachment/'.$ally['User']['photo_dir'].'/'.$ally['User']['photo_attachment'] ?>"/>
							<?php endif; ?>
							
							<span><?= $ally['User']['name'] ?></span>
						</a>
					</li>
				<?php endforeach;?>
				</ul>
			  <a class="close-reveal-modal">&#215;</a>
			</div> -->

		  </div>
		</div>
		</div>

		<div class="row full-width-alternate margin-left-0 margin-right-0">
		  	<div class="small-6 medium-6 large-6 columns padding top-2 group">
		  		<h3 class = "margin bottom-1"><?= strtoupper(__("Project Stream")) ?></h3>
		  		<div class="evoke content-block default">
			  		<?php 
			  			$lastEvokation = null;
			  			foreach($myevokations as $e):
			  				$showFollowButton = true;
				    		foreach($viewerEvokation as $my) :
				    			if(array_search($my['Evokation']['id'], $e['Evokation'])) {
				    				$showFollowButton = false;
				    				break;
				    			}
				    		endforeach;

				    		if($showFollowButton) 
				    			echo $this->element('evokation', array('e' => $e, 'evokationsFollowing' => $evokationsFollowing));
				    		else
				    			echo $this->element('evokation', array('e' => $e, 'mine' => true));
		    				$lastEvokation = $e['Evokation']['id'];
    			
			    		endforeach;

			    		// foreach($myevokations as $e):
			    		// 	echo $this->element('evokation', array('e' => $e, 'mine' => true));
			    		// endforeach;

			    		
			    	?>
			    	<meta name="lastEvokation" content="<?php echo $lastEvokation; ?>">
			    	<div id="targetEvokation"></div>
		    	</div>
		  	</div>
		  <div class="small-6 medium-6 large-6 columns padding top-2">

		  	<h3 class = "margin bottom-1"> <?= strtoupper(__('Evidence Stream')) ?> </h3>

		  	<div class="evoke content-block default"> <!--tabs-content-->
			    	<?php 
			    		$lastEvidence = null;
			    		//Lists all projects and evidences
			    		foreach($myevidences as $e): 
		    				echo $this->element('evidence', array('e' => $e)); 
	    					$lastEvidence = $e['Evidence']['id'];

			    		endforeach; 
					?>
					<meta name="lastEvidence" content="<?php echo $lastEvidence; ?>">
					<div id="target"></div>
			  </div>
			
		  </div>
		</div>

	  </div>

	  <!-- <div class="medium-1 end columns"></div> -->

	</div>

</section>

<?php
	echo $this->Html->script('/components/jquery/jquery.min.js');//, array('inline' => false)); 
	echo $this->Html->script('reveal_modal', array('inline' => false));
	echo $this->Html->script('mycarousel', array('inline' => false));
	echo $this->Html->script('menu_height', array('inline' => false));
	echo $this->Html->script('reveal_modal', array('inline' => false));
?>

<script type="text/javascript" charset="utf-8">
	$(document).ready( function() {});

	var last = $('meta[name=lastEvidence]').attr('content');
	var lastEvokation = $('meta[name=lastEvokation]').attr('content');
	var olderContent = 5;
	var evidence = true;
	var lastLocal = last;
	var method = 'moreEvidences';
	var target = '#target';

	//checking scrolling info to call ajax function
	$(window).scroll(throttle(function() {   
		if($(window).scrollTop() + $(window).height() < ($(document).height() - $(target + ":last-child").height() + 200)) {
			// alert(lastLocal);
			if((lastLocal) != "")
				fillExtraContent();
			// menuHeight();
		}
	}, 1500));
	
	function throttle(fn, threshhold, scope) {
	  	threshhold || (threshhold = 250);
	  	var last,
	    	deferTimer;
	  	return function () {
	    	var context = scope || this;

	    	var now = +new Date,
	    	    args = arguments;
	    	if (last && now < last + threshhold) {
	    	  // hold on to it
	    		clearTimeout(deferTimer);
	    		deferTimer = setTimeout(function () {
	    	    	last = now;
	        		fn.apply(context, args);
	      		}, threshhold);
	    	} else {
	    		last = now;
	      		fn.apply(context, args);
	    	}
	  	};
	}


	function fillExtraContent(){
		// alert("hello");
		$.ajax({
		    type: 'get',
		    url: getCorrectURL(method)+"/"+lastLocal+"/"+olderContent + "/<?=$user['User']['id']?>",
		    //"<?php echo $this->Html->url(array('action' => 'moreEvidences', $lastEvidence)); ?>",
		    beforeSend: function(xhr) {
		        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		    },
		    success: function(response) {
		        var responseLast = response.substring(response.search("lastBegin") + 9, response.search("lastEnd"));

				lastLocal = responseLast;
								        
		        if(evidence) {
					last = lastLocal;
				} else {
					lastEvokation = lastLocal;
				}
		        response = response.substring(response.search("lastEnd")+7);
			        
		        // console.log(response);	
		        $(target).append((response));
		    },
		    error: function(e) {
		        console.log(e);
		    }
		});

		lastLocal = lastEvokation;
		method = 'moreEvokations';
		target = '#targetEvokation';

		$.ajax({
		    type: 'get',
		    url: getCorrectURL(method)+"/"+lastLocal+"/"+olderContent + "/<?=$user['User']['id']?>",
		    //"<?php echo $this->Html->url(array('action' => 'moreEvidences', $lastEvidence)); ?>",
		    beforeSend: function(xhr) {
		        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		    },
		    success: function(response) {
		        var responseLast = response.substring(response.search("lastBegin") + 9, response.search("lastEnd"));

				lastLocal = responseLast;
								        
		        if(evidence) {
					last = lastLocal;
				} else {
					lastEvokation = lastLocal;
				}
		        response = response.substring(response.search("lastEnd")+7);
			        
		        // console.log(response);	
		        $(target).append((response));
		    },
		    error: function(e) {
		        console.log(e);
		    }
		});

		lastLocal = last;
		method = 'moreEvidences';
		target = '#target';
	}

	function getCorrectURL(afterHome){
    	var str = document.URL;
    	
    	//str = str.substr(7, str.length);
    	str = str.substr(0, str.indexOf("profile"));
    	
    	str = str.substr(0, str.length -1);
    	// alert(str);
    	if(str.length>1) {
    		// str = str.substr(0, str.indexOf('/', 1));
    		//alert(str);	
    		str = str + '/' + afterHome;
    		return str;
    	} else {
    		//alert(str);	
    		return afterHome;
    	}
    	//alert(str);
    }
</script>