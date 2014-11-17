<?php
//MODAL
if (isset($modal) && ($modal == true)): ?>
	<div id="modalProfile<?= $counter ?>" class="reveal-modal background-color-darkest" data-reveal><?php 
endif; ?>

		<div class="left margin right-2">
			<?php $pic = $this->UserPicture->getPictureAbsolutePath($user['User']); ?>
			<!-- PICTURE -->
			<img class="profile-picture radius border-style-solid border-color-highlight border-width-01" src='<?= $pic ?>' alt="<?= $user['User']['name'] ?>'s profile picture" />

			<!-- SOCIAL NETWORKS -->
			<div>
			</div>
		</div>

		<div>
			<!-- USER NAME -->
			<h4 class="text-color-highlight"><?= __('Agent ').(isset($user['User']['name']) ? $user['User']['name'] : '') ?></h4>

			<!-- LEVEL PROGRESS BAR -->

			<!-- BIOGRAPHY -->
			<?= (isset($user['User']['biography']) ? $user['User']['biography'] : '') ?>


			<?php
			if (isset($add_button) && ($add_button == true)):?>
				<!-- ADD -->
				<div class="text-center  margin top-2">
					<a class="button small addally uppercase" href="<?php echo $this->Html->url(array('controller' => 'UserFriends', 'action' => 'add', $loggedInUser['id'], $user['User']['id'], false)); ?>"><?php echo __('ADD ALLY'); ?></a>
				</div><?php 
			endif; ?>

			<a class="close-reveal-modal">&#215;</a>
		</div>

<?php
//MODAL
if (isset($modal) && ($modal == true)): ?>
	</div><?php
endif; ?>


<?php
	/* Script */
	$this->start('script');
?>
<script type="text/javascript">
	//Add ally
	$('.addally').on('click', function() {
		if ($(this).attr('href') != "#") {
		    $(this).load(
		        $(this).attr('href') 
		    	, function () {
		        $(this).html("<?= __('Congratulations! The user has been added.') ?>");
		        $(this).attr('href','#');
		    }); 
		}
	    // Prevent link going somewhere
	    return false; 
	});
</script>
<?php
	$this->end();
?>