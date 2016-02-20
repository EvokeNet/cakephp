<?php
App::uses('AppModel', 'Model');
/**
 * Comment Model
 *
 * @property Evidence $Evidence
 * @property Evokation $Evokation
 * @property EvokationUpdate $EvokationUpdate
 * @property User $User
 */
class Comment extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Evidence' => array(
			'className' => 'Evidence',
			'foreignKey' => 'evidence_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Evokation' => array(
			'className' => 'Evokation',
			'foreignKey' => 'evokation_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'EvokationUpdate' => array(
			'className' => 'EvokationUpdate',
			'foreignKey' => 'evokation_update_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
