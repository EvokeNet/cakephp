<?php
App::uses('AppModel', 'Model');
/**
 * GroupRequest Model
 *
 * @property User $User
 * @property Group $Group
 */
class GroupRequest extends AppModel {

	public $actsAs = array('Containable');
	
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
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
