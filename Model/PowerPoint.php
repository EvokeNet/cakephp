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
		'QuestPowerPoint' => array(
			'className' => 'QuestPowerPoint',
			'foreignKey' => 'power_point_id',
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
			'foreignKey' => 'power_point_id',
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
