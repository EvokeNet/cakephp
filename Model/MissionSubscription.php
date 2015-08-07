<?php
App::uses('AppModel', 'Model');
/**
 * MissionSubscription Model
 *
 * @property User $User
 * @property Mission $Mission
 * @property Phase $Phase
 */
class MissionSubscription extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
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
}
