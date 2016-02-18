<!-- TOP-BAR -->
<div id="top-bar-login"
	 class="evoke login-top-bar row full-width padding top-05 bottom-05 vertical-align-middle
			<?php echo isset($sticky) ? $sticky : 'sticky'; ?> <?php echo isset($fixed) ? $fixed : 'fixed'; ?>" >
	<nav class="top-bar" data-topbar role="navigation">
		<ul class="title-area">
			<li class="name">
				<h1>
					<?php  ?>
					<a href="<?php
						if (isset($loggedIn) && ($loggedIn)) {
							echo $this->Html->url(array('controller' => 'users', 'action' => 'enter_site', 'admin' => false));
						}
						else {
							echo $this->Html->url(array('controller' => 'users', 'action' => 'login', 'admin' => false));
						} ?>">
						<span>
							<!-- Logo -->
							<div class="left"><img src = '<?= $this->webroot.'img/Logo-Evoke-Atualizado.png' ?>'></div>
						</span>
					</a>
				</h1>
			</li>
			
	    	<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
		</ul>

	
		<section class="top-bar-section">
 			
			<?php 
			//MENU BEFORE SIGN IN
			if (isset($loggedIn) && (!$loggedIn)) {
				echo $this->element('topbar-login', array('ulClass' => 'right'));
			}

			//MENU AFTER SIGN IN
			if (!isset($topBarCustomMenu)) {
				$topBarCustomMenu = 'topbar-loggedIn';
			}
			if (!isset($canShowIfNotLoggedIn)) {
				$canShowIfNotLoggedIn = false;
			}

			if (($loggedIn) || ($canShowIfNotLoggedIn)) {
				echo $this->element($topBarCustomMenu, array('ulClass' => 'right'));
			}
			?>

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

<!-- commented so flash messages do not appear anymore -->

<!-- Flash messages -->
<!--<?php
//if($this->Session->check('Message.flash')): ?>
	<div data-alert="" class="alert-box radius">
		<?php //echo $this->Session->flash(); ?>
		<a href="" class="close">×</a>
	</div>
<?php //endif; ?> -->

<?php echo $this->fetch('content'); ?>