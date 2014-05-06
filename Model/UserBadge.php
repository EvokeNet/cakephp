<?php
App::uses('AppModel', 'Model');
/**
 * UserBadge Model
 *
 * @property User $User
 * @property Badge $Badge
 */
class UserBadge extends AppModel {


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
		'Badge' => array(
			'className' => 'Badge',
			'foreignKey' => 'badge_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
