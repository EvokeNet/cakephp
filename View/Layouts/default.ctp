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
  <meta http-equiv="X-UA-Compatible" content="IE=edge;" /> <!-- Forces IE to use the last compatible version -->

  <!-- FONTS -->
  <!--<link href='http://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>-->
  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Dosis&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>

  <?php echo $this->Html->charset(); ?>
  <title>
    <?php echo $title; ?>
  </title>
  <?php
    $cssInclude = strtolower($this->name);
    $cssFileName = strtolower($this->name).'.css';
    $cssBaseUrl = Configure::read('App.cssBaseUrl');

    echo $this->Html->meta('icon');

    //COMPONENTS CSS
    echo $this->Html->css('/components/font-awesome/css/font-awesome.min'); //Icon font - font-awesome
    echo $this->Html->css('/css/plugins/font-awesome'); //Overriding some of the font-awesome css

    echo $this->Html->css('/css/font/font-brankic'); //Icon font - brankic 1979

    //echo $this->Html->css('/components/foundation/css/foundation');
    //echo $this->Html->css('/css/plugins/foundation'); //Overriding some of the foundation css
    
    echo $this->Html->css('/css/foundation/stylesheets/app.css');

    echo $this->Html->css('/components/mrmrs-colors/css/colors.min');

    echo $this->Html->css('/components/FroalaWysiwygEditor/css/froala_style.min.css'); //Froala - rendering text
    echo $this->Html->css('/components/FroalaWysiwygEditor/css/froala_editor.min.css'); //Froala - rendering text
    echo $this->Html->css('/css/plugins/froala.css'); //Overriding some of the froala css

    echo $this->Html->css('/components/sweetalert/dist/sweetalert.css'); //Sweet alert - alert boxes
    echo $this->Html->css('/css/plugins/sweetalert.css'); //Overriding some of the sweet alert css

    //EVOKE CSS
    // echo $this->Html->css('evoke');

    echo $this->Html->css('general');

    //FILE-SPECIFIC CSS
    if(file_exists(WWW_ROOT.$cssBaseUrl.$cssFileName)) {
      echo $this->Html->css($cssInclude); //CSS for each view set
    }

    //VIEW-SPECIFIC CSS
    echo $this->fetch('css');

    //META
    echo $this->fetch('meta');
    echo $this->fetch('social-metatags');

  ?>
  <!--<script src="http://localhost:8000/socket.io/socket.io.js"></script>
  <script src="http://localhost:3000/socket.io/socket.io.js"></script>-->
</head>
<body class="evoke">
  <section role="main body" class="full-height">
    <?php

    //TOPBAR
    if ($this->fetch('topbar')) {
      echo $this->fetch('topbar');
    }

    //IMAGE HEADER
     if ($this->fetch('image_header')) {
      echo $this->fetch('image_header');
     }

    //CONTENT
    echo $this->fetch('content');

    //FOOTER
    // if ($this->fetch('footer')) {
    //  echo $this->fetch('footer');
    // }
    ?>
  </section>


  <script type="text/javascript">
        var webroot = "<?php echo Router::url('/', true); ?>";
    </script>
    <?php
      //REQUIREJS BOOTSTRAP
      echo $this->Html->script("/components/requirejs/require", array('data-main' => $this->webroot.'js/requirejs/bootstrap'));
      
      echo $this->Html->script("node_modules/react");

      //EVOKEDATA MODULE: FETCH JAVASCRIPT VARIABLES FROM VIEWS
    $this->Html->scriptStart(array('inline' => false)); ?>
    require(['<?= $this->webroot ?>js/requirejs/bootstrap'], function () {
      require(['evokedata'], function (evokeData) {
        evokeData.webroot  = "<?php echo Router::url('/', true); ?>";
        evokeData.language = "<?php echo $language; ?>";
        <?php echo $this->fetch('evoke_javascript_variables') ?>;
      });
    }); <?php
    $this->Html->scriptEnd();

      //SCRIPTS IN EACH VIEW
    echo $this->fetch('script');
  ?>

  <script>
/*
    //socket io client
    var socket = io.connect('http://localhost:8000');

    //on connetion, updates connection state and sends subscribe request
    socket.on('connect', function(data){
      setStatus('connected');
      socket.emit('subscribe', {channel:'notif'});
      socket.emit('subscribe', {channel:'notifs'});
    });

    //when reconnection is attempted, updates status
    socket.on('reconnecting', function(data){
      setStatus('reconnecting');
    });


    socket.on('popup', function (data) {
      $('#firstModal').foundation('reveal', 'open');
      });
*/
  </script>

</body>
</html>
