<div class = "evoke menu-bg">
	<div>
	<ul class="inline-list">
	  <li><a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $user['User']['id'])) ?>"><?= strtoupper(__('Dashboard')) ?></a></li>
	  <li><a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'feed')) ?>"><?= strtoupper(__('Feed')) ?></a></li>
	  <li><a href="<?= $this->Html->url(array('controller' => 'badges', 'action' => 'view')) ?>"><?= strtoupper(__('Badges')) ?></a></li>
	  <li><a href="<?= $this->Html->url(array('controller' => 'badges', 'action' => 'view')) ?>"><?= strtoupper(__('Allies')) ?></a></li>
	  <li><a href="<?= $this->Html->url(array('controller' => 'panels', 'action' => 'index')) ?>"><?= strtoupper(__('Administration')) ?></a></li>
	</ul>
	</div>
</div>