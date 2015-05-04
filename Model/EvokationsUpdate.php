<?php
App::uses('AppModel', 'Model');
/**
 * EvokationsUpdate Model
 *
 * @property Evokation $Evokation
 */
class EvokationsUpdate extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Evokation' => array(
			'className' => 'Evokation',
			'foreignKey' => 'evokation_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
