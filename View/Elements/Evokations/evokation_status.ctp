<ul class="no-marker">
<?php


//print_r($evokationQuests);
//EVOKATION QUESTS
foreach ($evokationQuests as $key => $quest):
	// if the type of quest is different of the type requested, do nothing
	if($quest['Quest']['type'] != $type){
		continue;
	}

	//FIND CORRESPONDING EVIDENCE (if already created)
	if (isset($evokation)) {
		$evidence = Hash::extract(
			$evokation, 
			'Evidence.{n}[quest_id='.$quest['Quest']['id'].']'
		);
		if (!empty($evidence)) {
			$evidence = $evidence[0];
		}
	}
	$action = 'add_evokation_part_act';
	if($type == Quest::TYPE_EVOKATION_PART){
		$action = 'add_evokation_part_pure'; // not from brainstorm
	}
	$addClass = '';

	switch ($quest['status'][0]){

		case Quest::STATUS_NOT_STARTED:
			$icon = '<i class = "fa fa-pencil blue"></i>';
			break;
		case Quest::STATUS_IN_USE:
			$icon 	  = '<i class = "fa fa-lock  red"></i>';
			//$addClass = 'disabled';
			break;
		case Quest::STATUS_IN_PROGRESS:
			$icon = '<i class = "fa fa-pencil green"></i>';
			break;
	}

	?>
	<li>
		<p>
			<a class="button thin open-mission-overlay large-6 medium-8 small-8 text-left <?= $addClass ?>" href="<?php echo $this->Html->url(array('controller' => 'evidences', 'action' => $action, 
						$quest['Quest']['mission_id'],
						$phase_id,
						$quest['Quest']['id'],
						$evokation_id
					));?>">
				<span class="font-highlight text-color-highlight "><?= $quest['Quest']['title'] ?></span>
				<span class="right">
					<?= $icon ?>
				</span>
			</a>
		
		</p>
	</li><?php
endforeach;
?>
</ul>