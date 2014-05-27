<?php
	$this->extend('/Common/login-topbar');
	$this->start('menu');
	$this->end(); 
?>

<section class = "evoke login background">
	<div class="row full-width">
	
		<br>
		<br>
		<div class="small-12 medium-12 large-12 columns">
			<div class="small-3 medium-3 large-3 columns">
				<div>
					<span>&nbsp;</span>
				</div>
			</div>
			<div class="small-6 medium-6 large-6 columns">
				<div class="evoke evidence-tag text-align-center margin bottom-2">
					<h3><?= __('Password Recovery')?></h3>
					<?php echo $this->Form->create('User'); ?>
					
					<?php 
						echo $this->Form->input('username');//, array('label' => false));
						echo $this->Form->input('password');//, array('label' => false));
						echo $this->Form->input('captcha', array('label' => 'Calculate this: '.$captcha));
					?>
					<button class="evoke button general" type="submit">
						<?php echo __('Send email'); ?>
					</button>
					<?php echo $this->Form->end(); ?>
				</div>
			</div>
			<div class="small-3 medium-3 large-3 columns">
				<div>
					<span>&nbsp;</span>
				</div>
			</div>
			
			
		</div>

		
	</div>
</section>
<?php 
	echo $this->Html->script('/components/jquery/jquery.min.js');//, array('inline' => false));
	//echo $this->Html->script('/components/foundation/js/foundation.min.js');
	//echo $this->Html->script('/components/foundation/js/foundation.min.js', array('inline' => false));
	echo $this->Html->script("https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js", array('inline' => false));
?>