<div class = "evoke fatal-error">
	<img src = "<?= $this->webroot.'img/Evoke-error' ?>"/>
	<div class = "block">
		<h1> <?= __("Shadow Network just invaded Evoke's servers") ?></h1>

		<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'dashboard')); ?>" class="button general info"><?= __('Go back to dashboard') ?></a>
	</div>
</div>