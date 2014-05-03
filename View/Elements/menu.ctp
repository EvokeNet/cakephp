<div class = "evoke menu-bg">
	<ul class="evoke side-nav">
	  <li><a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'dashboard')) ?>"><i class="fa fa-folder-open"></i>     <?= strtoupper(__('Dashboard')) ?></a></li>
	  
	  <li><a href="<?= $this->Html->url(array('controller' => 'missions', 'action' => 'index')) ?>"><i class="fa fa-crosshairs"></i>     <?= strtoupper(__('Missions')) ?></a></li>
	  <li><a href="<?= $this->Html->url(array('controller' => 'badges', 'action' => 'index')) ?>"><i class="fa fa-shield"></i>     <?= strtoupper(__('Badges')) ?></a></li>
	  <li><a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'leaderboard')) ?>"><i class="fa fa-trophy"></i>     <?= strtoupper(__('Leaderboard')) ?></a></li>
	  <?php if($user['User']['role_id'] <= 2) : ?>
	  	<li><a href="<?= $this->Html->url(array('controller' => 'panels', 'action' => 'index')) ?>"><i class="fa fa-cogs"></i>     <?= strtoupper(__('Administration')) ?></a></li>
	  <?php endif ?>
	</ul>
</div>