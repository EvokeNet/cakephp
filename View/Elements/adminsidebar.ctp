<!-- Sidebar -->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <a href="<?= $this->Html->url(array('controller' => 'panels', 'action' => 'admin_main', 'admin' => true))?>" class = "uppercase">
                <?= __('HOME') ?>
            </a>
        </li>
        <li id = "users">
            <a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'index', 'admin' => true))?>" class = "uppercase"><?= __('Users') ?></a>
        </li>
        <li id = "badges">
            <a href="<?= $this->Html->url(array('controller' => 'badges', 'action' => 'index', 'admin' => true))?>" class = "uppercase"><?= __('Badges') ?></a>
        </li>
        <li id = "forums">
            <a href="<?= $this->Html->url(array('controller' => 'forums', 'action' => 'index', 'admin' => true))?>" class = "uppercase"><?= __('Forums') ?></a>
        </li>
        <li id = "missions">
            <a href="<?= $this->Html->url(array('controller' => 'missions', 'action' => 'admin_index', 'admin' => true))?>" class = "uppercase"><?= __('Missions') ?></a>
        </li>
        <li id = "organizations">
            <a href="<?= $this->Html->url(array('controller' => 'organizations', 'action' => 'admin_index', 'admin' => true))?>" class = "uppercase"><?= __('Organizations') ?></a>
        </li>
    </ul>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script> 
    $("li#<?=$this->params['controller']?>").addClass("selected");
</script>
