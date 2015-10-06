<div class="content background-color-dark-opacity-05 min-full-height">
	<!-- GROUP INFO -->
	<div class="padding left-1 right-1">
		<!-- GROUP TITLE -->
		<div class="text-center">
			<h4 class="text-color-highlight"><?= __('Group ').$group['title'] ?></h4>
		</div>

		<!-- LIST OF MEMBERS -->	
		<div class="padding top-2">
			<?php echo $this->element('Groups/member_list',array(
				'group' => $group,
				'groupOwner' => $group['Leader'],
				'members' => $group['Member'],
				'show_title' => false)); ?>
		</div>
	</div>

	<!-- EVOKATION PREVIEW -->
	<div class="text-center">
		<button class="button thin disabled"><?= __('Evokation preview') ?></button>
	</div>
</div>