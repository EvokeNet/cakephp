<?php
App::uses('AppModel', 'Model');
/**
 * MissionIssue Model
 *
 * @property Mission $Mission
 * @property Issue $Issue
 */
class MissionIssue extends AppModel {



	//get all missions related to a given issue
	public function getMissionsFromIssue($issue_id = null){
		return $this->find('all', array(
			'conditions' => array(
				'Issue.id' => $issue_id
			)
		));
	}


	//get all issues related to a given mission
	public function getIssuesFromMission($mission_id = null){
		return $this->find('all', array(
			'conditions' => array(
				'Mission.id' => $mission_id
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
		'Mission' => array(
			'className' => 'Mission',
			'foreignKey' => 'mission_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Issue' => array(
			'className' => 'Issue',
			'foreignKey' => 'issue_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
