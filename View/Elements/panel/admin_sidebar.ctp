<!-- ADMIN PANEL SIDE BAR -->
	<div class="large-2 columns padding left-0 top-1 gradient-on-right" data-equalizer-watch>

		<div class="side-menu hidden" id="side-menu">
		    <ul id="links" class="side-menu side-nav">
				<li class="evoke side-menu">
					<a href="<?= $this->Html->url(array('controller' => 'panels', 'action' => 'admin_main')) ?>" 
						class="evoke side-menu button split">
						<?= __('Statistics') ?>
					</a>
				</li>
				<!-- USERS -->
				<li class="evoke side-menu">
					<a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'index')) ?>" 
						class="evoke side-menu button split">
						<?= __('Users') ?>
						<span data-dropdown="users_hover"></span>
					</a>
					<ul id="users_hover" class='f-dropdown' data-dropdown-content>
						<li id="usersLink">
							<a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'index')) ?>">
								<?= __('Index') ?>
							</a>
						</li>
						<li id="usersLink">
							<a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'add')) ?>">
								<?= __('New User') ?>
							</a>
						</li>
					</ul>	
				</li>
				<!-- SUPER HERO IDENTITIES -->
				<li class="evoke side-menu">
					<a href="<?= $this->Html->url(array('controller' => 'SuperheroIdentities', 'action' => 'index')) ?>" 
						class="evoke side-menu button split">
						<?= __('Super Hero Identities') ?>
						<span data-dropdown="superhero_hover"></span>
					</a>
					<ul id="superhero_hover" class='f-dropdown' data-dropdown-content>
						<li id="superheroLink">
							<a href="<?= $this->Html->url(array('controller' => 'SuperheroIdentities', 'action' => 'index')) ?>">
								<?= __('Index') ?>
							</a>
						</li>
						<li id="superheroLink">
							<a href="<?= $this->Html->url(array('controller' => 'SuperheroIdentities', 'action' => 'add')) ?>">
								<?= __('New Super Hero Identity') ?>
							</a>
						</li>
					</ul>	
				</li>
				<!-- SOCIAL INNOVATOR QUALITIES -->
				<li class="evoke side-menu">
					<a href="<?= $this->Html->url(array('controller' => 'SocialInnovatorQualities', 'action' => 'index')) ?>" 
						class="evoke side-menu button split">
						<?= __('Qualities') ?>
						<span data-dropdown="qualities_hover"></span>
					</a>
					<ul id="qualities_hover" class='f-dropdown' data-dropdown-content>
						<li id="qualitiesLink">
							<a href="<?= $this->Html->url(array('controller' => 'SocialInnovatorQualities', 'action' => 'index')) ?>">
								<?= __('Index') ?>
							</a>
						</li>
						<li id="qualitiesLink">
							<a href="<?= $this->Html->url(array('controller' => 'SocialInnovatorQualities', 'action' => 'add')) ?>">
								<?= __('New Quality') ?>
							</a>
						</li>
					</ul>	
				</li>
				<!-- POWERS -->
				<li class="evoke side-menu">
					<a href="<?= $this->Html->url(array('controller' => 'powers', 'action' => 'index')) ?>" 
						class="evoke side-menu button split">
						<?= __('Powers') ?>
						<span data-dropdown="powers_hover"></span>
					</a>
					<ul id="powers_hover" class='f-dropdown' data-dropdown-content>
						<li id="powersLink">
							<a href="<?= $this->Html->url(array('controller' => 'powers', 'action' => 'index')) ?>">
								<?= __('Index') ?>
							</a>
						</li>
						<li id="powersLink">
							<a href="<?= $this->Html->url(array('controller' => 'powers', 'action' => 'add')) ?>">
								<?= __('New Power') ?>
							</a>
						</li>
					</ul>	
				</li>
				<!-- BADGES -->
				<li class="evoke side-menu">
					<a href="<?= $this->Html->url(array('controller' => 'badges', 'action' => 'index')) ?>" 
						class="button split evoke side-menu">
						<?= __('Badges') ?>
						<span data-dropdown="badges_hover"></span>
					</a>
					<ul id="badges_hover" class='f-dropdown' data-dropdown-content>
						<li id="badgesLink">
							<a href="<?= $this->Html->url(array('controller' => 'badges', 'action' => 'index')) ?>">
								<?= __('Badges') ?>
							</a>
						</li>
						<li id="badgesLink">
							<a href="<?= $this->Html->url(array('controller' => 'badges', 'action' => 'add')) ?>">
								<?= __('New Badge') ?>
							</a>
						</li>
					</ul>	
				</li>
				<li class="evoke side-menu">
					<a href="<?= $this->Html->url(array('controller' => 'forums', 'action' => 'index')) ?>" 
						class="button split evoke side-menu">
						<?= __('Forums') ?>
						<span data-dropdown="forums_hover"></span>
					</a>
					<ul id="forums_hover" class='f-dropdown' data-dropdown-content>
						<li id="forumsLink">
							<a href="<?= $this->Html->url(array('controller' => 'forums', 'action' => 'index')) ?>">
								<?= __('Forums') ?>
							</a>
						</li>
						<li id="forumsLink">
							<a href="<?= $this->Html->url(array('controller' => 'forums', 'action' => 'add')) ?>">
								<?= __('New Forum') ?>
							</a>
						</li>
						<hr class="evoke margins-0">
						<li id="forumsLink">
							<a href="<?= $this->Html->url(array('controller' => 'forum_categories', 'action' => 'index')) ?>">
								<?= __('Forum Categories') ?>
							</a>
						</li>
						<li id="forumsLink">
							<a href="<?= $this->Html->url(array('controller' => 'forum_categories', 'action' => 'add')) ?>">
								<?= __('New Forum Category') ?>
							</a>
						</li>
					</ul>	
				</li>
				<li class="evoke side-menu">
					<a href="<?= $this->Html->url(array('controller' => 'panels', 'action' => 'organizations'))?>" 
						class="evoke side-menu button split">
						<?= __('Organizations') ?>
						<span data-dropdown="organizations_hover"></span>
					</a>
					<ul id="organizations_hover" class='f-dropdown' data-dropdown-content>
			<?php foreach($organizations as $o): ?>
						<li>
							<a href="<?= $this->Html->url(array('controller' => 'panels', 'action' => 'organization', $o['Organization']['id'])) ?>">
								<?= $o['Organization']['name'] ?>
							</a>
						</li>
			<?php endforeach; ?>
					</ul>	
				</li>
		    </ul>
		</div>
	</div>
<?php
	//SCRIPT
  	$this->Html->script('requirejs/app/Panels/side-menu.js', array('inline' => false));
?>