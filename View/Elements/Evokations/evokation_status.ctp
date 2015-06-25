<ul class="no-marker">
<?php
//EVOKATION
$evokation_id = null;
if (isset($group['Evokation'])) {
	$evokation_id = $group['Evokation'][0]['id'];
}

//EVOKATION QUESTS
foreach ($evokationQuests as $key => $quest): ?>
	<li>
		<p>
		<?php
		switch ($quest['Quest']['status']) {
			case Quest::STATUS_IN_PROGRESS: ?>
				<a class="button thin open-mission-overlay" href="<?php echo $this->Html->url(array('controller' => 'evidences', 'action' => 'edit', 
					$evidence_id
				));?>">
					<i class="fa fa-check-circle green"></i>
					<span class="font-highlight green"><?= $quest['Quest']['title'] ?></span>
				</a><?php
				__('(in progress)');
				break;
			case Quest::STATUS_NOT_STARTED: ?>
				<a class="button thin open-mission-overlay" href="<?php echo $this->Html->url(array('controller' => 'evidences', 'action' => 'add', 
						$quest['Quest']['mission_id'],
						$phase_id,
						$quest['Quest']['id'],
						$evokation_id
					));?>">
					<i class="fa fa-pencil text-color-highlight"></i>
					<span class="font-highlight text-color-highlight"><?= $quest['Quest']['title'] ?></span>
				</a> <?php
				__('(start now)');
				break;
			//NOT READY YET
			case 300: ?>
				<i class="fa fa-star-o text-color-highlight"></i>
				<span class="font-highlight text-color-highlight"><?= $quest['Quest']['title'] ?></span> <?php
				__('()');
		}
		?>
		</p>
	</li><?php
endforeach;
?>
</ul>