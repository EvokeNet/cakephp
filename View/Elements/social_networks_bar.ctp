<?php
if (isset($social_networks_user)):
?>
	<?php
	if (!is_null($social_networks_user['facebook'])): ?>
	<!-- FACEBOOK -->
	<a href="<?= $social_networks_user['facebook'] ?>" target="_blank" class="button-icon">
		<span class="fa-stack fa-lg grow-on-hover">
			<i class="fa fa-square fa-stack-2x facebook-icon background"></i>
			<i class="fa fa-facebook fa-stack-1x fa-inverse text-color-dark"></i>
		</span>
	</a> <?php
	endif;

	if (!is_null($social_networks_user['twitter'])): ?>
	<!-- TWITTER -->
	<a href="<?= $social_networks_user['twitter'] ?>" target="_blank" class="button-icon">
		<span class="fa-stack fa-lg grow-on-hover">
			<i class="fa fa-square fa-stack-2x twitter-icon background"></i>
			<i class="fa fa-twitter fa-stack-1x fa-inverse text-color-dark"></i>
		</span>
	</a> <?php
	endif;

	if (!is_null($social_networks_user['instagram'])): ?>
	<!-- INSTAGRAM -->
	<a href="<?= $social_networks_user['instagram'] ?>" target="_blank" class="button-icon">
		<span class="fa-stack fa-lg grow-on-hover">
			<i class="fa fa-square fa-stack-2x instagram-icon background"></i>
			<i class="fa fa-instagram fa-stack-1x fa-inverse text-color-dark"></i>
		</span>
	</a> <?php
	endif;

	if (!is_null($social_networks_user['website'])): ?>
	<!-- WEBSITE -->
	<a href="<?= $social_networks_user['website'] ?>" target="_blank" class="button-icon">
		<span class="fa-stack fa-lg grow-on-hover">
			<i class="fa fa-square fa-stack-2x website-icon background"></i>
			<i class="fa fa-laptop fa-stack-1x fa-inverse text-color-dark"></i>
		</span>
	</a> <?php
	endif;

	if (!is_null($social_networks_user['blog'])): ?>
	<!-- BLOG -->
	<a href="<?= $social_networks_user['blog'] ?>" target="_blank" class="button-icon">
		<span class="fa-stack fa-lg grow-on-hover">
			<i class="fa fa-square fa-stack-2x blog-icon background"></i>
			<i class="fa fa-pencil fa-stack-1x fa-inverse text-color-dark"></i>
		</span>
	</a> <?php
	endif;

	if (!is_null($social_networks_user['email'])): ?>
	<!-- EMAIL -->
	<a href="mailto:<?= $social_networks_user['email'] ?>" class="button-icon">
		<span class="fa-stack fa-lg grow-on-hover">
			<i class="fa fa-square fa-stack-2x email-icon background"></i>
			<i class="fa fa-envelope-o fa-stack-1x fa-inverse text-color-dark"></i>
		</span>
	</a><?php
	endif;
	?>

<?php endif; ?>