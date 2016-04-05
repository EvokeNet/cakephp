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
  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Dosis&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
  
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.13.3/react.js"></script>-->
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.13.3/JSXTransformer.js"></script>-->
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/6.1.19/browser.js"></script>-->
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
    
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.15.0-alpha.1/react.js"></script>-->
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.15.0-alpha.1/react-with-addons.js"></script>-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.13.3/JSXTransformer.js"></script>
  
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.7/react.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.7/react-dom.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.23/browser.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/0.3.5/marked.min.js"></script>-->
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.23/browser.min.js"></script>
  
  <!--<link data-require="bootstrap@3.3.2" data-semver="3.3.2" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />-->
    <!--<script data-require="jquery@2.1.3" data-semver="2.1.3" src="http://code.jquery.com/jquery-2.1.3.min.js"></script>-->
    <!--<script data-require="bootstrap@3.3.2" data-semver="3.3.2" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>-->
    <!--<script data-require="immutable.js@3.0.3" data-semver="3.0.3" src="//cdnjs.cloudflare.com/ajax/libs/immutable/3.0.3/immutable.js"></script>
    <script data-require="lodash.js@3.8.0" data-semver="3.8.0" src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.8.0/lodash.js"></script>-->
    <!--<script data-require="react-with-addons@0.12.2" data-semver="0.12.2" src="http://fb.me/react-with-addons-0.12.2.js"></script>-->
    
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

    //echo $this->Html->css('/css/font/font-brankic'); //Icon font - brankic 1979

    //echo $this->Html->css('/components/foundation/css/foundation');
    //echo $this->Html->css('/css/plugins/foundation'); //Overriding some of the foundation css
    
    echo $this->Html->css('/css/foundation/stylesheets/app.css');

    echo $this->Html->css('/components/mrmrs-colors/css/colors.min');

    echo $this->Html->css('/components/FroalaWysiwygEditor/css/froala_style.min.css'); //Froala - rendering text
    echo $this->Html->css('/components/FroalaWysiwygEditor/css/froala_editor.min.css'); //Froala - rendering text
    echo $this->Html->css('/css/plugins/froala.css'); //Overriding some of the froala css

    echo $this->Html->css('/components/sweetalert/dist/sweetalert.css'); //Sweet alert - alert boxes
    echo $this->Html->css('/css/plugins/sweetalert.css'); //Overriding some of the sweet alert css

    // ALCHEMY JS
    echo $this->Html->css("/alchemyjs/alchemy.css");

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

    // ALCHEMY JS
    echo $this->Html->script("/webroot/alchemyjs/scripts/vendor.js");
    echo $this->Html->script("/webroot/alchemyjs/alchemy.min.js");
    echo $this->Html->script("/webroot/alchemyjs/alchemy.js");

    echo $this->Html->script("/webroot/components/react/react.js");
    echo $this->Html->script("/webroot/components/react/react-dom.js");
    echo $this->Html->script("/webroot/components/react/react-with-addons.js");
    
    // echo $this->Html->script("/webroot/components/immutable/dist/immutable.js");
    // echo $this->Html->script("/webroot/components/lodash/dist/lodash.js");
    
    // echo $this->Html->script("//node_modules/react/dist/react.js");
    // echo $this->Html->script("//node_modules/react/dist/react-with-addons.js");
    // echo $this->Html->script("//node_modules/react-dom/dist/react-dom.js");
    
  ?>
  
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.7/react.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.7/react-dom.js"></script>-->
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.23/browser.min.js"></script>-->
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/0.3.5/marked.min.js"></script>-->
  
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
      
    //   echo $this->Html->script("node_modules/react");

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
