

<!-- TOP-BAR -->
<div class="evoke login-top-bar row full-width padding top-1 bottom-1 vertical-align-top fixed sticky" id="top-bar-login">
	<nav class="top-bar" data-topbar role="navigation">
		<ul class="title-area">
			<li class="name">
				<h1>
					<a href="#"><span>
						<!-- Logo -->
						<div class="left"><img src = '<?= $this->webroot.'img/Logo-Evoke-Atualizado.png' ?>'></div>
					</span></a>
				</h1>
			</li>
			
	    	<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
		</ul>

		<section class="top-bar-section">
			<!-- Right Nav Section -->

			<?php echo $this->Session->flash(); ?>

			<!-- Form with Foundation validation -->
			<?php echo $this->Form->create('User', array('data-abide')); ?>
			<ul class="right">
				<!-- USERNAME AND PASSWORD -->
				<li>
					<div class="column">
						<?php 
							echo $this->Form->input('username', array('label' => false, 'type' => 'text', 'placeholder' =>  __('username'), 'class' => 'radius', 'required' => true));
						?>
					</div>
				</li>
				<li>
					<div class="column">
						<?php 
							echo $this->Form->input('password', array('label' => false, 'type' => 'password', 'placeholder' =>  __('password'), 'class' => 'radius', 'required'));
						?>
					</div>
				</li>
				<li>
					<div class="column">
						<button type="submit"><?php echo __('Sign in'); ?></button>
					</div>
				</li>
				<!-- OTHER SIGN IN METHODS -->
				<li>
					<div class="right">
						<?php echo __('OR'); ?>

						<a href="<?php echo $fbLoginUrl; ?>">
							<span class="fa-stack fa-lg">
								<i class="fa fa-square fa-stack-2x evoke login facebook-icon"></i>
								<i class="fa fa-facebook fa-stack-1x fa-inverse "></i>
							</span>
						</a>

						<a href="<?php echo $fbLoginUrl; ?>">
							<span class="fa-stack fa-lg">
								<i class="fa fa-square fa-stack-2x evoke login google-icon"></i>
								<i class="fa fa-google-plus fa-stack-1x fa-inverse "></i>
							</span>
						</a>
					</div>
				</li>
				<!-- FORGOT PASSWORD (NOT USED FOR NOW) -->
				<!--<a href = "#" class = "evoke login password"><?php //echo __('Forgot your password?');?></a> -->
				<!--send to correct address-->
			</ul>
			<?php echo $this->Form->end(); ?>
		</section>
	</nav>
</div>

<!-- EVOKE REGISTRATION (NOT USED FOR NOW) -->
<!--
<div id="myModal" class="reveal-modal tiny evoke login-lightbox" data-reveal>
	<h2><?= __('Evoke Registration') ?></h2>
	<?php //echo $this->Form->create('User'); ?>
	<?php
		//echo $this->Form->input('name', array('required' => true, 'label' => __('Name')));
		//echo $this->Form->input('username', array('required' => true, 'label' => __('Username')));
		//echo $this->Form->input('email', array('type' => 'email', 'required' => true));
		//echo $this->Form->input('password', array('required' => true, 'label' => __('Password')));
	?>
	<?php //echo $this->Form->end(__('Submit')); ?>
	<button class="evoke button general" type="submit"><?php //echo __('Register') ?></button>
  <a class="close-reveal-modal">&#215;</a>
</div>
-->


<?php echo $this->fetch('content'); ?>