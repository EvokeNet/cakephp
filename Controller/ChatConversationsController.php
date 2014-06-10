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
		$groups = $this->GroupsUser->find('all', array(
			'conditions' => array(
				'GroupsUser.user_id' => $this->getUserId()
			)
		));

		debug(get_class($this->GroupsUser));

		debug($groups);
		$this->User->recursive = 0;
		$users = $this->User->find('all', array(
			'conditions' => array(
				'User.id != ' =>  $this->getUserId()
			)
		));		

		$others = array(); // all users except my allies
		foreach ($users as $usr) {
			$is_friend = false;
			foreach($allies as $ally) {
				if(array_search($ally['UserFriend']['friend_id'], $usr['User'])) {
				   	$is_friend = true;
				    break;
				}
			}
			if(!$is_friend) {
				$others[] = $usr;
			}
		}



		$this->set(compact('user', 'others', 'allies'));
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
