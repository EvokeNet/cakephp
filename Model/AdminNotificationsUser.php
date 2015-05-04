<?php
App::uses('AppModel', 'Model');
/**
 * AdminNotificationsUser Model
 *
 * @property AdminNotification $AdminNotification
 * @property User $User
 */
class AdminNotificationsUser extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'AdminNotification' => array(
			'className' => 'AdminNotification',
			'foreignKey' => 'admin_notification_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
