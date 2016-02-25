<?php
  $this->start('topbar');
  echo $this->element('topbar-fixed');
  $this->end();
?>

<div id="wrapper">

		<?php echo $this->element('admin_sidebar'); ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <div class="container-fluid">

                  <?php echo $this->fetch('page_content'); ?>

        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<?php $this->Html->script('requirejs/app/Panels/main.js', array('inline' => false)); ?>
