<?php
App::uses('AppModel', 'Model');
/**
 * Notification Model
 *
 * @property User $User
 */
class Notification extends AppModel {


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
		'Evidence' => array(
            'className' => 'Evidence',
            'foreignKey' => 'origin_id',
        ),
	);
}
