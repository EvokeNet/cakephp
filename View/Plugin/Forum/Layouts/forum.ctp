<?php
echo $this->Html->docType();
echo $this->OpenGraph->html(); ?>
<head>
    <?php echo $this->Html->charset(); ?>
    <title><?php echo $this->Breadcrumb->pageTitle($settings['name'], array('separator' => $settings['titleSeparator'])); ?></title>
    <?php
    //echo $this->Html->css('Admin.titon.min');
    echo $this->Html->css('Admin.font-awesome.min');
    echo $this->Html->css('Admin.style');
    echo $this->Html->css('Forum.style');

    echo $this->Html->css('/webroot/css/evoke');
    echo $this->Html->css('/webroot/css/forum');
    echo $this->Html->css('/webroot/components/foundation/css/foundation.min');
    echo $this->Html->css('/webroot/components/mrmrs-colors/css/colors.min');
    echo $this->Html->css('/webroot/components/font-awesome/css/font-awesome.min');

    echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
    echo $this->Html->script('Admin.titon.min');
    echo $this->Html->script('Forum.forum');
    
    echo $this->Html->script('/webroot/components/foundation/js/foundation.js');
    echo $this->Html->script('/webroot/js/footer_bind');
    echo $this->Html->script('/webroot/js/menu_height', array('inline' => false));

    if ($this->params['controller'] === 'forum') {
        echo $this->Html->meta(__d('forum', 'RSS Feed - Latest Topics'), array('action' => 'index', 'ext' => 'rss'), array('type' => 'rss'));
    } else if (isset($rss)) {
        echo $this->Html->meta(__d('forum', 'RSS Feed - Content Review'), array($rss, 'ext' => 'rss'), array('type' => 'rss'));
    }

    $locales = $config['Decoda']['locales'];

    $this->OpenGraph->name($settings['name']);
    $this->OpenGraph->locale(array($locales[Configure::read('Config.language')], $locales[$settings['defaultLocale']]));

    echo $this->OpenGraph->fetch();
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script'); 

?>

</head>
<body class="controller-<?php echo $this->request->controller; ?>">
    <div class="evoke skeleton">
        <header class="head">
            <?php //echo $this->element('navigation'); ?>
        </header>

        <div class="body action-<?php echo $this->action; ?> default-background evoke no-padding">
            <?php 
                echo $this->Session->flash();
                echo $this->fetch('content'); 
            ?>
        </div>

        <footer class="footer" id="footer">
            <div class="row">
                <div class="small-12 medium-12 large-12 columns">
                    <div class="row">
                      <div class="small-5 small-centered columns">
                      
                        <div class = "evoke footer-margin-top">
                            <h2><?php echo strtoupper(__('Evoke'));?></h2>
                            <h6>2014 &nbsp;&nbsp; EVOKE | <?= __('Report an issue') ?> | <a href = "<?= $this->Html->url(array('controller' => 'pages', 'action' => 'terms'))?>" target="_blank"><?= __('Terms of Service') ?></a></h6>
                            <div class = "evoke footer-world-bank"><img src = '<?= $this->webroot.'img/wblogo.png' ?>' alt = ""/></div>
                        </div>
                        
                      </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>