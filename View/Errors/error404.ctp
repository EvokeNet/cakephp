<style>
#full-screen-background-image {
  /*z-index: -999;*/
  min-height: 100%;
  min-width: 1024px;
  width: 100%;
  height: auto;
  position: fixed;
  top: 0;
  left: 0;
}

#wrapper {
  position: relative;
  width: 800px;
  min-height: 400px;
  margin: 100px auto;
  color: #333;
  z-index: 10;
}
</style>
<?php
/**
 *
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Errors
 * @since         CakePHP(tm) v 0.10.0.1076
 */
?>
<h2><?php echo $name; ?></h2>
<p class="error">
	<strong><?php echo __d('cake', 'Error'); ?>: </strong>
	<?php printf(
		__d('cake', 'The requested address %s was not found on this server.'),
		"<strong>'{$url}'</strong>"
	); ?>
</p>

<img alt="full screen background image" src="<?= $this->webroot.'img/error_page_50.png' ?>" id="full-screen-background-image" /> 
<div id="wrapper">
<p>Content goes here...</p>
</div>
  
<?php
if (Configure::read('debug') > 0):
	echo $this->element('exception_stack_trace');
endif;
?>
