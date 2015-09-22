<div id="panelsMainContent" class="min-full-height full-height">
<?php
	//Content depends on the phase
	switch($phase['Phase']['type']) {
		//INDIVIDUAL PHASE
		case Phase::TYPE_INDIVIDUAL:
		case (isset($myGroups) && (count($myGroups) < 1)): //OR PERSON WITHOUT A GROUP
			echo $this->element('Missions/panel_mission_info',array('mission' => $mission, 'phase_id' => $phase['Phase']['id']));
			break;
		//GROUP PHASE
		case Phase::TYPE_GROUP:
		case Phase::TYPE_EVOKATION:
			foreach ($myGroups as $group) {
				echo $this->element('Missions/panel_group_area', array('mission' => $mission, 'group' => $group, 'phase_id' => $phase['Phase']['id']));
			}
			break;
	}
?>
</div>