<?php
App::uses('AppModel', 'Model');
/**
 * BadgePowerPoint Model
 *
 * @property Badge $Badge
 * @property PowerPoints $PowerPoints
 */
class BadgePowerPoint extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Badge' => array(
			'className' => 'Badge',
			'foreignKey' => 'badge_id',
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
