<div class="content background-color-dark-opacity-05 min-full-height">
	<!-- GROUP AREA -->
	<div class="full-width">
		<!-- GROUP BOX -->
		<div class="padding top-2 bottom-3">
			<h2 class="text-color-highlight text-center">
				<?= $group['title'] ?>
			</h2>

			<?php
			//GROUP FORUM BUTTON
			$forum_group_id = '';

			if (isset($group['Forum'])) {
				$forum_group_id = $group['Forum']['id'];
			} ?>

			<!-- GROUP BOX -->
			<div class="padding left-1">
				<?php echo $this->element('Groups/group_box',array('group' => $group, 'show_title' => false)); ?>
			</div>
		</div>

		<div class="padding left-1 right-1">
			<!-- GROUP INFO -->
			<div class="text-center">
				<h5 class="text-color-highlight"><?= __('Team leader');?></h5>
				<p><?= $group['Leader']['name'] ?></p>
			</div>

			<!-- LIST OF MEMBERS -->
			<div class="padding top-2">
				<h4 class="text-color-highlight text-center"><?= __('Members') ?><?= ': '.count($group['Member']) ?></h4>

				<?php echo $this->element('Groups/member_list',array(
					'group' => $group,
					'groupOwner' => $group['Leader'],
					'members' => $group['Member'],
					'show_title' => false)); ?>

				<?php
				//OWNER CAN SEE REQUESTS
				if ($group['is_owner']): ?>
					<div class="padding top-2 bottom-2">
						<h4 class="text-color-highlight text-center"><?= __('Requests') ?></h4>

						<?php echo $this->element('Groups/request_tabs',array(
							'group' => $group,
							'groupOwner' => $group['Leader'],
							'groupsRequestsPending' => $group['GroupRequestsPending'],
							'groupsRequests' => $group['GroupRequestsDone'],
							'show_title' => false)); ?>
					</div> <?php
				endif; ?>
			</div>
		</div>
	</div>
</div>

<?php
	//SCRIPT
	$this->Html->script('requirejs/app/Elements/Missions/panel_group_area.js', array('inline' => false));
?>
