<?php
	/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => 'Agent key strengths', 'imgSrc' => ($this->webroot.'img/header-profile.jpg')));
	$this->end();
?>

<div class="row standard-width">
	<div class="row">
		<div class="medium-6 columns">
			<h3><?= __('You are an entrepreneurial agent!') ?></h3>
			<p><?= __('Congratulations, Agent! Most do not make it this far. Your profile shows great promise.') ?></p>
			<p><?= __('Continue to explore who you are, who you could be, on your profile page. Or start your mission. Or begin to think about your world chanding idea!') ?></p>
			<div class="text-center">
				<a class="button" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'enter_site')); ?>"><?php echo __('Explore evoke!'); ?></a>
			</div>

		</div>
		<div class="medium-6 columns centering-block">
			<div class="text-center vertical-align-middle centered-block">(GRAPH HERE)</div>
		</div>
	</div>

	<div class="row">
		<div class="small-12 columns margin top-2">
			<?php if (count($similar_users) > 0): ?>
			<h3><?= __('These are agents with a profile similar to yours') ?></h3>
			<?php endif; ?>
		</div>

		<div class="row user-panel">
			<?php
				foreach($similar_users as $user):
					$pic = $this->webroot.'webroot/img/user_avatar.jpg';
					if($user['User']['photo_attachment'] == null) {
						if($user['User']['facebook_id'] != null) {
							$pic = "https://graph.facebook.com/". $user['User']['facebook_id'] ."/picture?type=large";
						}
					}
					else {
						$pic = $this->webroot.'files/attachment/attachment/'.$user['User']['photo_dir'].'/'.$user['User']['photo_attachment'];
					}
			?>
			<div class="large-3 medium-6 small-6 columns">
				<div class="profile-content panel radius text-center margin right-05">
					<div class="profile-picture radius"
			    		data-interchange="['<?= $pic ?>',(default)]">
					</div>

					<p class="font-highlight text-color-highlight"><?= $user['User']['name'] ?></p>
					<?= $user['User']['biography'] ?>
					<button class="submit small"><?php echo __('View Agent'); ?></button>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<?php
	/* Script */
	$this->start('script'); ?>
	<script type="text/javascript">
		//Checkbox glows when selected
		$("div.profile-content")
		.on("mouseover", function(){
			$(this).addClass('img-glow-small');
			$(this).find('.profile-picture').addClass('img-glow-small');
			$(this).find('button').addClass('img-glow-small').addClass('text-glow');
		})
		.on("mouseout", function(){
			$(this).removeClass('img-glow-small');
			$(this).find('.profile-picture').removeClass('img-glow-small');
			$(this).find('button').removeClass('img-glow-small').removeClass('text-glow');
		});
	</script>
	<?php $this->end(); ?>

<?php
	/* Footer */
	$this->start('footer');
	echo $this->element('footer');
	$this->end();
?>