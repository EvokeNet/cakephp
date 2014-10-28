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
				$counter = 0;
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
				<a href="#" data-reveal-id="modalProfile<?= $counter ?>">
					<div class="profile-content panel radius text-center margin right-05">
						<div class="profile-picture radius"
				    		data-interchange="['<?= $pic ?>',(default)]">
						</div>

						<h4 class="text-color-highlight"><?= $user['User']['name'] ?></h4>
						<p><?= $this->Text->getExcerpt($user['User']['biography'], 30, '...') ?></p>
						<button class="submit small"><?php echo __('View Agent'); ?></button>
					</div>
				</a>

				<div id="modalProfile<?= $counter ?>" class="reveal-modal background-color-darkest" data-reveal>
					<div class="left margin right-2">
						<!-- PICTURE -->
						<div class="profile-picture radius border-style-solid border-color-highlight border-width-01"
				    		data-interchange="['<?= $pic ?>',(default)]">
						</div>

						<!-- SOCIAL NETWORKS -->
						<div>
						</div>
					</div>

					<div>
						<!-- USER NAME -->
						<h4 class="text-color-highlight"><?= __('Agent ').$user['User']['name'] ?></h4>

						<!-- LEVEL PROGRESS BAR -->

						<!-- BIOGRAPHY -->
						<?= $user['User']['biography'] ?>

						<!-- ADD -->
						<div class="text-center">
							<a class="button small addally" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'add_friend', $user['User']['id'], 'false')); ?>"><?php echo __('ADD ALLY'); ?></a>
						</div>

						<a class="close-reveal-modal">&#215;</a>
					</div>
				</div>
			</div>
			<?php
					$counter++;
				endforeach;
			?>
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

		$(document).ready(function() {
			$('.addally').on('click', function() {
				if ($(this).attr('href') != "#") {
				    $(this).load(
				        $(this).attr('href') 
				    	, function () {
				        $(this).html('<?= __('Congratulations! The user has been added.') ?>');
				        $(this).attr('href','#');
				    }); 
				}
			    // Prevent link going somewhere
			    return false; 
			});
		});
	</script>
	<?php $this->end(); ?>

<?php
	/* Footer */
	$this->start('footer');
	echo $this->element('footer');
	$this->end();
?>