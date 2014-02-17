<?php
/**
 *
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 */

$title = __('Evoke Network');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');


		echo $this->Html->css('cake.generic');
		echo $this->Html->css('missions');
		echo $this->Html->css(array('/webroot/components/foundation/css/foundation.min'),'stylesheet', array('inline' => false ));

		echo $this->Html->script('/webroot/components/jquery/jquery.min');
		echo $this->Html->script('/webroot/components/foundation/js/foundation.min');

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

	</div>
	<?php //echo $this->element('sql_dump'); ?>

	</footer>

	<?php echo $this->Html->script('/components/jquery/jquery.min') ?>
	<?php echo $this->Html->script('/components/foundation/js/foundation.min') ?>
	<?php echo $this->Html->script('evoke') ?>

	<?php echo $this->fetch('script'); ?>


</body>
</html>
