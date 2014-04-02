<?php
	$this->extend('/Common/login-topbar');
	$this->start('menu');
	$this->end(); 
?>

<section class="evoke login background">
	<div class="row full-width">
	  <div class="small-12 medium-6 large-5 small-centered columns">
	  	<img src = '<?= $this->webroot.'/img/evoke-69.png' ?>' alt = "" style = "margin: 0px auto; display: block; margin-bottom: 50px;">

	  	<div class="row full-width">
			<div class="small-4 medium-8 large-4 small-centered columns" style = "margin-top: -600px;">
			  	<div class="evoke users form top-border bottom-border">
			  		<h4 class = "evoke bottom-border"><?php echo __('Evoke Registration');?></h4>
					<?php echo $this->Form->create('User'); ?>
						<?php
							echo $this->Form->input('name', array('required' => true, 'label' => __('Name')));
							echo $this->Form->input('username', array('label' => __('Username')));
							echo $this->Form->input('password', array('label' => __('Password')));
						?>
					<?php //echo $this->Form->end(__('Submit')); ?>
					<button class="evoke button general" type="submit"><?php echo __('Register') ?></button>
				</div>
			</div>
		</div>

	  </div>
	</div>
</section>

