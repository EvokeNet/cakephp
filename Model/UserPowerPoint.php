<?php
App::uses('AppModel', 'Model');
/**
 * UserPowerPoint Model
 *
 * @property User $User
 * @property PowerPoints $PowerPoints
 * @property Quest $Quest
 */
class UserPowerPoint extends AppModel {


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
		'PowerPoints' => array(
			'className' => 'PowerPoints',
			'foreignKey' => 'power_points_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Quest' => array(
			'className' => 'Quest',
			'foreignKey' => 'quest_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
