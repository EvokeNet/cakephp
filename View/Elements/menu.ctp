<div class = "evoke menu-bg">
	<ul class="inline-list">
	  <li><a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $user['User']['id'])) ?>"><?= strtoupper(__('Dashboard')) ?></a></li>
	  <li><a href="#"><?= strtoupper(__('Badges')) ?></a></li>
	  <li><a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'leaderboard')) ?>"><?= strtoupper(__('Leaderboard')) ?></a></li>
	  <?php if($user['User']['role_id'] <= 2) : ?>
	  	<li><a href="<?= $this->Html->url(array('controller' => 'panels', 'action' => 'index')) ?>"><?= strtoupper(__('Administration')) ?></a></li>
	  <?php endif ?>
	</ul>
</div>