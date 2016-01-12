<nav class="top-bar header-top" data-topbar role="navigation">
  <ul class="title-area">
    <li class="name">
      <h1><a href="#"><img src = '<?= $this->webroot.'img/Logo-Evoke-Atualizado.png' ?>' width = "90%"></a></h1>
    </li>
     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>

  <section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="right">
      <li class="has-dropdown">
        <a href="#"><?php echo __('LANGUAGE'); ?></a>
        <ul class="dropdown">
          <li><a href="<?= $this->Html->url(array('action'=>'changeLanguage', 'en')) ?>"><?php echo __('ENGLISH'); ?></a></li>
          <li><a href="<?= $this->Html->url(array('action'=>'changeLanguage', 'es')) ?>"><?php echo __('SPANISH'); ?></a></li>
        </ul>
      <li class="divider"></li>
      <li class="has-dropdown">
        <a href="#"><?php echo __('AGENT'); ?></a>
        <ul class="dropdown">
          <li><a href="<?= $this->Html->url(array('action'=>'changeLanguage', 'en')) ?>"><?php echo __('ENGLISH'); ?></a></li>
          <li><a href="<?= $this->Html->url(array('action'=>'changeLanguage', 'es')) ?>"><?php echo __('SPANISH'); ?></a></li>
        </ul>
      <li class="divider"></li>
      <li class="has-dropdown">
        <a href="#"><?php echo __('LANGUAGE'); ?></a>
        <ul class="dropdown">
          <li><a href="<?= $this->Html->url(array('action'=>'changeLanguage', 'en')) ?>"><?php echo __('ENGLISH'); ?></a></li>
          <li><a href="<?= $this->Html->url(array('action'=>'changeLanguage', 'es')) ?>"><?php echo __('SPANISH'); ?></a></li>
        </ul>
      </li>
    </ul>

    <!-- Left Nav Section -->
    <ul class="left">
      <li>
        <a href="<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'index')); ?>" class="font-green uppercase font-weight-boldt">
          <?php echo __('Missions'); ?>
        </a>
      </li>

      <li>
        <a href="<?php echo $this->Html->url(array('controller' => 'forums', 'action' => 'index')); ?>" class="font-green uppercase font-weight-boldt">
          <?php echo __('Forum'); ?>
        </a>
      </li>

      <li>
        <a href="<?php echo $this->Html->url(array('controller' => 'leaderboard', 'action' => 'index')); ?>" class="font-green uppercase font-weight-boldt">
          <?php echo __('Leaderboard'); ?>
        </a>
      </li>

      <li>
        <a href="<?php echo $this->Html->url(array('controller' => 'badges', 'action' => 'index')); ?>" class="font-green uppercase font-weight-boldt">
          <?php echo __('Badges'); ?>
        </a>
      </li>
    </ul>
  </section>
</nav>
