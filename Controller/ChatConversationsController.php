<?php
App::uses('AppController', 'Controller');
/**
 * ChatConversations Controller
 *
 * @property ChatConversation $ChatConversation
 * @property SessionComponent $Session
 */
class ChatConversationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->loadModel('User');
		$user = $this->User->find('first', array(
			'conditions' => array(
				'User.id' => $this->getUserId()
			)
		));

		$allies = $this->User->UserFriend->find('all', array(
			'conditions' => array(
				'UserFriend.user_id' => $this->getUserId()
			)
		));

		//getting all evokation groups i am in
		$this->loadModel('GroupsUser');
		$this->GroupsUser->recursive = 2;
		$groupsuser = $this->GroupsUser->find('all', array(
			'conditions' => array(
				'GroupsUser.user_id' => $this->getUserId()
			)
		));

		$opt = array();
		foreach ($groupsuser as $groupuser) {
			array_push($opt, array('Group.id' => $groupuser['GroupsUser']['group_id']));
		}

		$this->loadModel('Group');
		$groups = $this->Group->find('all', array(
			'conditions' => array(
				'OR' => $opt
			)
		));
		// debug(get_class($this->GroupsUser));


		$this->User->recursive = 0;
		$users = $this->User->find('all', array(
			'conditions' => array(
				'User.id != ' =>  $this->getUserId()
			)
		));		

		$friends = array();
		$others = array(); // all users except my allies
		foreach ($users as $usr) {
			$is_friend = false;
			foreach($allies as $ally) {
				if(array_search($ally['UserFriend']['friend_id'], $usr['User'])) {
				   	$is_friend = true;
				   	$friends[] = $usr;
				    break;
				}
			}
			if(!$is_friend) {
				$others[] = $usr;
			}
		}


		$this->set(compact('user', 'others', 'friends', 'groups'));
	}



	public function getUserChat($user_id = null) {
		$this->autoRender = false; // We don't render a view in this example
  //   	$this->request->onlyAllow('ajax'); // No direct access via browser URL
		// return "as";

		//getting the chat between these users
     	$chat = $this->ChatConversation->findUsersChat($this->getUserId(), $user_id);

     	$chatId = 'metaId-'.$chat['ChatConversation']['id'].'-metaId';
     	$messages = '';
     	
     	foreach ($chat['Member'] as $member) {
     		if($member['user_id'] == $this->getUserId()) {
     			$lastActivity = 'metaTime-'.$member['modified'].'-metaTime';

     			//set new last activity
     			$insertAct['Member']['id'] = $member['id'];
     			$this->ChatConversation->Member->save($insertAct);
     		}
     	}
     	$ultimo = end($chat['Message']);
     	foreach ($chat['Message'] as $msg) {
     		if($ultimo == $msg)
     			$messages .= '<div class="last"><span class="author">'. $msg['author'].':&nbsp;</span><span class="msg">'.$msg['content'].'</span></div>';
     		else 
     			$messages .= '<div><span class="author">'. $msg['author'].':&nbsp;</span><span class="msg">'.$msg['content'].'</span></div>';
     	}

     	if($messages=='')
     		$messages='<div class="last"></div>';
		$result = $chatId . $lastActivity. $messages;
		return($result);
	}


	public function sendMessage() {
		$this->autoRender = false; // We don't render a view in this example
    	$this->request->onlyAllow('ajax'); // No direct access via browser URL
		$content = $this->request->data['value'];
		$chat_id = $this->request->data['chat'];

		$insert['Message']['chat_conversation_id'] = $chat_id;
		$insert['Message']['content'] = $content;
		$insert['Message']['author'] = $this->getUserName();
		$insertC['ChatConversation']['id'] = $chat_id;
		$insert['Message']['user_id'] = $this->getUserId();
		if($this->ChatConversation->save($insertC) && $this->ChatConversation->Message->save($insert)) {
			$result = '<div><span class="author">'. $this->getUserName().':&nbsp;</span><span class="msg">'.$content.'</span></div>';
			return $result;
		} else {
			return '<div><span class="error">Problem sending message!</span></div>';
		}
	}

	public function receiveMessages($content = null) {
		$this->autoRender = false; // We don't render a view in this example
    	$this->request->onlyAllow('ajax'); // No direct access via browser URL

		$current = $this->request->data['current'];
    	$chats = $this->ChatConversation->findNewMessages($this->getUserId(), $current);

    	$allyChats = "";
    	$customChats = "";
    	foreach ($chats as $chat) {
    		$ok = false;
    		$other = 0;
    		foreach ($chat['Member'] as $member) {
    			if($member['user_id'] == $this->getUserId()){
    				if($member['modified'] < $chat['ChatConversation']['modified']) {
    					$ok = true;
    				}
    			} else {
    				$other = $member['user_id'];
    			}
    		}
    		
    		if($chat['ChatConversation']['custom'] != 0)
    			$customChats .= $chat['ChatConversation']['id'].';';
    		else
    			$allyChats .= $other.';';
    	}

    	$result = $allyChats . '<>' . $customChats;
    	return $result;
    }

    public function receiveCurrent(){
    	$this->autoRender = false; // We don't render a view in this example
    	$this->request->onlyAllow('ajax'); // No direct access via browser URL
    	$current = $this->request->data['current'];
    	$userid = $this->getUserId();
    	$chat = $this->ChatConversation->findChatNewMessages($userid, $current);

    	if(!isset($chat['Member'])) return;

    	$ok = false;
    	foreach ($chat['Member'] as $member) {
    		if($member['user_id'] == $this->getUserId()){
    			if($member['modified'] < $chat['ChatConversation']['modified']) {
    				$ok = true;
    				$mod = $member['modified'];

			     	//set new last activity
			     	$insertAct['Member']['id'] = $member['id'];
			     	$this->ChatConversation->Member->save($insertAct);
    			}
    		}
    	}

    	if(!$ok) return "";
    	$messages = "";
    	foreach ($chat['Message'] as $msg) {
    		if($mod < $msg['created'] && $msg['user_id'] != $this->getUserId()) {
    			$messages .= '<div><span class="author">'.$msg['author'].':&nbsp;</span><span class="msg">'. $msg['content'].'</span></div>';
    		}
    	}
    	return $messages;

    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ChatConversation->exists($id)) {
			throw new NotFoundException(__('Invalid chat conversation'));
		}
		$options = array('conditions' => array('ChatConversation.' . $this->ChatConversation->primaryKey => $id));
		$this->set('chatConversation', $this->ChatConversation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ChatConversation->create();
			if ($this->ChatConversation->save($this->request->data)) {
				$this->Session->setFlash(__('The chat conversation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The chat conversation could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ChatConversation->exists($id)) {
			throw new NotFoundException(__('Invalid chat conversation'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ChatConversation->save($this->request->data)) {
				$this->Session->setFlash(__('The chat conversation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The chat conversation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ChatConversation.' . $this->ChatConversation->primaryKey => $id));
			$this->request->data = $this->ChatConversation->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ChatConversation->id = $id;
		if (!$this->ChatConversation->exists()) {
			throw new NotFoundException(__('Invalid chat conversation'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ChatConversation->delete()) {
			$this->Session->setFlash(__('The chat conversation has been deleted.'));
		} else {
			$this->Session->setFlash(__('The chat conversation could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
