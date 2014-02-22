<?php
  $this->extend('/Common/topbar');
  $this->start('menu');
?>

<nav class="top-bar" data-topbar>
  <ul class="title-area">
    <li class="name">
      <h1><?php echo $user['User']['name']; ?></h1>
    </li>
    <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
  </ul>

  <section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="right">
      <li class="has-dropdown">
        <a href="#">Settings</a>
        <ul class="dropdown">
          <li><?php echo $this->Html->link(__('Edit informations'), array('controller' => 'users', 'action' => 'edit', $user['User']['id'])); ?></li>
          <li><?php echo $this->Html->link(__('Sign Out'), array('controller' => 'users', 'action' => 'logout')); ?></li>
        </ul>
      </li>
    </ul>

    <!-- Left Nav Section -->
    <ul class="left">
      <li><?php echo $this->Html->link(__('Dashboard'), array('controller' => 'users', 'action' => 'dashboard', $user['User']['id'])); ?></li>
    </ul>
  </section>
</nav>

<?php $this->end(); ?>

<section class="evoke margin top-2">
  <div class="row">
    <div class="medium-9 columns">
    <h1><?php echo __('Leadercloud');?></h1>
      <dl class="tabs" data-tab>
        <dd class="active"><a href="#panel2-1"><?php echo __('Weekly');?></a></dd>
        <dd><a href="#panel2-2"><?php echo __('Monthly');?></a></dd>
        <dd><a href="#panel2-3"><?php echo __('By Mission');?></a></dd>
        <dd><a href="#panel2-4"><?php echo __('By Issue');?></a></dd>
        <dd><a href="#panel2-5"><?php echo __('By Badges');?></a></dd>
      </dl>
      <div class="tabs-content">
        <div class="content active" id="panel2-1">
          <p>First panel content goes here...</p>
        </div>
        <div class="content" id="panel2-2">
          <p>Second panel content goes here...</p>
        </div>
        <div class="content" id="panel2-3">
          <p>Third panel content goes here...</p>
        </div>
        <div class="content" id="panel2-4">
          <p>Fourth panel content goes here...</p>
        </div>
        <div class="content" id="panel2-5">
          <p>Fifth panel content goes here...</p>
        </div>
      </div>
    </div>
    <div class="medium-3 columns"></div>
  </div>
</section>