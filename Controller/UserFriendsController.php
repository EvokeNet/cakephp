<?php
App::uses('AppController', 'Controller');
/**
 * UserFriends Controller
 *
 * @property UserFriend $UserFriend
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserFriendsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');


/**
 * Add a user as a friend
 * @param int $new_friend_id ID of the user that is GOING to be friends with the one who asked
 * @param int $friend_id ID of the user that is ASKING to be friends with another
 * @param bool $redirect_after Boolean that indicates if after adding the user it should redirect to another page (default true)
 * @return void
 */
	public function add($new_friend_id = null, $id = null, $redirect_after = true) {
		$this->autoRender = false;

		if (!$this->UserFriend->User->exists($id) OR !$this->UserFriend->User->exists($new_friend_id)) {
			throw new NotFoundException(__('User not found'));
		}

		$insertData = array('user_id' => $id, 'friend_id' => $new_friend_id);
		$exists = $this->UserFriend->find('first', array('conditions' => array('UserFriend.user_id' => $id, 'UserFriend.friend_id' => $new_friend_id)));

		if(!$exists){
	        if($this->UserFriend->saveAll($insertData)){
	        	//$this->Session->setFlash(__('The friendship has been saved.'));
	        }  else $this->Session->setFlash(__('The friendship could not be saved. Please, try again.'));
		} else {
			$this->Session->setFlash(__('This friendship has already been saved.'));
		}

		if ($redirect_after) {
			return $this->redirect(array('controller' => 'users', 'action' => 'profile', $new_friend_id));
		}
		return true;
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->autoRender = false;

		if (!$this->UserFriend->exists($id)) {
			throw new NotFoundException(__('Invalid user friend'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserFriend->save($this->request->data)) {
				$this->Session->setFlash(__('The user friend has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user friend could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserFriend.' . $this->UserFriend->primaryKey => $id));
			$this->request->data = $this->UserFriend->find('first', $options);
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
		$this->autoRender = false;

		$this->UserFriend->id = $id;
		if (!$this->UserFriend->exists()) {
			throw new NotFoundException(__('Invalid user friend'));
		}

		$user = $this->UserFriend->find('first', array('conditions' => array('UserFriend.id' => $id)));

		if ($this->UserFriend->delete()) {
			$this->Session->setFlash(__('The user friend has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user friend could not be deleted. Please, try again.'));
		}
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->autoRender = false;

		if ($this->request->is('post')) {
			$this->UserFriend->create();
			if ($this->UserFriend->save($this->request->data)) {
				$this->Session->setFlash(__('The user friend has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user friend could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->autoRender = false;

		if (!$this->UserFriend->exists($id)) {
			throw new NotFoundException(__('Invalid user friend'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserFriend->save($this->request->data)) {
				$this->Session->setFlash(__('The user friend has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user friend could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserFriend.' . $this->UserFriend->primaryKey => $id));
			$this->request->data = $this->UserFriend->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->autoRender = false;

		$this->UserFriend->id = $id;
		if (!$this->UserFriend->exists()) {
			throw new NotFoundException(__('Invalid user friend'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserFriend->delete()) {
			$this->Session->setFlash(__('The user friend has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user friend could not be deleted. Please, try again.'));
		}
	}
}
