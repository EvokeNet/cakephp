<div class = "evoke evidence content-box">
		<div class="evoke row full-width-alternate group">

		  <div class="small-3 medium-3 large-3 columns evoke text-align-end">

		  	<div class="blue-btn">

			  <div class = "social-icons padding bottom-1">
				<i class="fa fa-facebook-square fa-lg"></i>&nbsp;
				<i class="fa fa-google-plus-square fa-lg"></i>&nbsp;
				<i class="fa fa-twitter-square fa-lg"></i>
			  </div>

			  	<?php 
					// $count_members = array();
					// $member = false;
					// if($e['Group']['user_id'] == $user['User']['id']) {
					// 	$member = true;
					// } else {
					// 	foreach ($users as $u) {
					// 		if($u['GroupsUser']['group_id'] == $e['Group']['id']) {
					// 			if(isset($count_members[$e['Group']['id']]))
					// 				$count_members[$e['Group']['id']]++;
					// 			else
					// 				$count_members[$e['Group']['id']] = 2;
					// 			if($u['GroupsUser']['user_id'] == $user['User']['id']) {
					// 				$member = true;
					// 				break;
					// 			}
					// 		}
					// 	}
					// }

					// if(!$member): ?>
						<!-- <a href="#" data-reveal-id="<?= $e['Group']['id']?>" data-reveal class = "evoke button general"><?= __('Send request to join')?></a> -->

				<?php //endif; ?>

			</div>
		  	
		  </div>

		  <div class="small-2 medium-2 large-2 columns evoke text-align-center">

		  	<?php if($e['Group']['photo_dir'] == null) :?>
  				<img src="https://graph.facebook.com//picture?type=large" style = "height:5vw"/>
	  		<?php else : ?>
				<img src="<?= $this->webroot.'files/attachment/attachment/'.$e['Group']['photo_dir'].'/thumb_'.$e['Group']['photo_attachment'] ?>" style = "height:5vw"/>
			<?php endif; ?>

		  </div>

		  <div class="small-7 medium-7 large-7 columns">
		  	<div>
		  		<a href = "<?php echo $this->Html->url(array('controller' => 'groups', 'action' => 'view', $e['Group']['id']));?>"><h4 class = "headings"><?= $e['Group']['title']?></h4></a>
		  	</div>
		  </div>

		</div>
</div>