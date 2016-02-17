<nav class="top-bar" data-topbar role="navigation">
  <ul class="title-area">
    <li class="name">
      <h1><a href="#"><img src = '<?= $this->webroot.'img/Logo-Evoke-Atualizado.png' ?>' width = "125px"></a></h1>
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
          <li><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', 'admin' => false, AuthComponent::user('id'))); ?>"><?php echo __('View profile'); ?></a></li>
          <li><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'edit', 'admin' => false, AuthComponent::user('id'))); ?>"><?php echo __('Edit profile'); ?></a></li>
          <li><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'logout', 'admin' => false)); ?>"><?php echo __('Log out'); ?></a></li>
        </ul>
      </li>
      <li class="divider"></li>
      <li class="has-dropdown">
        <!--<a href="#"><?php echo __('LANGUAGE'); ?></a>-->
        <a href="#"><i class="fa fa-language fa-lg"></i></a>
        <ul class="dropdown">
          <li><a href="<?= $this->Html->url(array('action'=>'changeLanguage', 'admin' => false, 'en')) ?>"><?php echo __('ENGLISH'); ?></a></li>
          <li><a href="<?= $this->Html->url(array('action'=>'changeLanguage', 'admin' => false, 'es')) ?>"><?php echo __('SPANISH'); ?></a></li>
        </ul>
      </li>
    </ul>

    <!-- Left Nav Section -->
    <ul class="left">
      <li>
        <a href="<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'index', 'admin' => false)); ?>" class="font-green uppercase">
          <?php echo __('Missions'); ?>
        </a>
      </li>

      <li>
        <a href="<?php echo $this->Html->url(array('controller' => 'forums', 'action' => 'index', 'admin' => false)); ?>" class="font-green uppercase">
          <?php echo __('Forum'); ?>
        </a>
      </li>

      <li>
        <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'leaderboard', 'admin' => false)); ?>" class="font-green uppercase">
          <?php echo __('Leaderboard'); ?>
        </a>
      </li>

      <li>
        <a href="<?php echo $this->Html->url(array('controller' => 'badges', 'action' => 'index', 'admin' => false)); ?>" class="font-green uppercase">
          <?php echo __('Badges'); ?>
        </a>
      </li>

      <li>
        <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', 'admin' => false, AuthComponent::user('id'))); ?>" class="font-green uppercase">
          <?php echo __('Profile'); ?>
        </a>
      </li>
      <?php if ($loggedInUser['role'] <= $scores['ADMIN']): ?>
      
          <li>
            <a href="<?php echo $this->Html->url(array('controller' => 'panels', 'action' => 'main', 'admin' => true)); ?>" class="font-green uppercase">
              <?php echo __('Admin Panel'); ?>
            </a>
          </li>
    <?php endif; ?>

    </ul>
  </section>
</nav>
