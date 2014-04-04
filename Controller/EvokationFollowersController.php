<?php
App::uses('AppController', 'Controller');
/**
 * EvokationFollowers Controller
 *
 * @property EvokationFollower $EvokationFollower
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class EvokationFollowersController extends AppController {

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
		$this->EvokationFollower->recursive = 0;
		$this->set('evokationFollowers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->EvokationFollower->exists($id)) {
			throw new NotFoundException(__('Invalid evokation follower'));
		}
		$options = array('conditions' => array('EvokationFollower.' . $this->EvokationFollower->primaryKey => $id));
		$this->set('evokationFollower', $this->EvokationFollower->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id = null) {
		$user_id = $this->getUserId();
		if (!$this->EvokationFollower->Evokation->exists($id)) {
			throw new NotFoundException(__('Evokation not found.'));
		} else if (!$this->EvokationFollower->User->exists($user_id)) {
			throw new NotFoundException(__('Evokation not found.'));
		}

		$insertData = array('evokation_id' => $id, 'user_id' => $user_id); 
		$exists = $this->EvokationFollower->find('first', array('conditions' => array('EvokationFollower.evokation_id' => $id, 'EvokationFollower.user_id' => $user_id)));

		if(!$exists){
			//let him follow..
	        if($this->EvokationFollower->save($insertData)){
	        	$this->Session->setFlash(__('You are now following the evokation.'));
	        	return $this->redirect(array('controller' => 'evokations', 'action' => 'view', $id));
	        }  else{
	        	$this->Session->setFlash(__('The following could not be saved. Please, try again.'));
	        	return $this->redirect(array('controller' => 'users', 'action' => 'dashboard', $user_id));
	        } 
		} else {
			//he wants to unfollow..
			$this->EvokationFollower->id = $exists['EvokationFollower']['id'];
			if ($this->EvokationFollower->delete()) {
				$this->Session->setFlash(__('You have unfollowed this evokation.'));
				return $this->redirect(array('controller' => 'users', 'action' => 'dashboard', $user_id));
			} else {
				$this->Session->setFlash(__('The evokation follower could not be deleted. Please, try again.'));
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
		if (!$this->EvokationFollower->exists($id)) {
			throw new NotFoundException(__('Invalid evokation follower'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EvokationFollower->save($this->request->data)) {
				$this->Session->setFlash(__('The evokation follower has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evokation follower could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('EvokationFollower.' . $this->EvokationFollower->primaryKey => $id));
			$this->request->data = $this->EvokationFollower->find('first', $options);
		}
		$users = $this->EvokationFollower->User->find('list');
		$evokations = $this->EvokationFollower->Evokation->find('list');
		$this->set(compact('users', 'evokations'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->EvokationFollower->id = $id;
		if (!$this->EvokationFollower->exists()) {
			throw new NotFoundException(__('Invalid evokation follower'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->EvokationFollower->delete()) {
			$this->Session->setFlash(__('The evokation follower has been deleted.'));
		} else {
			$this->Session->setFlash(__('The evokation follower could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->EvokationFollower->recursive = 0;
		$this->set('evokationFollowers', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->EvokationFollower->exists($id)) {
			throw new NotFoundException(__('Invalid evokation follower'));
		}
		$options = array('conditions' => array('EvokationFollower.' . $this->EvokationFollower->primaryKey => $id));
		$this->set('evokationFollower', $this->EvokationFollower->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->EvokationFollower->create();
			if ($this->EvokationFollower->save($this->request->data)) {
				$this->Session->setFlash(__('The evokation follower has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evokation follower could not be saved. Please, try again.'));
			}
		}
		$users = $this->EvokationFollower->User->find('list');
		$evokations = $this->EvokationFollower->Evokation->find('list');
		$this->set(compact('users', 'evokations'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->EvokationFollower->exists($id)) {
			throw new NotFoundException(__('Invalid evokation follower'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EvokationFollower->save($this->request->data)) {
				$this->Session->setFlash(__('The evokation follower has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evokation follower could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('EvokationFollower.' . $this->EvokationFollower->primaryKey => $id));
			$this->request->data = $this->EvokationFollower->find('first', $options);
		}
		$users = $this->EvokationFollower->User->find('list');
		$evokations = $this->EvokationFollower->Evokation->find('list');
		$this->set(compact('users', 'evokations'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->EvokationFollower->id = $id;
		if (!$this->EvokationFollower->exists()) {
			throw new NotFoundException(__('Invalid evokation follower'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->EvokationFollower->delete()) {
			$this->Session->setFlash(__('The evokation follower has been deleted.'));
		} else {
			$this->Session->setFlash(__('The evokation follower could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
