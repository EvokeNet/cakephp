<?php

	echo $this->Html->css('mycarousel');

	$this->extend('/Common/topbar');
	$this->start('menu');

	$name = explode(' ', $users['User']['name']);

	echo $this->element('header', array('user' => $users, 'sumMyPoints' => $sumMyPoints));

	$this->end(); 
?>

<section class="evoke default-background">

	<div class="evoke default row full-width-alternate">

	  <div class="small-2 medium-2 large-2 columns padding-left">
	  	<?php echo $this->element('menu', array('user' => $users));?>
	  </div>

	  <div class="small-7 medium-7 large-7 columns padding top-2 maincolumn">
	  	<?php echo $this->Session->flash(); ?>

	  	<?php 
	  		// debug($adminNotifications);
	  		$adminNotifications = array_merge($adminNotifications, $adminNotificationsToMe);
	  		$allNot = "";
	  		$first = true;
	  		$hasNotification = null;
	  		echo $this->Html->css('lightbox_ribbon');
	  		foreach ($adminNotifications as $key => $not) {
	  			$searchStr = '<!-- CLOSE_HERE -->';

	  			$fla = 	$this->Session->flash('admin'.$not['AdminNotification']['id']);
	  			if(end($adminNotifications) == $not) {
		  			$closeModal = '<a class="close-reveal-modal">&#215;</a>';
		  			$fla =  str_replace( $searchStr , $closeModal , $fla);
	  			} else {
	  				if(isset($adminNotifications[$key++])) {
	  					$nextId = $adminNotifications[$key++]['AdminNotification']['id'];
	  					$nextModal = '<p><a href="#" data-reveal-id="admin'.$nextId.'" class="button">Understood ...</a></p>';
		  				$fla =  str_replace( $searchStr , $nextModal , $fla);
		  			}
	  			}

	  			if($first) {
	  				echo $fla;
	  				$hasNotification = 'admin'.$not['AdminNotification']['id'];
	  			} else {
		  			$allNot .= $fla;
	  			}
	  			// debug($fla);
	  			// echo $fla;
	  			$first = false;
	  		}
	  		echo $allNot;
	  	?>

	  	<h3 class = "margin bottom-1"><?= strtoupper(__('Choose a mission')) ?> </h3>
	  	  <div id="pattern" class="pattern">
  			<div class="c">
			<div class="c-list-container">
				<ul class="c-list">
					<div class = "evoke dashboard missions">
						<!-- if needed, show the basic training mission before all others -->
						<?php if (isset($basic_training)): ?>
	                		<?php if(!is_null($basic_training['Mission']['cover_dir'])) :?>
								<li>
									<a href="<?= $this->Html->url(array('controller' => 'missions', 'action' => 'view', $basic_training['Mission']['id'], 1))?>">

										<img src="<?= $this->webroot.'files/attachment/attachment/'.$basic_training['Mission']['cover_dir'].'/'.$basic_training['Mission']['cover_attachment'] ?>" style = "max-height: 130px; height: 130px; width:100%">
										<h1><?= $basic_training['Mission']['title'] ?> </h1>
										<!-- <div class="summary">
											<h2>This is the first title</h2>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget lacus erat, sit amet tempor nibh. Aliquam erat volutpat. Nulla et porta tortor. </p>
										</div> -->
									</a>
								</li>
									
			                <?php else :?>
								<li>
									<a href="<?= $this->Html->url(array('controller' => 'missions', 'action' => 'view', $basic_training['Mission']['id'], 1))?>">
										<img src = '<?= $this->webroot.'img/E01G01P02.jpg' ?>' style = "max-height: 130px; height: 130px; width:100%">
										<h1><?= $basic_training['Mission']['title'] ?> </h1>
									</a>
								</li>

				            <?php endif ?>

	                		
	                	<?php endif;?>

						<?php foreach($missions as $mission): ?>
							
								<?php if(!is_null($mission['Mission']['cover_dir'])) :?>
									<li>
										<a href="<?= $this->Html->url(array('controller' => 'missions', 'action' => 'view', $mission['Mission']['id'], 1))?>">

											<img src="<?= $this->webroot.'files/attachment/attachment/'.$mission['Mission']['cover_dir'].'/'.$mission['Mission']['cover_attachment'] ?>" style = "max-height: 130px; height: 130px; width:100%">
											<h1><?= $mission['Mission']['title'] ?> </h1>
											
										</a>
									</li>
									
				                <?php else :?>

									<li>
										<a href="<?= $this->Html->url(array('controller' => 'missions', 'action' => 'view', $mission['Mission']['id'], 1))?>">
											<img src = '<?= $this->webroot.'img/E01G01P02.jpg' ?>' style = "max-height: 130px; height: 130px; width:100%">
											<h1><?= $mission['Mission']['title'] ?> </h1>
											
										</a>
									</li>

				                <?php endif ?>
							
						<?php endforeach; ?>
					</div>
				</ul>
			</div>
			<nav class="c-nav">
				<a href="#" class="prev"><i class="fa fa-arrow-circle-o-left fa-2x"></i></a>
				<a href="#" class="next"><i class="fa fa-arrow-circle-o-right fa-2x"></i></a>
			</nav>
		</div>
		
	</div>

	  	<h3 class = "margin bottom-1"> <?= strtoupper(__('Evidence/Project Stream')) ?> </h3>
	  	
	  	<dl class="default tabs" data-tab>
		  <dd class="active"><a id="evidenceTrigger" href="#evidenceHolder"><?= strtoupper(__('All Evidences')) ?></a></dd>
		  <dd><a id="evokationTrigger" href="#evokationHolder"><?= strtoupper(__('All Evokations')) ?></a></dd>
		</dl>

	  	<div class="evoke content-block default tabs-content">
		  	<div class="content active" id="evidenceHolder">
			    
			    <?php 
			    	$lastEvidence = null;
		    		//Lists all projects and evidences
		    		foreach($evidence as $e): 
	    				
	    				echo $this->element('evidence', array('e' => $e, 'lang' => $lang)); 
	    				$lastEvidence = $e['Evidence']['id'];
		    		endforeach; 
		    		
				?>
				<meta name="lastEvidence" content="<?php echo $lastEvidence; ?>">
				<div id="target"></div>
			  </div>
			  <div class="content" id="evokationHolder">
					    <?php 
					    	$lastEvokation = null;

				    		foreach($evokations as $e):
				    			$showFollowButton = true;
				    			foreach($myEvokations as $my) :
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
						?>
					<meta name="lastEvokation" content="<?php echo $lastEvokation; ?>">
			    	<div id="targetEvokation"></div>

			  </div>
		</div>

	  </div>

	  <div class="small-3 medium-3 large-3 columns padding top-2 maincolumn">
	  	
	  	<h3> <?= strtoupper(__('Notifications')) ?> </h3>
	  	<div class = "evoke content-block padding profile feed">
	  		<ul>
		  		<?php if(empty($notifies)): ?>

					<img src = '<?= $this->webroot.'img/placeholders-feed.png' ?>' style = "width: 100%; max-height: 100%;">
				<?php else: ?>
					<?php foreach($notifies as $n):

						$action_user = null;

						foreach($allusers as $alluser):
							if($n['Notification']['action_user_id'] == $alluser['User']['id']){
								$action_user = $alluser;
								break;
							}
						endforeach;

						//setting the $pic's var over here to avoid repetitive if's
						$pic_action = $this->webroot.'img/user_avatar.jpg';
						$pic = $this->webroot.'img/user_avatar.jpg';
						
						if($action_user['User']['photo_attachment'] == null) :
							if($action_user['User']['facebook_id'] != null) :
								$pic_action = "https://graph.facebook.com/" . $action_user['User']['facebook_id'] . "/picture?type=large";
							endif;
					  	else : 
					  		$pic_action = $this->webroot.'files/attachment/attachment/'.$action_user['User']['photo_dir'].'/'.$action_user['User']['photo_attachment'];
					  	endif; 

					  	if($n['User']['photo_attachment'] == null) :
							if($n['User']['facebook_id'] != null) :
								$pic = "https://graph.facebook.com/" . $n['User']['facebook_id'] . "/picture?type=large";
							endif;
					  	else : 
					  		$pic = $this->webroot.'files/attachment/attachment/'.$n['User']['photo_dir'].'/'.$n['User']['photo_attachment'];
					  	endif; 




						if($n['Notification']['origin'] == 'like'):

						if($action_user['User']['id'] != $users['User']['id']){ ?>

							<li>
								<a href = "<?= $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $n['Notification']['origin_id'])) ?>">	
									<!-- action user picture -->
									<div class="left" style="min-width: 2vw; max-width: 2vw; min-height: 2vw; background-image: url(<?=$pic_action?>); background-position:center; background-size: 100% Auto; margin-right: 1vw;"></div>
									<?= sprintf(__('Agent %s liked an evidence you posted'), $action_user['User']['name']) ?>
								</a>
							</li>

						<?php } ?>

					<?php endif; ?>

					<?php if($n['Notification']['origin'] == 'commentEvidence'):

						if($action_user['User']['id'] != $users['User']['id']){ ?>

							<li>
								<!-- action user picture -->
								<a href = "<?= $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $n['Notification']['origin_id'])) ?>">
									<div class="left" style="min-width: 2vw; max-width: 2vw; min-height: 2vw; background-image: url(<?=$pic_action?>); background-position:center; background-size: 100% Auto; margin-right: 1vw;"></div>
									<?= sprintf(__('Agent %s commented an evidence you posted'), $action_user['User']['name']) ?>
								</a>
							</li>

						<?php } ?>
												
					<?php endif; ?>

					<?php if($n['Notification']['origin'] == 'commentEvokation'):

						if($action_user['User']['id'] != $users['User']['id']){ ?>

							<li>
								<!-- action user picture -->
								<a href = "<?= $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $n['Notification']['origin_id'])) ?>">
									<div class="left" style="min-width: 2vw; max-width: 2vw; min-height: 2vw; background-image: url(<?=$pic_action?>); background-position:center; background-size: 100% Auto; margin-right: 1vw;"></div>
									<?= sprintf(__('Agent %s commented an evokation your group posted'), $action_user['User']['name']) ?>
								</a>
							</li>

						<?php } ?>
												
					<?php endif; ?>

					<?php if($n['Notification']['origin'] == 'voteEvokation'):

						if($action_user['User']['id'] != $users['User']['id']){ ?>

							<li>
								<!-- action user picture -->
								<a href = "<?= $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $n['Notification']['origin_id'])) ?>">
									<div class="left" style="min-width: 2vw; max-width: 2vw; min-height: 2vw; background-image: url(<?=$pic_action?>); background-position:center; background-size: 100% Auto; margin-right: 1vw;"></div>
									<?= sprintf(__('Agent %s commented an evokation your group posted'), $action_user['User']['name']) ?>
								</a>
							</li>

						<?php } ?>
												
					<?php endif; ?>

					<?php if($n['Notification']['origin'] == 'gritBadge'): 

							if(!empty($n['badge_name'])):?>

							<li>
								<!-- user picture -->
								<a href = "<?= $this->Html->url(array('controller' => 'badges', 'action' => 'index')) ?>">
									<div class="left" style="min-width: 2vw; max-width: 2vw; min-height: 2vw; background-image: url(<?=$pic?>); background-position:center; background-size: 100% Auto; margin-right: 1vw;"></div>
									<?= sprintf(__('You won the %s badge'), $n['badge_name']) ?>
								</a> <!-- Tirar -->
							</li>
												
					<?php endif; endif; ?>

				<?php endforeach; ?>
				<?php endif; ?>
			</ul>
	  	</div>

	  	<h3 class = "margin bottom-1 top"><?= strtoupper(__('Feed')) ?> </h3>
	  	<div class = "evoke content-block padding profile feed">
	  		
	  		<?php if(empty($notifies)): ?>

				<img src = '<?= $this->webroot.'img/placeholders-feed.png' ?>' style = "width: 100%; max-height: 100%;">
				<!-- <h1><?= strtoupper(__('You have no allies at the moment')) ?></h1> -->

			<?php else: ?>

			<ul>
				<?php foreach($feed as $n): 


					//setting the $pic's var over here to avoid repetitive if's
					$pic = $this->webroot.'img/user_avatar.jpg';
					
					if($n['User']['photo_attachment'] == null) :
						if($n['User']['facebook_id'] != null) :
							$pic = "https://graph.facebook.com/" . $n['User']['facebook_id'] . "/picture?type=large";
						endif;
					else : 
						$pic = $this->webroot.'files/attachment/attachment/'.$n['User']['photo_dir'].'/'.$n['User']['photo_attachment'];
					endif;

					if($n['Notification']['origin'] == 'evidence'):?>						
						<li>
							<a href = "<?= $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $n['Notification']['origin_id'])) ?>">
								<div class="left" style="min-width: 2vw; max-width: 2vw; min-height: 2vw; background-image: url(<?=$pic?>); background-position:center; background-size: 100% Auto; margin-right: 1vw;"></div>
								<?= sprintf(__('Agent %s posted an evidence'), $n['User']['name']) ?>
							</a>
						</li>
					<?php endif; ?>

					<?php if($n['Notification']['origin'] == 'BasicTraining'):?>
						<li>
							<a href = "#">
								<div class="left" style="min-width: 2vw; max-width: 2vw; min-height: 2vw; background-image: url(<?=$pic?>); background-position:center; background-size: 100% Auto; margin-right: 1vw;"></div>
								<?= sprintf(__('Agent %s finished the Basic Training'), $n['User']['name']) ?>
							</a>
						</li>
					<?php endif; ?>

					<?php if($n['Notification']['origin'] == 'userUpdate'):?>						
						<li>
							<a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $n['User']['id'])) ?>">
								<div class="left" style="min-width: 2vw; max-width: 2vw; min-height: 2vw; background-image: url(<?=$pic?>); background-position:center; background-size: 100% Auto; margin-right: 1vw;"></div>
								<?= sprintf(__('Agent %s updated its profile'), $n['User']['name']) ?>
							</a>
						</li>
					<?php endif; ?>

					<?php if($n['Notification']['origin'] == 'like'):?>						
						<!-- <li>
							<a href = "<?= $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $n['Notification']['origin_id'])) ?>">
								<div class="left" style="min-width: 2vw; max-width: 2vw; min-height: 2vw; background-image: url(<?=$pic?>); background-position:center; background-size: 100% Auto; margin-right: 1vw;"></div>
								<?= sprintf(__('Agent %s liked an evidence from '), $n['User']['name']) ?>
							</a>
						</li> -->
					<?php endif; ?>

					<?php if($n['Notification']['origin'] == 'like'):
					
						foreach($allusers as $alluser):
							if($n['Notification']['action_user_id'] == $alluser['User']['id']){
								$action_user = $alluser;
								break;
							}
						endforeach;

						if($action_user['User']['id'] == $users['User']['id']) :
							$message = sprintf(__('You liked an evidence Agent %s posted'), $n['User']['name']);
						else:
							$message = sprintf(__('Agent %s liked an evidence from Agent %s'), $action_user['User']['name'], $n['User']['name']);
						endif; ?>						
						
						<li>
							<a href = "<?= $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $n['Notification']['origin_id'])) ?>">
								<div class="left" style="min-width: 2vw; max-width: 2vw; min-height: 2vw; background-image: url(<?=$pic?>); background-position:center; background-size: 100% Auto; margin-right: 1vw;"></div>
								<?= $message ?>
							</a>
						</li>
					<?php endif; ?>

					<?php if($n['Notification']['origin'] == 'commentEvidence'):?>						
						<li>
							<a href = "<?= $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $n['Notification']['origin_id'])) ?>">
								<div class="left" style="min-width: 2vw; max-width: 2vw; min-height: 2vw; background-image: url(<?=$pic?>); background-position:center; background-size: 100% Auto; margin-right: 1vw;"></div>
								<?= sprintf(__('Agent %s commented an evidence'), $n['User']['name']) ?>
							</a>
						</li>
					<?php endif; ?>

					<?php if($n['Notification']['origin'] == 'phaseCompleted'):?>						
						<!-- <li>
							<div class="left" style="min-width: 2vw; max-width: 2vw; min-height: 2vw; background-image: url(<?=$pic?>); background-position:center; background-size: 100% Auto; margin-right: 1vw;"></div>
							<?= sprintf(__('Agent %s completed a phase'), $n['User']['name']) ?>
						</li> -->
					<?php endif; ?>
				
				<?php endforeach; ?>
			</ul>

			<?php endif; ?>

	  	</div>

	  	<h3 class = "margin bottom-1 top"><?= strtoupper(__('Discussions')) ?> </h3>
	  	<div class = "evoke content-block padding profile feed">
	  		<ul>
	  			<?php foreach($a_topics as $topic): 

	  				//setting the $pic's var over here to avoid repetitive if's
					$pic = $this->webroot.'img/user_avatar.jpg';
					
					if($topic['User']['photo_attachment'] == null) :
						if($topic['User']['facebook_id'] != null) :
							$pic = "https://graph.facebook.com/" . $topic['User']['facebook_id'] . "/picture?type=large";
						endif;
					else : 
						$pic = $this->webroot.'files/attachment/attachment/'.$topic['User']['photo_dir'].'/'.$topic['User']['photo_attachment'];
					endif;

					//if($n['Notification']['origin'] == 'evidence'):?>						
						<li>
							<a href="<?= $this->Html->url(array('plugin' => 'forum', 'controller' => 'topics', 'action' => 'view', $topic['Topic']['slug']))?>">
								<div class="left" style="min-width: 2vw; max-width: 2vw; min-height: 2vw; background-image: url(<?=$pic?>); background-position:center; background-size: 100% Auto; margin-right: 1vw;"></div>
								<?= sprintf(__('Agent %s created the topic %s'), $topic['User']['name'], $topic['Topic']['title']) ?>
							</a>

						</li>
					<?php //endif; ?>
				<?php endforeach; ?>
			</ul>

			<ul>
				<?php foreach($a_posts as $post): 

					//setting the $pic's var over here to avoid repetitive if's
					$pic = $this->webroot.'img/user_avatar.jpg';
					
					if($post['User']['photo_attachment'] == null) :
						if($post['User']['facebook_id'] != null) :
							$pic = "https://graph.facebook.com/" . $post['User']['facebook_id'] . "/picture?type=large";
						endif;
					else : 
						$pic = $this->webroot.'files/attachment/attachment/'.$post['User']['photo_dir'].'/'.$post['User']['photo_attachment'];
					endif;

					//if($n['Notification']['origin'] == 'evidence'):?>						
						<li>
							<a href="<?= $this->Html->url(array('plugin' => 'forum', 'controller' => 'topics', 'action' => 'view', $post['Topic']['slug']))?>">
								<div class="left" style="min-width: 2vw; max-width: 2vw; min-height: 2vw; background-image: url(<?=$pic?>); background-position:center; background-size: 100% Auto; margin-right: 1vw;"></div>
								<?= sprintf(__('Agent %s posted a reply in topic %s'), $post['User']['name'], $post['Topic']['title']) ?>
							</a>
						</li>
					<?php //endif; ?>
				<?php endforeach; ?>
			</ul>
	  	</div>

	  </div>

	  <!-- <div class="medium-1 end columns"></div> -->

	</div>

	<?php if ($show_basic_training && $users['User']['role_id'] > 2): ?>
	<div id="formModal" class="reveal-modal evoke lightbox text-align" data-reveal style = "top: 370px;!important">
		<img src = '<?= $this->webroot.'img/alchemy.png' ?>' style = "margin-top: -460px;"/>
		<h2><?= sprintf(__("Agent %s, it's time to start your Basic Training"), $name[0]) ?></h2>
		<p class="lead"><?= __('This training will show you the steps inside a missions so you can start being an agent of change') ?></p>
		<a href = "<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'view', $basic_training['Mission']['id'], 1)); ?>" class = "button general"><?php echo __("Let's get started!");?></a>
		 <a class="close-reveal-modal">&#215;</a>
	</div>
	<?php endif; ?>

</section>

<?php
	echo $this->Html->script('/components/jquery/jquery.min.js');//, array('inline' => false)); 
	echo $this->Html->script('reveal_modal', array('inline' => false));
	echo $this->Html->script('mycarousel', array('inline' => false));
	echo $this->Html->script('menu_height', array('inline' => false));
?>

<script type="text/javascript" charset="utf-8">
	<?php 
		if(!is_null($hasNotification)){
			echo '$(document).ready( function() {';
			echo '$("#'.$hasNotification.'").foundation("reveal", "open");';
			echo '});';
		}
	?>

	var last = $('meta[name=lastEvidence]').attr('content');
	var lastEvokation = $('meta[name=lastEvokation]').attr('content');
	var olderContent = 5;// 5
	var evidence = true;
	var lastLocal = last;
	var method = 'moreEvidences';
	var target = 'target';

	//ajax on either evokation or evidence stream
	$("#evokationTrigger").click(function (){
		evidence = false;
		lastLocal = lastEvokation;
		method = 'moreEvokations';
		target = 'targetEvokation';
	});

	$("#evidenceTrigger").click(function (){
		evidence = true;
		lastLocal = last;
		method = 'moreEvidences';
		target = 'target';
	});

	//checking scrolling info to call ajax function
	$(window).scroll(throttle(function() {   
		y = $('#'+target).parent().height();
		test = getOffset(document.getElementById(target));
		
		if($(window).scrollTop() + $(window).height() >= (test + y) - 600){//+ $(window).height() < x) {
			
			if((lastLocal) != "") {
				fillExtraContent();
			}
			// menuHeight();
		}
	}, 1000));
	
	function getOffset( el ) {
	    var _x = 0;
	    var _y = 0;
	    while( el && !isNaN( el.offsetLeft ) && !isNaN( el.offsetTop ) ) {
	        _x += el.offsetLeft - el.scrollLeft;
	        _y += el.offsetTop - el.scrollTop;
	        el = el.offsetParent;
	    }
	    return _y;
	}

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
		$.ajax({
		    type: 'get',
		    url: getCorrectURL(method)+"/"+lastLocal+"/"+olderContent,
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
			        
		        $('#'+target).append((response));
		    },
		    error: function(e) {
		        console.log(e);
		    }
		});
	}

	function getCorrectURL(afterHome){
    	var str = document.URL;
    	
    	str = str.substr(0, str.indexOf("dashboard"));
    	
    	str = str.substr(0, str.length -1);
    	if(str.length>1) {	
    		str = str + '/' + afterHome;
    		return str;
    	} else {	
    		return afterHome;
    	}
    }
</script>