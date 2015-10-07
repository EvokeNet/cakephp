<?php //Facebook login URL comes from session
	$fbLoginUrl = $this->Session->read('fbLoginUrl');
?>



<ul class="<?php echo isset($ulClass) ? $ulClass : ''; ?>">
	<!-- USERNAME, PASSWORD, AND SUBMIT BUTTON -->
	<li class="has-form">
		<!-- Form with Foundation validation -->
		<?php echo $this->Form->create('User', array('data-abide', 'url' => array('controller' => 'users', 'action' => 'login'))); ?>

		<div class="row collapse">
			<div class="small-6 medium-3 large-3 columns">
				<?php 
					echo $this->Form->input('username', array('label' => false, 'type' => 'text', 'placeholder' =>  __('username'), 'class' => 'radius', 'required' => true, 'autofocus'));
				?>
			</div>
			<div class="small-6 medium-3 large-3 columns">
				<?php 
					echo $this->Form->input('password', array('label' => false, 'type' => 'password', 'placeholder' =>  __('password'), 'class' => 'radius', 'required'));
				?>
			</div>
			<div class="small-6 medium-3 large-3 columns">
				<div class="small-only-text-center login-button-wrapper">
					<span class="show-for-small-only  margin top-1"></span>

					<button type="submit" class="small full-width">
						<?php echo __('Sign in'); ?>
					</button>
				</div>
			</div>

			<div class="small-6 medium-3 large-3 columns">
				<div class="small-only-text-center login-button-wrapper">
					<span class="show-for-small-only  margin top-1"></span>

					<a class="button small full-width" href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'register')) ?>">
						<?= __('Sign up') ?>
					</a>
				</div>
			</div>

			<!-- OTHER SIGN IN METHODS -->
			<!-- <div class="small-12 medium-3 large-3 columns">
				<div class="text-center login-social-networks">
					<?php echo __('OR'); ?>

					<a href="<?php echo $fbLoginUrl; ?>" class="button-icon">
						<span class="fa-stack fa-lg">
							<i class="fa fa-square fa-stack-2x evoke login facebook-icon"></i>
							<i class="fa fa-facebook fa-stack-1x fa-inverse "></i>
						</span>
					</a>

					<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'google_login')); ?>" class="button-icon">
						<span class="fa-stack fa-lg">
							<i class="fa fa-square fa-stack-2x evoke login google-icon"></i>
							<i class="fa fa-google-plus fa-stack-1x fa-inverse "></i>
						</span>
					</a>
				</div>
			</div> -->
		</div>
		
		<?php echo $this->Form->end(); ?>
	</li>



	<!-- LANGUAGE -->
	<?php echo $this->element('language_switcher'); ?>

	<!-- FORGOT PASSWORD (NOT USED FOR NOW) -->
	<!--<a href = "#" class = "evoke login password"><?php //echo __('Forgot your password?');?></a> -->
	<!--send to correct address-->
</ul>
