<section class="login-bg-topbar">

	<div class="row">
		<div class="large-12 columns">
			<img src = '/evoke/webroot/img/evoke.png' alt = ""/>
			<h6 class = "evoke heading welcome"><?php echo __('WELCOME TO EVOKE NETWORK');?></h6>
			<?php echo $this->fetch('menu'); ?>
		</div>
	</div>
</section>

<?php echo $this->fetch('content'); ?>