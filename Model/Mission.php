<?php
App::uses('AppModel', 'Model');
/**
 * Mission Model
 *
 * @property Organization $Organization
 * @property Evidence $Evidence
 * @property MissionIssue $MissionIssue
 * @property Phase $Phase
 * @property Quest $Quest
 */
class Mission extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

	public function getMissions() {
		return $this->find('all');
	}

/**
 * getEvidences function returns evidences that belong to the selected mission
 *
 */
	public function getEvidences($id = null) {
		return $this->Evidence->find('all', array(
			'conditions' => array(
				'Evidence.mission_id' => $id
			),
			'order' => array('Evidence.created DESC'),
		));
	}

/**
 * getMissionIssues returns the issues for the selected mission
 *
 */
	public function getMissionIssues($id = null) {
		return $this->MissionIssue->find('all', array(
			'conditions' => array(
				'MissionIssue.mission_id' => $id
			)
		));
	}


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Organization' => array(
			'className' => 'Organization',
			'foreignKey' => 'organization_id',
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
			'foreignKey' => 'mission_id',
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
		'MissionIssue' => array(
			'className' => 'MissionIssue',
			'foreignKey' => 'mission_id',
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
		'Phase' => array(
			'className' => 'Phase',
			'foreignKey' => 'mission_id',
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
			'foreignKey' => 'mission_id',
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
		'UserMission' => array(
			'className' => 'UserMission',
			'foreignKey' => 'mission_id',
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
