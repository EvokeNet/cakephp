<div class="row evoke evokation-red-box">
	<div class="small-2 medium-2 large-2 columns margin bottom-1">
  		<div class = "evoke dashboard text-align">
  			<!-- <img src="https://graph.facebook.com/<?php echo $e['User']['facebook_id']; ?>/picture?type=large" width="110px"/> -->

			<?php if($n['User']['photo_attachment'] == null) : ?>
			<?php if($n['User']['facebook_id'] == null) : ?>
				<img src="<?= $this->webroot.'img/user_avatar.jpg' ?>"   class = "evoke top-bar icon"/>
			<?php else : ?>	
				<img src="https://graph.facebook.com/<?php echo $n['User']['facebook_id']; ?>/picture?type=large"  class = "evoke top-bar icon"/>
			<?php endif; ?>
			<?php else : ?>
				<img src="<?= $this->webroot.'files/attachment/attachment/'.$n['User']['photo_dir'].'/'.$n['User']['photo_attachment'] ?>" class = "evoke top-bar icon"/>
			<?php endif; ?>

		</div>
	</div>
	
	<div class="small-7 medium-7 large-7 columns">

	</div>

	<div class="small-3 medium-3 large-3 columns">
		<div class = "evoke text-align">
			<div class = "button general green"><?= strtoupper(__('View')) ?></div>
		</div>	
	</div>
</div>