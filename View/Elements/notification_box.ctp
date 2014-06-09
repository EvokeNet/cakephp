<?php
	
	$message = '' ;
	$npa = '';
	$nfb = '';
	$npd = '';

	if(isset($n['user_pa']))
		$npa = $n['user_pa'];
	else
		$npa = $n['User']['photo_attachment'];
	
	if(isset($n['user_fb']))
		$nfb = $n['user_fb'];
	else
		$nfb = $n['User']['facebook_id'];

	if(isset($n['user_pd']))
		$npd = $n['user_pd'];
	else
		$npd = $n['User']['photo_dir'];

	$message = '';

	if($n['Notification']['origin'] == 'commentEvidence'){
		$message = sprintf(__('Agent %s commented an evidence you posted'), $n['user_name']);

	} if($n['Notification']['origin'] == 'commentEvokation'){
		$message = sprintf(__('Agent %s commented an evidence you posted'), $n['user_name']);

	} if($n['Notification']['origin'] == 'like'){
		$message = sprintf(__('Agent %s liked an evidence you posted'), $n['user_name']);

	} if(($n['Notification']['origin'] == 'voteEvokation')){
		$message = sprintf(__('Agent %s commented an evokation your group posted'), $n['user_name']);

	} if($n['Notification']['origin'] == 'gritBadge'){
		$message = sprintf(__('You won the %s badge'), $n['badge_name']);
	}

	if(isset($date)): ?>
		<h2 class = "white margin top" style = "margin-left:0.5em"><?= $date ?></h2>
	<?php endif;	
?>

<div class="row evoke evokation-red-box">
	<div class="small-2 medium-2 large-2 columns margin bottom-1">
  		<div class = "evoke dashboard text-align">
  			<!-- <img src="https://graph.facebook.com/<?php echo $e['User']['facebook_id']; ?>/picture?type=large" width="110px"/> -->

  			<?php if(($n['Notification']['origin'] == 'gritBadge') && (isset($n['imd'])) && isset($n['ima'])): ?>
  				<img src = '<?= $this->webroot.'files/attachment/attachment/'.$n['imd'].'/'.$n['ima'] ?>'>
  			<?php else: ?>
  				<div style="width: 100px; height: 100px; overflow: hidden;">
					<?php if($npa == null) : ?>
						<?php if($nfb == null) : ?>
							<img src="<?= $this->webroot.'img/user_avatar.jpg' ?>"/>
						<?php else : ?>	
							<img src="https://graph.facebook.com/<?php echo $nfb; ?>/picture?type=large"/>
						<?php endif; ?>
					<?php else : ?>
						<img src="<?= $this->webroot.'files/attachment/attachment/'.$npd.'/'.$npa ?>"/>
					<?php endif; ?>
				</div>
  			<?php endif; ?>

		</div>
	</div>
	
	<div class="small-7 medium-7 large-7 columns">
  		<h1 class='headings'>
  			<?php
  				if($n['Notification']['origin'] == 'commentEvidence'){
					echo $this->Html->link($message, array('controller' => 'evidences', 'action' => 'view', $n['Notification']['origin_id']));

				} if($n['Notification']['origin'] == 'commentEvokation'){
					echo $this->Html->link($message, array('controller' => 'evokations', 'action' => 'view', $n['Notification']['origin_id']));

				} if($n['Notification']['origin'] == 'like'){
					echo $this->Html->link($message, array('controller' => 'evidences', 'action' => 'view', $n['Notification']['origin_id']));

				} if(($n['Notification']['origin'] == 'voteEvokation')){
					echo $this->Html->link($message, array('controller' => 'evokations', 'action' => 'view', $n['Notification']['origin_id']));

				} if($n['Notification']['origin'] == 'gritBadge'){
					echo $this->Html->link($message, array('controller' => 'badges', 'action' => 'index'));
				}

			?>
  		</h1>
	</div>

	<div class="small-3 medium-3 large-3 columns">
		<div class = "evoke text-align">
			<div class = "button general green"><?= strtoupper(__('View')) ?></div>
		</div>	
	</div>
</div>