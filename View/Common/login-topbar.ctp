<section class="login-bg-topbar">

	<div class="row">
		<div class="large-12 columns">
			<div class = "evoke text-align-center"><img src = '<?= $this->webroot.'img/Logo-Evoke-Vectorizado.png' ?>' width = "40%"></div>
			<h4><?= strtoupper(__('WELCOME TO EVOKE NETWORK'));?></h4>
			<?php echo $this->fetch('menu'); ?>
		</div>
	</div>
</section>

<?php echo $this->fetch('content'); ?>