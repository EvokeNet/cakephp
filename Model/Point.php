<?php
App::uses('AppModel', 'Model');
/**
 * Point Model
 *
 * @property User $User
 */
class Point extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $actsAs = array('Containable'); //Can be retrieved through models it belongs to

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
		)
	);
}
