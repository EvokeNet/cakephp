<?php
App::uses('AppModel', 'Model');
/**
 * QuestPowerPoint Model
 *
 * @property Quest $Quest
 * @property PowerPoints $PowerPoints
 */
class QuestPowerPoint extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Quest' => array(
			'className' => 'Quest',
			'foreignKey' => 'quest_id',
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
		)
	);
}
