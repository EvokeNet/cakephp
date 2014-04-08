<?php
	$this->extend('/Common/login-topbar');
	$this->start('menu');
	$this->end(); 
?>

<section class="evoke login background">
	<div class="row full-width">
	
		<div class="medium-7 columns"><img src = '<?= $this->webroot.'img/bar.png' ?>' alt = "" class = "evoke login video-bar"></div>

		<div class="medium-5 columns">
			<img src = '<?= $this->webroot.'img/evoke-69.png' ?>' alt = "" class = "evoke login padding-bottom">
			
			<div id = "login-columns">
				<h4 class = "evoke bottom-border"><?php echo __('Evoke Registration');?></h4>

				<!-- <i class="fa fa-google-plus fa-2x" style = "position: absolute; top: 10px; left: 20px;"></i> -->
				<div class="evoke login users form">
					<?php echo $this->Form->create('User'); ?>
						<?php
							echo $this->Form->input('name', array('required' => true, 'label' => __('Name')));
							echo $this->Form->input('username', array('required' => true, 'label' => __('Username')));
							echo $this->Form->input('email', array('type' => 'email', 'required' => true));
							echo $this->Form->input('password', array('required' => true, 'label' => __('Password')));
						?>
					<?php //echo $this->Form->end(__('Submit')); ?>
					<button class="evoke button general" type="submit"><?php echo __('Register') ?></button>
				</div>
			</div>

		</div>
	</div>
</section>

