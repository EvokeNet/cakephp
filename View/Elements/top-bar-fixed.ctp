<nav class="top-bar header-top-fixed" data-topbar role="navigation">
  <ul class="title-area">
    <li class="name">
      <h1><a href="#"><img src = '<?= $this->webroot.'img/Logo-Evoke-Atualizado.png' ?>' width = "150px"></a></h1>
    </li>
     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>

  <section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="right">
      <li class = "margin-right-1em"><?php //echo $this->element('level_progress_bar', array('class' => 'margin left-1 right-1 top-05')); ?></li>
      <li class = "divider"></li>
      <li class="has-dropdown">
        <a href="#" class = "uppercase"><?php echo sprintf(__('Agent %s'), AuthComponent::user('name')); ?></a>
        <ul class="dropdown">
          <li><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'edit', AuthComponent::user('id'))); ?>"><?php echo __('Edit profile'); ?></a></li>
          <li><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'logout')); ?>"><?php echo __('Log out'); ?></a></li>
        </ul>
      </li>
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
        <a href="<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'index')); ?>" class="font-green font-weight-bold uppercase">
          <?php echo __('Missions'); ?>
        </a>
      </li>

      <li>
        <a href="<?php echo $this->Html->url(array('controller' => 'forums', 'action' => 'index')); ?>" class="font-green uppercase font-weight-bold">
          <?php echo __('Forum'); ?>
        </a>
      </li>

      <li>
        <a href="<?php echo $this->Html->url(array('controller' => 'leaderboard', 'action' => 'index')); ?>" class="font-green uppercase font-weight-bold">
          <?php echo __('Leaderboard'); ?>
        </a>
      </li>

      <li>
        <a href="<?php echo $this->Html->url(array('controller' => 'badges', 'action' => 'index')); ?>" class="font-green uppercase font-weight-bold">
          <?php echo __('Badges'); ?>
        </a>
      </li>

      <li>
        <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'newprofile', AuthComponent::user('id'))); ?>" class="font-green uppercase font-weight-bold">
          <?php echo __('Profile'); ?>
        </a>
      </li>

      <?php if (AuthComponent::user('role') != 'user'): ?>
          <li>
            <a href="<?php echo $this->Html->url(array('controller' => 'admin_dashboards', 'action' => 'index')); ?>" class="font-green uppercase font-weight-bold">
              <?php echo __('Admin Dashboard'); ?>
            </a>
          </li>
    <?php endif; ?>

    </ul>
  </section>
</nav>
