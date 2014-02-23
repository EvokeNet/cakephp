<?php
App::uses('AppModel', 'Model');
/**
 * Issue Model
 *
 * @property Issue $ParentIssue
 * @property Issue $ChildIssue
 */
class Issue extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	public function getIssues($order = "Issue.name"){
		return $this->find('all', array(
			'order' => array($order.' ASC')
			));
	}

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ParentIssue' => array(
			'className' => 'Issue',
			'foreignKey' => 'parent_id',
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
		'ChildIssue' => array(
			'className' => 'Issue',
			'foreignKey' => 'parent_id',
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
