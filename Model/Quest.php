<?php
App::uses('AppModel', 'Model');
/**
 * Quest Model
 *
 * @property Mission $Mission
 * @property Phase $Phase
 * @property Evidence $Evidence
 */
class Quest extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

/**
 * Default ordering of data for any find operation
 *
 * @var string
 */
	public $order = "Quest.position ASC";

/**
 * Custom find types
 *
 * @var array
 */
	public $findMethods = array('evokePhase' =>  true);

/**
 * Behaviors
 *
 * @var array
 */
	public $actsAs = array(
		'Containable',
		'BrainstormSessionEvoke.ActPhaseBrainstorm',
		'Enumerable'
		// 'Translate' => array(
		//     'title' => 'questTitle', 
		//     'description' => 'questDescription',
		// )
	);

	const TYPE_EVIDENCE = 0;
	const TYPE_QUESTIONNAIRE = 1;
	const TYPE_BRAINSTORM = 2;
	const TYPE_GROUP_CREATION = 3;
	const TYPE_EVOKATION = 4;

	const STATUS_NOT_STARTED = 0;
	const STATUS_IN_PROGRESS = 1;
	const STATUS_COMPLETED = 2;

/**
 * Enumerable fields (handled by Enumerable behavior)
 *
 * @var array
 */
	public $enum = array(
		'type' => array(
			self::TYPE_EVIDENCE => 'Evidence',
			self::TYPE_QUESTIONNAIRE => 'Questionnaire',
			self::TYPE_BRAINSTORM => 'Brainstorm',
			self::TYPE_GROUP_CREATION => 'Group creation',
			self::TYPE_EVOKATION => 'Evokation'
		),
		'status' => array(
			self::STATUS_NOT_STARTED => 'Not started',
			self::STATUS_IN_PROGRESS => 'In progress',
			self::STATUS_COMPLETED => 'Completed'
		)
	);


/**
 * Checks if a user has completed this quest
 * Based on the type of quest, this method gets the response sent by the user
 * ( @see self::getQuestResponse() )
 * Then, the method checks if the response is enough to complete the quest
 *
 * @param int User ID
 * @param int Quest ID
 * @return boolean True if the user has completed the quest, false otherwise
 */
	public function hasCompleted($user_id,$quest_id) {
		if (!$this->exists($quest_id)) {
			throw new NotFoundException(__('Invalid quest'));
		}

		$quest = $this->findById($quest_id);

		$response = $this->getQuestResponse($user_id,$quest_id);

		switch ($quest['Quest']['type']) {
			case self::TYPE_EVIDENCE:
			case self::TYPE_BRAINSTORM:
				if (isset($response['Evidence']) && (count($response['Evidence']) > 0)) {
					return true;
				}
				return false;

			case self::TYPE_QUESTIONNAIRE:
				if (isset($response['Question'])) {
					foreach ($response['Question'] as $key => $question) {
						//At least one question of the quest's questionnaire was answered
						if (isset($question['UserAnswer']) && !empty($question['UserAnswer'])) {
							return true;
						}
					}
				}
				return false;

			case self::TYPE_GROUP_CREATION:
				if (isset($response['GroupsUser']) && (count($response['GroupsUser']) > 0)) {
					return true;
				}
				return false;

			case self::TYPE_EVOKATION:
				if (isset($response['Evokation']) && (count($response['Evokation']) > 0)) {
					return true;
				}
				return false;
		}
		return false;
	}

/**
 * Based on the type of quest, this method gets the response sent by the user
 *
 * @param int User ID
 * @param int Quest ID
 * @return object Quest response
 */
	public function getQuestResponse($user_id,$quest_id) {
		if (!$this->exists($quest_id)) {
			throw new NotFoundException(__('Invalid quest'));
		}

		$quest = $this->findById($quest_id);

		switch ($quest['Quest']['type']) {
			case self::TYPE_EVIDENCE:
			case self::TYPE_BRAINSTORM:
				return $this->Evidence->find('first',array(
					'conditions' => array(
						'user_id' => $user_id,
						'quest_id' => $quest_id
					),
					'contain' => array('User')
				));
			case self::TYPE_QUESTIONNAIRE:
				return $this->Questionnaire->find('first',array(
					'conditions' => array('quest_id' => $quest_id),
					'contain' => array(
						'Question' => array(
							'UserAnswer' => array('conditions' => array('user_id' => $user_id))
						)
					)
				));
			case self::TYPE_GROUP_CREATION:
				return $this->Group->GroupsUser->find('first', array(
					'joins' => array(
						array(
							'table' => 'groups',
							'alias' => 'Group',
							'type' => 'inner',
							'conditions' => array('Group.id = GroupsUser.group_id')
						)
					),
					'fields' => array('Group.*','GroupsUser.*'),
					'conditions' => array(
						'GroupsUser.user_id' => $user_id,
						'Group.quest_id' => $quest_id
					)
				));
			case self::TYPE_EVOKATION:
				//GROUP THIS USER IS MEMBER OF
				$group = $this->Group->find('first',array(
					'conditions' => array('quest_id' => $quest_id),
					'contain' => array(
						'GroupsUser' => array(
							'conditions' => array('user_id' => $user_id)
						)
					)
				));
				if (isset($group['GroupsUser']) && (count($group['GroupsUser']) > 0)) {
					//EVOKATION BY THIS GROUP
					return $this->Group->Evokation->findByGroupId($group_id);
				}
				return array();
		}
		return null;
	}


/**
 * Custom find query that adds conditions to filter queries that belong to the Evoke phase
 * (queries with type Evokation, or queries of other types that are votable in the Evoke phase)
 *
 */
	protected function _findEvokePhase($state, $query, $results = array()) {
		if ($state === 'before') {
			$evokePhaseCondition = array(
				'OR' => array(
					'Quest.votable' => true,
					'Quest.type' => Quest::TYPE_EVOKATION
				)
			);
			if (is_array($query['conditions'])) {
				array_push($query['conditions'], $evokePhaseCondition);
			}
			else {
				$query['conditions'] = $evokePhaseCondition;
			}
			
			return $query;
		}
		return $results;
	}

	// public function getEvokePhaseQuestStatus($user_id,$quest_id) {
	// 	if (!$this->exists($quest_id)) {
	// 		throw new NotFoundException(__('Invalid quest'));
	// 	}

	// 	$quest = $this->findById($quest_id);

	// 	$response = $this->getQuestResponse($user_id,$quest_id);

	// 	//VOTABLE
	// 	if ($quest['Quest']['votable'] == true):
	// 		if (isset($response['Evokation']) && (count($response['Evokation']) > 0)) {
	// 			return true;
	// 		}
	// 		return false;
	// 	}
	// 	//EVOKE PHASE QUEST
	// 	else {

	// 	}
	// 	return false;
	// }

	public function createWithAttachments($data, $hasPrev = false, $id = null) {
		// Sanitize your images before adding them
		$images = array();
		if (!empty($data['Attachment'][0]) || !empty($data['Attachment'][1])) {
			foreach ($data['Attachment'] as $i => $image) {
				if($i == 'Old') continue; //if its an already existing attachment, ignore it
				if (is_array($data['Attachment'][$i])) {
					// Force setting the `model` field to this model
					$image['model'] = 'Quest';

					// Unset the foreign_key if the user tries to specify it
					if (isset($image['foreign_key'])) {
						unset($image['foreign_key']);
					}

					$images[] = $image;
				}
			}
		}
		$data['Attachment'] = $images;

		// Try to save the data using Model::saveAll()
		if(!$hasPrev) $this->create();
		else {
			$this->id = $id;
			$data['Quest']['id'] = $id;
		}
		if ($this->saveAll($data)) {
			return true;
		}
		return false;
		// Throw an exception for the controller
		//throw new Exception(__("This post could not be saved. Please try again"));
	}

	//The Associations below have been created with all possible keys, those that are not needed can be removed

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
		),
		'Phase' => array(
			'className' => 'Phase',
			'foreignKey' => 'phase_id',
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
			'foreignKey' => 'quest_id',
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
			'foreignKey' => 'quest_id',
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
		'QuestPowerPoint' => array(
			'className' => 'QuestPowerPoint',
			'foreignKey' => 'quest_id',
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
		'UserPowerPoint' => array(
			'className' => 'UserPowerPoint',
			'foreignKey' => 'quest_id',
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
		'Attachment' => array(
			'className' => 'Attachment',
			'foreignKey' => 'foreign_key',
			'conditions' => array(
				'Attachment.model' => 'Quest',
			),
		),
	);

//
	public $hasOne = array(
		'Questionnaire' => array(
			'className' => 'Questionnaire',
			'foreignKey' => 'quest_id',
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
