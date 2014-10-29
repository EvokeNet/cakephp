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
			<p><?= __('You have the heart of a Local Leader!') ?></p>
			<p><?= __('Your Entrepreneurship and Local Insight are key to you. Embrace your qualities and use them for the better.') ?></p>
			<p><?= __('Continue to explore who you are, who you could be, on your profile page. Or start your mission. Or begin to think about your world chanding idea!') ?></p>
			<div class="text-center">
				<a class="button" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'enter_site')); ?>"><?php echo __('Explore evoke!'); ?></a>
			</div>
		</div>

		<!-- RADAR GRAPH FOR MATCHING RESULTS -->
		<div class="medium-6 columns centering-block">
			<div class="text-center vertical-align-middle centered-block">
				<h4><?= __('Assessment') ?></h4>
				<?php echo $this->element('matching_graph', array('height' => '450', 'width' => '500')); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<!-- SIMILAR AGENTS TITLE -->
		<div class="small-12 columns margin top-2">
			<?php if (count($similar_users) > 0): ?>
			<h3><?= __('These are agents with a profile similar to yours') ?></h3>
			<?php endif; ?>
		</div>

		<!-- SIMILAR AGENTS -->
		<ul class="user-panel large-block-grid-4 medium-block-grid-3 small-block-grid-2" data-equalizer>
			<?php
				$counter = 0;
				foreach($similar_users as $similar_user):
					$pic = $this->webroot.'webroot/img/user_avatar.jpg';
					if($similar_user['User']['photo_attachment'] == null) {
						if($similar_user['User']['facebook_id'] != null) {
							$pic = "https://graph.facebook.com/". $similar_user['User']['facebook_id'] ."/picture?type=large";
						}
					}
					else {
						$pic = $this->webroot.'files/attachment/attachment/'.$similar_user['User']['photo_dir'].'/'.$similar_user['User']['photo_attachment'];
					}
			?>
			<li>
				<!-- PANEL -->
				<a href="#" data-reveal-id="modalProfile<?= $counter ?>">
					<div class="profile-content panel radius text-center margin right-05" data-equalizer-watch>
						<!-- USER PICTURE -->
						<div class="profile-picture radius"
				    		data-interchange="['<?= $pic ?>',(default)]">
						</div>

						<!-- USER SHORT BIOGRAPHY -->
						<h4 class="text-color-highlight"><?= $similar_user['User']['name'] ?></h4>
						<p><?= $this->Text->getExcerpt($similar_user['User']['biography'], 30, '...') ?></p>
						<button class="submit small "><?php echo __('View Agent'); ?></button>
					</div>
				</a>

				<!-- VIEW AGENT DETAILS MODAL -->
				<?php echo $this->element('user_biography', array('modal' => true, 'counter' => $counter, 'similar_user' => $similar_user, 'pic' => $pic, 'add_button' => true)); ?>
			</li>
			<?php
					$counter++;
				endforeach;
			?>
		</div>
	</div>
</div>

<?php
	/* Script */
	$this->start('script');
?>
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

		//Add ally
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
	</script>
	<?php $this->end(); ?>

<?php
	/* Footer */
	$this->start('footer');
	echo $this->element('footer');
	$this->end();
?>