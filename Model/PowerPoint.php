<?php
App::uses('AppModel', 'Model');
/**
 * PowerPoint Model
 *
 */
class PowerPoint extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	public $hasMany = array(
		'BadgePowerPoint' => array(
			'className' => 'BadgePowerPoint',
			'foreignKey' => 'power_points_id',
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
		'QuestPowerPoint' => array(
			'className' => 'QuestPowerPoint',
			'foreignKey' => 'power_points_id',
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
		'UserPowerPoint' => array(
			'className' => 'UserPowerPoint',
			'foreignKey' => 'power_points_id',
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
