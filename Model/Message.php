<?php
App::uses('AppModel', 'Model');
/**
 * Message Model
 *
 * @property ChatConversation $ChatConversation
 * @property Member $Member
 */
class Message extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'content';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ChatConversation' => array(
			'className' => 'ChatConversation',
			'foreignKey' => 'chat_conversation_id',
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
