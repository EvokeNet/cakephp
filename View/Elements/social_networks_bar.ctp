<?php
if (isset($social_networks_user)):
?>
	<?php
	if (!empty($social_networks_user['facebook'])): ?>
		<!-- FACEBOOK -->
		<span data-tooltip aria-haspopup="true" class="has-tip" title="<?= __('Facebook') ?>">
			<a href="<?= $social_networks_user['facebook'] ?>" target="_blank" class="button-icon">
				<span class="fa-stack fa-lg grow-on-hover">
					<i class="fa fa-square fa-stack-2x facebook-icon background"></i>
					<i class="fa fa-facebook fa-stack-1x fa-inverse text-color-dark"></i>
				</span>
			</a>
		</span><?php
	endif;

	if (!empty($social_networks_user['twitter'])): ?>
		<!-- TWITTER -->
		<span data-tooltip aria-haspopup="true" class="has-tip" title="<?= __('Twitter') ?>">
			<a href="<?= $social_networks_user['twitter'] ?>" target="_blank" class="button-icon">
				<span class="fa-stack fa-lg grow-on-hover">
					<i class="fa fa-square fa-stack-2x twitter-icon background"></i>
					<i class="fa fa-twitter fa-stack-1x fa-inverse text-color-dark"></i>
				</span>
			</a>
		</span> <?php
	endif;

	if (!empty($social_networks_user['instagram'])): ?>
		<!-- INSTAGRAM -->
		<span data-tooltip aria-haspopup="true" class="has-tip" title="<?= __('Instagram') ?>">
			<a href="<?= $social_networks_user['instagram'] ?>" target="_blank" class="button-icon">
				<span class="fa-stack fa-lg grow-on-hover">
					<i class="fa fa-square fa-stack-2x instagram-icon background"></i>
					<i class="fa fa-instagram fa-stack-1x fa-inverse text-color-dark"></i>
				</span>
			</a>
		</span> <?php
	endif;

	if (!empty($social_networks_user['website'])): ?>
		<!-- WEBSITE -->
		<span data-tooltip aria-haspopup="true" class="has-tip" title="<?= __('Website') ?>">
			<a href="<?= $social_networks_user['website'] ?>" target="_blank" class="button-icon">
				<span class="fa-stack fa-lg grow-on-hover">
					<i class="fa fa-square fa-stack-2x website-icon background"></i>
					<i class="fa fa-laptop fa-stack-1x fa-inverse text-color-dark"></i>
				</span>
			</a>
		</span> <?php
	endif;

	if (!empty($social_networks_user['blog'])): ?>
		<!-- BLOG -->
		<span data-tooltip aria-haspopup="true" class="has-tip" title="<?= __('Blog') ?>">
			<a href="<?= $social_networks_user['blog'] ?>" target="_blank" class="button-icon">
				<span class="fa-stack fa-lg grow-on-hover">
					<i class="fa fa-square fa-stack-2x blog-icon background"></i>
					<i class="fa fa-pencil fa-stack-1x fa-inverse text-color-dark"></i>
				</span>
			</a>
		</span> <?php
	endif;

	if (!empty($social_networks_user['email'])): ?>
		<!-- EMAIL -->
		<span data-tooltip aria-haspopup="true" class="has-tip" title="<?= __('Email address') ?>">
			<a href="mailto:<?= $social_networks_user['email'] ?>" class="button-icon">
				<span class="fa-stack fa-lg grow-on-hover">
					<i class="fa fa-square fa-stack-2x email-icon background"></i>
					<i class="fa fa-envelope-o fa-stack-1x fa-inverse text-color-dark"></i>
				</span>
			</a>
		</span><?php
	endif;
	?>

<?php endif; ?>