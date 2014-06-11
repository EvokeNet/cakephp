<?php
App::uses('AppModel', 'Model');
/**
 * ChatConversation Model
 *
 * @property Member $Member
 * @property Message $Message
 */
class ChatConversation extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';


	public function findAllUserChats($user_id) {
		$this->bindModel(array(
            'hasMany' => array(
	            'Member' => array(
	                'conditions' =>array(
	                	'Member.user_id' => $user_id
	                )
	            )
	        )
        ));
        return $this->find('all');
	}

	public function findUsersChat($alfa_id, $beta_id) {
		$alfaChats = $this->findUsersChat($alfa_id);
		$betaChats = $this->findUsersChat($beta_id);

		foreach ($alfaChats as $key => $value) {
			if($alfaChats['ChatConversation']['custom'] == 0) {
				//check and return the same chat
			}
		}
	}

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'chat_conversation_id',
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
		'Message' => array(
			'className' => 'Message',
			'foreignKey' => 'chat_conversation_id',
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
