<?php
App::uses('AppModel', 'Model');
/**
 * Phase Model
 *
 * @property Mission $Mission
 */
class Phase extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


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
		)
	);

	/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Quest' => array(
			'className' => 'Quest',
			'foreignKey' => 'phase_id',
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
