<?php
App::uses('AppModel', 'Model');
/**
 * Mission Model
 *
 * @property Evidence $Evidence
 * @property MissionIssue $MissionIssue
 * @property MissionPhase $MissionPhase
 * @property Quest $Quest
 */
class Mission extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	public function getMissions() {
		return $this->find('all');
	}

	//The Associations below have been created with all possible keys, those that are not needed can be removed

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
		'MissionPhase' => array(
			'className' => 'MissionPhase',
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
		)
	);

}
