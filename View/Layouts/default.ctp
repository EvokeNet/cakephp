<?php
/**
 *
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('/components/foundation/css/foundation.min');
		echo $this->Html->css('/components/mrmrs-colors/css/colors.min');
		echo $this->Html->css('/components/font-awesome/css/font-awesome.min');
		echo $this->Html->css('evoke');

		echo $this->fetch('meta');
		echo $this->fetch('css');

	?>
</head>
<body>

	<section role="main">
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
	</section>

	<footer class="evoke margin top-2">
		<div class="row">
			<div class="large-12 columns">
				<?php echo $this->element('sql_dump'); ?>
			</div>
		</div>
	</footer>

	<?php echo $this->Html->script('/components/jquery/dist/jquery.min') ?>
	<?php echo $this->Html->script('/components/foundation/js/foundation.min') ?>
	<?php echo $this->Html->script('evoke') ?>

	<?php echo $this->fetch('script'); ?>

</body>
</html>
