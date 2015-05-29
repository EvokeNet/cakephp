<dl class="tabs vertical table-cell full-width  margin right-1" id="questsTabs" data-tab>
	<?php 
		$counter = 1;
		$active = 'class = "active"';

		if (isset($phase['Quest'])) {
			foreach($phase['Quest'] as $q): 
				if($counter != 1)
					$active = null;
				?>
				<dd <?= $active ?>><a href="#quest<?= $counter ?>" class="text-glow-on-hover"><?= $q['title'] ?></a></dd>
				<?php
				$counter++;
			endforeach;

			//NO QUESTS: Show alert
			if (count($phase['Quest']) < 1) { ?>
				<div data-alert="" class="alert-box radius">
					<?= __('There are no quests available in this mission.') ?>
					<a href="" class="close">×</a>
				</div>
			<?php }
		}
	?>
</dl>

<div class="tabs-content table-cell vertical-align-top full-width gradient-on-left">
	<?php 
		$counter = 1;
		$active = 'active'; ?>

	<?php 
		if (isset($phase['Quest'])) {
			foreach($phase['Quest'] as $q): 
				if($counter != 1)
					$active = null;
				?>
		
		<div class="content <?= $active ?>" id="quest<?= $counter ?>">
			<div class = "margin right-1">
				<!-- QUEST TITLE AND DESCRIPTION -->
				<h3 class="text-color-highlight text-center"><?= $q['title'] ?></h3>
				<?= $q['description'] ?>

				<!-- REWARDS -->
				<h5 class="text-color-highlight text-center"><?= __('REWARDS') ?></h5>
				<p class="text-center"><?= __('Submitting an evidence for this quest is worth skills for these badges:') ?></p>
				<p class="text-center">
					<img class="evoke vertical-align-middle" src="<?= $this->webroot.'img/badge1.png' ?>" alt="Quests" />
					<img class="evoke vertical-align-middle" src="<?= $this->webroot.'img/badge2.png' ?>" alt="Quests" />
					<img class="evoke vertical-align-middle" src="<?= $this->webroot.'img/badge3.png' ?>" alt="Quests" />
				</p>
			   
			   <!-- QUEST RESPONSE OR CALL TO ACTION -->
				<div class="margin top-3"><?php
					//QUEST RESPONSE
					if ($q['has_completed']): ?>
						<div class="margin bottom-3 text-center">
							<h5 class="text-color-highlight"><?= __('Congratulations!') ?></h5>
							<p class="font-highlight"><?= __('You have already completed this quest!') ?></p>
						</div><?php

						//EVIDENCE OR BRAINSTORM
						if (($q['type'] == Quest::TYPE_EVIDENCE) || ($q['type'] == Quest::TYPE_BRAINSTORM)): ?>

							<p class="text-center"><?= __('This is the evidence you submitted:') ?><?php

							echo $this->element('Evidences/evidence_list_item',array('e' => $q['Response']));
						//GROUP CREATION
						elseif ($q['type'] == Quest::TYPE_GROUP_CREATION): ?>

							<p class="text-center"><?= __('Your group is:') ?><?php

							echo $this->element('Groups/group_box', array('group' => $q['Response']['Group']));
						endif;

					//CALL TO ACTION
					else:
						//EVIDENCE
						if ($q['type'] == Quest::TYPE_EVIDENCE): ?>
							<p class="text-center">
								<a class="button small open-mission-overlay" href="<?php echo $this->Html->url(array('controller'=> 'evidences', 'action' => 'add', $q['mission_id'], $q['phase_id'], $q['id'], 'false')); ?>">
									<?= __('Create your evidence') ?>
								</a>
							</p><?php

						//CREATE GROUP
						elseif ($q['type'] == Quest::TYPE_GROUP_CREATION): ?>
							<p class="text-center">
								<a class="button small open-mission-overlay" href="<?php echo $this->Html->url(array('controller'=> 'groups', 'action' => 'add', $q['id'])); ?>">
									<?= __('Create your group') ?>
								</a>
							</p><?php

							//JOIN EXISTING GROUPS
							if (!empty($q['Group'])): ?>
								<p class="text-center"> <?= __('Or join groups already created for this phase:') ?> </p>

								<?php
								foreach($q['Group'] as $group):
									echo $this->element('Groups/group_box', array('group' => $group));
								endforeach;
							endif;

						//BRAINSTORM
						elseif ($q['type'] == Quest::TYPE_BRAINSTORM): 
							//NO TIMELINE => NEEDS A GROUP (this checking can be improved)
							if (!isset($q['Timeline'])): ?>
								<div data-alert class="alert-box info radius">
									<p><?= __('Attention: You will be able to complete this quest once you join a group!') ?></p>
								</div><?php
							//DISPLAYS TIMELINE
							else: ?>
								<h5 class="text-color-highlight text-center"><?= __('EVIDENCE CREATION PROCESS') ?></h5><?php
								echo $this->element('BrainstormSessionEvoke.timeline',array('states' => $q['Timeline']));
							endif;

						//EVOKATION
						elseif ($q['type'] == Quest::TYPE_EVOKATION): ?>
							<p class="text-center">
								<a class="button small open-mission-overlay disabled">
									<?= __('Create your evokation') ?>
								</a>
							</p><?php
						endif;
					endif; ?>
				</div>
			</div>
		</div>

	<?php
			$counter++;
			endforeach;
		} ?>

</div>