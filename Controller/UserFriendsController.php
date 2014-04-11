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
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UserFriend->recursive = 0;
		$this->set('userFriends', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserFriend->exists($id)) {
			throw new NotFoundException(__('Invalid user friend'));
		}
		$options = array('conditions' => array('UserFriend.' . $this->UserFriend->primaryKey => $id));
		$this->set('userFriend', $this->UserFriend->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id = null, $friend_id = null) {
		if (!$this->UserFriend->User->exists($id) OR !$this->UserFriend->User->exists($friend_id)) {
			throw new NotFoundException(__('User not found'));
		}

		$insertData = array('user_id' => $id, 'friend_id' => $friend_id);

		$exists = $this->UserFriend->find('first', array('conditions' => array('UserFriend.user_id' => $id, 'UserFriend.friend_id' => $friend_id)));

		if(!$exists){
	        if($this->UserFriend->saveAll($insertData)){
	        	$this->Session->setFlash(__('The friendship has been saved.'));
	        }  else $this->Session->setFlash(__('The friendship could not be saved. Please, try again.'));
		} else {
			$this->Session->setFlash(__('This friendship has already been saved.'));
		}

		return $this->redirect(array('controller' => 'users', 'action' => 'dashboard', $friend_id));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
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
		$users = $this->UserFriend->User->find('list');
		$friends = $this->UserFriend->User->find('list');
		$this->set(compact('users', 'friends'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserFriend->id = $id;
		if (!$this->UserFriend->exists()) {
			throw new NotFoundException(__('Invalid user friend'));
		}

		$user = $this->UserFriend->find('first', array('conditions' => array('UserFriend.id' => $id)));

		//$this->request->onlyAllow('post', 'delete');
		if ($this->UserFriend->delete()) {
			$this->Session->setFlash(__('The user friend has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user friend could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('controller' => 'users', 'action' => 'dashboard', $user['UserFriend']['friend_id']));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->UserFriend->recursive = 0;
		$this->set('userFriends', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->UserFriend->exists($id)) {
			throw new NotFoundException(__('Invalid user friend'));
		}
		$options = array('conditions' => array('UserFriend.' . $this->UserFriend->primaryKey => $id));
		$this->set('userFriend', $this->UserFriend->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->UserFriend->create();
			if ($this->UserFriend->save($this->request->data)) {
				$this->Session->setFlash(__('The user friend has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user friend could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserFriend->User->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
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
		$users = $this->UserFriend->User->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
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
		return $this->redirect(array('action' => 'index'));
	}}
