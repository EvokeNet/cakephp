<?php
App::uses('AppModel', 'Model');
/**
 * Evokation Model
 *
 * @property Group $Group
 */
class Evokation extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

/**
 * Checks if the evokation has been completed
 *
 * @param int Evokation ID
 * @return boolean True if the evokation has been marked complete, false otherwise
 */
	public function isComplete($evokation_id) {
		if (!$this->exists($evokation_id)) {
			throw new NotFoundException(__('Invalid evokation'));
		}

		$evokation = $this->findById($evokation_id);

		return $evokation['Evokation']['final_sent'];
	}

/*
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $hasMany = array(
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'evokation_id',
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
		'Vote' => array(
			'className' => 'Vote',
			'foreignKey' => 'evokation_id',
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
		'Evidence' => array(
			'className' => 'Evidence',
			'foreignKey' => 'evokation_id',
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
		'EvokationFollower' => array(
			'className' => 'EvokationFollower',
			'foreignKey' => 'evokation_id',
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
		'EvokationsUpdate' => array(
			'className' => 'EvokationsUpdate',
			'foreignKey' => 'evokation_id',
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
