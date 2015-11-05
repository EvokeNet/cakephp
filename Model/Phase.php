<?php
App::uses('AppModel', 'Model');
/**
 * Phase Model
 *
 * @property Mission $Mission
 * @property Evidence $Evidence
 * @property Launcher $Launcher
 * @property PhaseChecklist $PhaseChecklist
 * @property Quest $Quest
 * @property UserPhaseChecklist $UserPhaseChecklist
 */
class Phase extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * actsAs array
 *
 */
	public $actsAs = array(
		'Containable',
		'Enumerable',
		'BrainstormSessionEvoke.ActPhaseBrainstorm',
		'Optimum.ForumFilterable'
		// 'Translate' => array(
		//     'name' => 'phaseName', 
		//     'description' => 'phaseDescription'
		// )
	);

	const TYPE_INDIVIDUAL = 0;
	const TYPE_GROUP = 1;
	const TYPE_EVOKATION = 2;

/**
 * Enumerable fields (handled by Enumerable behavior)
 *
 * @var array
 */
	public $enum = array(
		'type' => array(
			self::TYPE_INDIVIDUAL => 'Individual phase',
			self::TYPE_GROUP => 'Group phase',
			self::TYPE_EVOKATION => 'Evokation phase'
		)
	);

	public $translateModel = 'PhaseTranslation';
	public $translateTable = 'phase_translations';

/**
 * Checks if a user has completed this phase (at least one quest completed)
 *
 * @param int User ID
 * @param int Phase ID
 * @return boolean True if the user has completed one or more quests, false otherwise
 */
	public function hasCompleted($user_id, $phase_id) {
		$phase = $this->findById($phase_id);

		$quest_ids = $this->Quest->find('list',array(
			'conditions' => array('phase_id' => $phase_id)
		));

		//Individual phases: Completed phase if completed at least one quest
		if ($phase['Phase']['type'] == Phase::TYPE_INDIVIDUAL) {
			foreach ($quest_ids as $quest_id => $quest_title) {
				if ($this->Quest->hasCompleted($user_id,$quest_id))  {
					return true;
				}
			}
		}

		//Group phases: the entire group has to have completed all quests
		else if (($phase['Phase']['type'] == Phase::TYPE_GROUP) || ($phase['Phase']['type'] == Phase::TYPE_EVOKATION)) {
			$mission_id = $phase['Phase']['mission_id'];

			$userGroupInMission = $this->Mission->Group->getGroupInMission($mission_id, $user_id, array('contain' => 'Member'));

			//No group
			if (is_null($userGroupInMission) || (!isset($userGroupInMission['Member']))) {
				return false;
			}

			//All quests in this phase
			foreach ($quest_ids as $quest_id => $quest_title) {
				//If one user from the group didn't complete it, the phase is not completed
				foreach($userGroupInMission['Member'] as $key => $user) {
					if (!$this->Quest->hasCompleted($user['id'],$quest_id))  {
						return false;
					}
				}
			}
			return true;
		}
		return false;
	}

/**
 * Returns current phase (all phases before have been completed)
 *
 * @param int User ID
 * @param int Mission ID
 * @return Phase object (if any)
 */
	public function getCurrentPhase($user_id, $mission_id) {
		$mission_phases = $this->find('all',array(
			'conditions' => array('mission_id' => $mission_id)
		));

		$completed_previous = true;
		$phase = null;

		//Current phase is the one before which all phases have been completed
		foreach ($mission_phases as $key => $phase) {
			$completed_current = $this->hasCompleted($user_id,$phase['Phase']['id']);

			if ($completed_previous && !$completed_current) {
				return $phase;
			}
			
			$completed_previous = $completed_current;
		}

		return $phase;
	}
	
	public function getNextPhase($phase, $mission_id) {

		$mps = $this->Mission->Phase->find('all', array(
			'conditions' => array(
				'Phase.mission_id' => $mission_id
		)));

		if($phase['Phase']['position'] == count($mps))
			return null;

		foreach($mps as $key => $mp):
			if($mp['Phase']['position'] == $phase['Phase']['position'] + 1):
				return $mp;
				break;
			endif;
		endforeach;

	}

	public function getPrevPhase($phase, $mission_id) {

		if($phase['Phase']['position'] == 1)
			return null;

		$mps = $this->Mission->Phase->find('all', array(
			'conditions' => array(
				'Phase.mission_id' => $mission_id
		)));

		foreach($mps as $key => $mp):
			if($mp['Phase']['position'] == $phase['Phase']['position'] - 1):
				return $mp;
				break;
			endif;
		endforeach;

	}

	
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Mission' => array(
			'className' => 'Mission',
			'foreignKey' => 'mission_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Evidence' => array(
			'className' => 'Evidence',
			'foreignKey' => 'phase_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'phase_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Launcher' => array(
			'className' => 'Launcher',
			'foreignKey' => 'phase_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PhaseChecklist' => array(
			'className' => 'PhaseChecklist',
			'foreignKey' => 'phase_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Quest' => array(
			'className' => 'Quest',
			'foreignKey' => 'phase_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'Quest.position ASC',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'UserPhaseChecklist' => array(
			'className' => 'UserPhaseChecklist',
			'foreignKey' => 'phase_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
