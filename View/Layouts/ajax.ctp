<!-- CONTENT -->
<?php echo $this->fetch('content'); ?>

<!-- EVOKEDATA MODULE: FETCH JAVASCRIPT VARIABLES FROM VIEWS -->
<?php
	$this->Html->scriptStart(array('inline' => false)); ?>
	require(['<?= $this->webroot ?>js/requirejs/bootstrap'], function () {
		require(['evokedata'], function (evokeData) {
			<?php echo $this->fetch('evoke_javascript_variables') ?>;
		});
	}); <?php
	$this->Html->scriptEnd();
?>

<!-- SCRIPT -->
<?php echo $this->fetch('script'); ?>