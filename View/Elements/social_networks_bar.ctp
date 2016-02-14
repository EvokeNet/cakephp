<?php
if (isset($social_networks_user)):
?>
	<?php
	if (!empty($social_networks_user['facebook'])): ?>
		<!-- FACEBOOK -->
		<span data-tooltip aria-haspopup="true" class="has-tip" title="<?= __('Facebook') ?>">
			<a href="//<?= $social_networks_user['facebook'] ?>" target="_blank" class="button-icon">
				<i class="fa fa-facebook-square fa-lg"></i>
			</a>
		</span><?php
	endif;

	if (!empty($social_networks_user['twitter'])): ?>
		<!-- TWITTER -->
		<span data-tooltip aria-haspopup="true" class="has-tip" title="<?= __('Twitter') ?>">
			<a href="//<?= $social_networks_user['twitter'] ?>" target="_blank" class="button-icon">
				<i class="fa fa-twitter-square fa-lg"></i>
			</a>
		</span> <?php
	endif;

	if (!empty($social_networks_user['instagram'])): ?>
		<!-- INSTAGRAM -->
		<span data-tooltip aria-haspopup="true" class="has-tip" title="<?= __('Instagram') ?>">
			<a href="//<?= $social_networks_user['instagram'] ?>" target="_blank" class="button-icon">
				<i class="fa fa-instagram fa-lg"></i>
			</a>
		</span> <?php
	endif;
              
    if (!empty($social_networks_user['google_plus'])): ?>
		<!-- INSTAGRAM -->
		<span data-tooltip aria-haspopup="true" class="has-tip" title="<?= __('Instagram') ?>">
			<a href="//<?= $social_networks_user['google_plus'] ?>" target="_blank" class="button-icon">
				<i class="fa fa-google-plus-square fa-lg"></i>
			</a>
		</span> <?php
	endif;

	if (!empty($social_networks_user['website'])): ?>
		<!-- WEBSITE -->
		<span data-tooltip aria-haspopup="true" class="has-tip" title="<?= __('Website') ?>">
			<a href="//<?= $social_networks_user['website'] ?>" target="_blank" class="button-icon">
				<i class="fa fa-twitter-square fa-lg"></i>
			</a>
		</span> <?php
	endif;
              
  if (!empty($social_networks_user['blog'])): ?>
		<!-- BLOG -->
		<span data-tooltip aria-haspopup="true" class="has-tip" title="<?= __('Facebook') ?>">
			<a href="//<?= $social_networks_user['blog'] ?>" target="_blank" class="button-icon">
				<i class="fa fa-wordpress fa-lg"></i>
			</a>
		</span><?php
	endif;
              
  if (!empty($social_networks_user['email'])): ?>
		<!-- MAIL -->
		<span data-tooltip aria-haspopup="true" class="has-tip" title="<?= __('Facebook') ?>">
			<a href="//<?= $social_networks_user['email'] ?>" target="_blank" class="button-icon">
				<i class="fa fa-envelope-square fa-lg"></i>
			</a>
		</span><?php
	endif;

	?>

<?php endif; ?>