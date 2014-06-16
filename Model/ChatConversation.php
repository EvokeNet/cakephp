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
	public $actAs = array('Containable');

	public function findUsersChat($alfa_id, $beta_id) {
		//find all chats by these users
		$tmp = $this->find('all', array(
			'contain' => array(
			    'Member' => array(
			        'conditions' => array(
			        	'OR' => array(
				        	'Member.user_id =' => $alfa_id,
				        	'Member.user_id =' => $beta_id
				        )
			        )
			    )
			),
			'conditions' => array(
				'ChatConversation.custom' => 0
			)
		));

		//get the correct chat
		foreach ($tmp as $chat) {
			if(sizeof($chat['Member']) != 2) continue;

			$doubleOK = 0;
			foreach ($chat['Member'] as $member) {
				if($member['user_id'] == $alfa_id || $member['user_id'] == $beta_id) $doubleOK++;
			}

			if($doubleOK == 2) return $chat;
		}

		//couldnt find their chat, create a new one!
		// $this->create();
		
		// $this->Member->create();
		$insert['Member'][0]['user_id'] = $alfa_id;
		// $insert['Member']['chat_conversation_id'] = $this->id;
		// $this->Member->save();

		// $this->Member->create();
		$insert['Member'][1]['user_id'] = $beta_id;
		// $insert['Member']['chat_conversation_id'] = $this->id;
		$this->saveAll($insert);

		$data = $this->find('first', array('conditions' => array('ChatConversation.id' => $this->id)));
		return $data;
	}

	public function findNewMessages($user_id, $currentChat) {
		//find all chats by these users
		$tmp = $this->find('all', array(
			'contain' => array(
			    'Member' => array(
			        'conditions' => array(
			        	'Member.user_id =' => $user_id,
			        	'Member.modified < ChatConversation.modified'
			        )
			    ),
			    'Message' => array(
			    	'conditions' => array(
			        	'Member.modified < Message.created'
			        )
			    )
			),
			'conditions' => array(
				'ChatConversation.id <>' => $currentChat
			)
		));

		$latestChats = array();
		foreach ($tmp as $chat) {
			foreach ($chat['Member'] as $member) {
				if($member['user_id'] == $user_id && $chat['ChatConversation']['modified'] > $member['modified'])
					$latestChats[] = $chat;
			}
		}
		return $latestChats;
	}

	public function findChatNewMessages($user_id, $currentChat) {
		//find all chats by these users
		$tmp = $this->find('first', array(
			'contain' => array(
			    'Member' => array(
			        'conditions' => array(
			        	'Member.user_id =' => $user_id,
			        	'Member.modified < ChatConversation.modified'
			        )
			    ),
			    'Message' => array(
			    	'conditions' => array(
			        	'Member.modified < Message.created'
			        )
			    )
			),
			'conditions' => array(
				'ChatConversation.id' => $currentChat
			)
		));

		return $tmp;
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
