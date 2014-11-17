<?php
if (isset($social_networks_user)):
?>

	<!-- FACEBOOK -->
	<a href="<?= $social_networks_user['facebook'] ?>" 
		class="button-icon <?= (is_null($social_networks_user['facebook']) ? 'disabled' : '') ?>"
		<?= (is_null($social_networks_user['facebook']) ? 'disabled' : '') ?>>
		<span class="fa-stack fa-lg grow-on-hover">
			<i class="fa fa-square fa-stack-2x facebook-icon background"></i>
			<i class="fa fa-facebook fa-stack-1x fa-inverse text-color-dark"></i>
		</span>
	</a>
	<!-- TWITTER -->
	<a href="<?= $social_networks_user['twitter'] ?>" 
		class="button-icon <?= (is_null($social_networks_user['twitter']) ? 'disabled' : '') ?>"
		<?= (is_null($social_networks_user['twitter']) ? 'disabled' : '') ?>>
		<span class="fa-stack fa-lg grow-on-hover">
			<i class="fa fa-square fa-stack-2x twitter-icon background"></i>
			<i class="fa fa-twitter fa-stack-1x fa-inverse text-color-dark"></i>
		</span>
	</a>
	<!-- INSTAGRAM -->
	<a href="<?= $social_networks_user['instagram'] ?>" 
		class="button-icon <?= (is_null($social_networks_user['instagram']) ? 'disabled' : '') ?>"
		<?= (is_null($social_networks_user['instagram']) ? 'disabled' : '') ?>>
		<span class="fa-stack fa-lg grow-on-hover">
			<i class="fa fa-square fa-stack-2x instagram-icon background"></i>
			<i class="fa fa-instagram fa-stack-1x fa-inverse text-color-dark"></i>
		</span>
	</a>
	<!-- WEBSITE -->
	<a href="<?= $social_networks_user['website'] ?>" target="_blank"
		class="button-icon <?= (is_null($social_networks_user['website']) ? 'disabled' : '') ?>"
		<?= (is_null($social_networks_user['website']) ? 'disabled' : '') ?>>
		<span class="fa-stack fa-lg grow-on-hover">
			<i class="fa fa-square fa-stack-2x website-icon background"></i>
			<i class="fa fa-laptop fa-stack-1x fa-inverse text-color-dark"></i>
		</span>
	</a>
	<!-- BLOG -->
	<a href="<?= $social_networks_user['blog'] ?>" 
		class="button-icon <?= (is_null($social_networks_user['blog']) ? 'disabled' : '') ?>"
		<?= (is_null($social_networks_user['blog']) ? 'disabled' : '') ?>>
		<span class="fa-stack fa-lg grow-on-hover">
			<i class="fa fa-square fa-stack-2x blog-icon background"></i>
			<i class="fa fa-pencil fa-stack-1x fa-inverse text-color-dark"></i>
		</span>
	</a>
	<!-- EMAIL -->
	<a href="<?= $social_networks_user['email'] ?>" 
		class="button-icon <?= (is_null($social_networks_user['email']) ? 'disabled' : '') ?>"
		<?= (is_null($social_networks_user['email']) ? 'disabled' : '') ?>>
		<span class="fa-stack fa-lg grow-on-hover">
			<i class="fa fa-square fa-stack-2x email-icon background"></i>
			<i class="fa fa-envelope-o fa-stack-1x fa-inverse text-color-dark"></i>
		</span>
	</a>

<?php endif; ?>