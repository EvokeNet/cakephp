<!-- ADMIN PANEL SIDE BAR -->
	<div class="large-2 columns padding left-0 top-1 gradient-on-right" data-equalizer-watch>

		<div class="side-menu">
		    <ul id="links" class="side-menu side-nav">
				<li id="statisticsLink" class ="active">
					<a href="<?= $this->Html->url(array('controller' => 'panels', 'action' => 'admin_main')) ?>">
						<?= __('Statistics') ?>
					</a>
				</li>
				<li id="usersLink" class="">
					<a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'index')) ?>">
						<?= __('Users') ?>
					</a>
				</li>
			<?php foreach($organizations as $o): ?>
				<li>
					<a href="<?= $this->Html->url(array('controller' => 'panels', 'action' => 'organization', $o['Organization']['id'])) ?>">
						<?= __('Organization ').$o['Organization']['name'] ?>
					</a>
				</li>
			<?php endforeach; ?>
		    </ul>
		</div>
	</div>