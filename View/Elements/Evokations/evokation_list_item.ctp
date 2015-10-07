<!-- EVOKATION -->
<div class="table full-width profile-content padding top-1 bottom-1 left-2 right-2 border-bottom-divisor background-color-standard-opacity-07 background-color-light-dark-on-hover">
	
	<!-- EVOKATION INFO -->
	<div class="table-cell vertical-align-middle padding left-1">
		<a class="evokation-list-item-link" href="<?php echo $this->Html->url(array('controller' => 'evidences', 'action' => 'preview_evokation', 
			$g['Evokation'][0]['id'],
			$g['Group']['mission_id']

			)); ?>">
			<!-- EVOKATION TITLE -->
			<h5 class="text-color-highlight">
				<?= "EVOKATION TITLE" ?>
			</h5>

			<!-- GROUP NAME -->
			<p class="user-name margins-0 font-size-small">
				<?= __('By %s', $g['Group']['title']) ?>
			</p>
		</a>
	</div>
</div>