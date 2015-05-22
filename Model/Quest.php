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

/**
 * Enumerable fields (handled by Enumerable behavior)
 *
 * @var array
 */
	public $enum = array(
		'type' => array(
			self::TYPE_EVIDENCE => 'EVIDENCE',
			self::TYPE_QUESTIONNAIRE => 'QUESTIONNAIRE',
			self::TYPE_BRAINSTORM => 'BRAINSTORM',
			self::TYPE_GROUP_CREATION => 'GROUP_CREATION',
			self::TYPE_EVOKATION => 'EVOKATION'
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
				if (!is_null($response['Evokation']) && (count($response['Evokation']) > 0)) {
					return true;
				}
				return false;
		}
		return false;
	}

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
				return $this->Group->find('first',array(
					'conditions' => array('quest_id' => $quest_id),
					'contain' => array('GroupsUser' => array(
						'conditions' => array('user_id' => $user_id)
					))
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
				if (!is_null($group) && (count($group['GroupsUser']) > 0)) {
					//EVOKATION BY THIS GROUP
					return $this->Group->Evokation->findByGroupId($group_id);
				}
				return array();
		}
		return null;
	}

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
