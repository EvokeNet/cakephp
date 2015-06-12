<?php
//DEFAULT MENU BUTTONS
if (!isset($menu_buttons)) {
	$menu_buttons = array('Back','Quests','Dossier','Evidences','Forum');
}
?>


<nav class="tab-bar" id="tab-bar-off-canvas"><?php 
	//BACK BUTTON
	if (in_array('Back', $menu_buttons)): ?>
		<div class="close-sidebar-button fixed left-small text-center hidden">
			<a class="close-sidebar">
				<div class="row">
					<i class="fa fa-angle-double-left fa-2x"></i>
				</div>
				<div class="row menu-icon-label">
					<span><?= __('Back') ?></span>
				</div>
			</a>
		</div><?php
	endif;
	?>

	<section class="left-small" id="menu-left-small">
		<div class="left-small-content text-center background-color-standard opacity-07 padding bottom-1">
			<?php

			//QUESTS
			if (in_array('Quests', $menu_buttons)): ?>
				<a class="menu-icon default" id="menu-icon-tabQuests" data-tab-content="tabQuests">
					<div class="row">
						<span class="icon-brankic icon-compass fa-2x vertical-align-middle text-color-gray"></span>
					</div>
					<div class="row menu-icon-label">
						<span><?= __('Quests') ?></span>
					</div>
				</a><?php
			endif;

			//EVIDENCES
			if (in_array('Evidences', $menu_buttons)): ?>
				<a class="menu-icon default" id="menu-icon-tabEvidences" data-tab-content="tabEvidences">
					<div class="row">
						<span class="icon-brankic icon-wallet fa-2x vertical-align-middle text-color-gray"></span>
					</div>
					<div class="row menu-icon-label">
						<span><?= __('Evidences') ?></span>
					</div>
				</a><?php
			endif;

			//DOSSIER
			if (in_array('Dossier', $menu_buttons)): ?>
				<a class="menu-icon default" id="menu-icon-tabDossier" data-tab-content="tabDossier">
					<div class="row">
						<span class="icon-brankic icon-cabinet2 fa-2x vertical-align-middle text-color-gray"></span>
					</div>
					<div class="row menu-icon-label">
						<span><?= __('Dossier') ?></span>
					</div>
				</a><?php
			endif;

			//FORUM
			if (in_array('Forum', $menu_buttons)):
				if (isset($forum)): ?>
				
					<a class="menu-icon forum" id="menu-icon-tabForum" data-forum-url="<?php echo rawurldecode($this->Html->url(array(
						'plugin' => 'optimum',
						'controller' => 'forum',
						'action' => 'view',
						'general'
					))); ?>" data-tab-content="tabForum" data-forum-id="<?= $forum['id'] ?>">
						<div class="row">
							<span class="fa fa-lightbulb-o fa-2x vertical-align-middle text-color-gray"></span>
						</div>
						<div class="row menu-icon-label">
							<span><?= __('Discuss') ?></span>
						</div>
					</a><?php

				endif;
			endif;


			//GROUP FORUM
			if (in_array('GroupForum', $menu_buttons)):
				if (isset($group_forum)): ?>
				
					<a class="menu-icon forum" id="menu-icon-tabGroupForum"
						data-forum-url="<?php echo rawurldecode($this->Html->url(array(
							'plugin' => 'optimum',
							'controller' => 'forum',
							'action' => 'view',
							'group'
						))); ?>" data-tab-content="tabGroupForum" data-forum-id="<?= $group_forum['id'] ?>">
						<div class="row">
							<span class="fa fa-user fa-2x vertical-align-middle text-color-gray"></span>
						</div>
						<div class="row menu-icon-label">
							<span><?= __('Group') ?></span>
						</div>
					</a><?php

				endif;
			endif;
			?>
		</div>
	</section>
</nav>