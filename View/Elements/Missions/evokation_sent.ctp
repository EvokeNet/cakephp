<div class="row">
	<div class="column padding left-3 top-2 right-3 text-center">
		<h3 class="text-color-highlight">
			<?= __('Congratulations!') ?>
			<br/>
			<?=__('You have already finished this Evokation!') ?>
		</h3>
		<br/>
		<i class="fa fa-check-square-o check-icon green"></i>
		<br/>
		<h4 class="text-color-highlight"><?= __('View your Evokation:') ?></h4>
		<br/>
		<br/>
		<a class="button small open-mission-overlay large-4 medium-4 small-4 text-center" href="<?php echo $this->Html->url(array('controller' => 'evidences', 'action' => 'preview_evokation', 
					$evokation_id,
					$evokationQuests[0]['Quest']['mission_id'],
					$phase_id
				));?>">
			<i class="fa fa-eye text-color-highlight"></i>
			<span class="font-highlight text-color-highlight "><?= __('View') ?></span>
		</a>
	</div>
</div>