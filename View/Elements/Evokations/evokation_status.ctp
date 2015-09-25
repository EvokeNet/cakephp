<ul class="no-marker">
<?php

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
	?>
	<li>
		<p>
			<a class="button thin open-mission-overlay large-6 medium-8 small-8 text-left" href="<?php echo $this->Html->url(array('controller' => 'evidences', 'action' => $action, 
						$quest['Quest']['mission_id'],
						$phase_id,
						$quest['Quest']['id'],
						$evokation_id
					));?>">
				<i class="fa fa-pencil text-color-highlight"></i>
				<span class="font-highlight text-color-highlight "><?= $quest['Quest']['title'] ?></span>
			</a>
		
		</p>
	</li><?php
endforeach;
?>
</ul>