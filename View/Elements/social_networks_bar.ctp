<!-- FACEBOOK -->
<a href="<?= $user['User']['facebook'] ?>" 
	class="button-icon <?= (is_null($user['User']['facebook']) ? 'disabled' : 'text-glow-on-hover') ?>"
	<?= (is_null($user['User']['facebook']) ? 'disabled' : '') ?>>
	<span class="fa-stack fa-lg">
		<i class="fa fa-square fa-stack-2x facebook-icon background"></i>
		<i class="fa fa-facebook fa-stack-1x fa-inverse text-color-dark"></i>
	</span>
</a>
<!-- TWITTER -->
<a href="<?= $user['User']['twitter'] ?>" 
	class="button-icon <?= (is_null($user['User']['twitter']) ? 'disabled' : 'text-glow-on-hover') ?>"
	<?= (is_null($user['User']['twitter']) ? 'disabled' : '') ?>>
	<span class="fa-stack fa-lg">
		<i class="fa fa-square fa-stack-2x twitter-icon background"></i>
		<i class="fa fa-twitter fa-stack-1x fa-inverse text-color-dark"></i>
	</span>
</a>
<!-- INSTAGRAM -->
<a href="<?= $user['User']['instagram'] ?>" 
	class="button-icon <?= (is_null($user['User']['instagram']) ? 'disabled' : 'text-glow-on-hover') ?>"
	<?= (is_null($user['User']['instagram']) ? 'disabled' : '') ?>>
	<span class="fa-stack fa-lg">
		<i class="fa fa-square fa-stack-2x instagram-icon background"></i>
		<i class="fa fa-instagram fa-stack-1x fa-inverse text-color-dark"></i>
	</span>
</a>
<!-- WEBSITE -->
<a href="<?= $user['User']['website'] ?>" target="_blank"
	class="button-icon <?= (is_null($user['User']['website']) ? 'disabled' : 'text-glow-on-hover') ?>"
	<?= (is_null($user['User']['website']) ? 'disabled' : '') ?>>
	<span class="fa-stack fa-lg">
		<i class="fa fa-square fa-stack-2x website-icon background"></i>
		<i class="fa fa-laptop fa-stack-1x fa-inverse text-color-dark"></i>
	</span>
</a>
<!-- BLOG -->
<a href="<?= $user['User']['blog'] ?>" 
	class="button-icon <?= (is_null($user['User']['blog']) ? 'disabled' : 'text-glow-on-hover') ?>"
	<?= (is_null($user['User']['blog']) ? 'disabled' : '') ?>>
	<span class="fa-stack fa-lg">
		<i class="fa fa-square fa-stack-2x blog-icon background"></i>
		<i class="fa fa-pencil fa-stack-1x fa-inverse text-color-dark"></i>
	</span>
</a>
<!-- EMAIL -->
<a href="<?= $user['User']['email'] ?>" 
	class="button-icon <?= (is_null($user['User']['email']) ? 'disabled' : 'text-glow-on-hover') ?>"
	<?= (is_null($user['User']['email']) ? 'disabled' : '') ?>>
	<span class="fa-stack fa-lg">
		<i class="fa fa-square fa-stack-2x email-icon background"></i>
		<i class="fa fa-envelope-o fa-stack-1x fa-inverse text-color-dark"></i>
	</span>
</a>