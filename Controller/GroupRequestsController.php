<?php
App::uses('AppController', 'Controller');
/**
 * GroupRequests Controller
 *
 * @property GroupRequest $GroupRequest
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class GroupRequestsController extends AppController {

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
		$this->GroupRequest->recursive = 0;
		$this->set('groupRequests', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->GroupRequest->exists($id)) {
			throw new NotFoundException(__('Invalid group request'));
		}
		$options = array('conditions' => array('GroupRequest.' . $this->GroupRequest->primaryKey => $id));
		$this->set('groupRequest', $this->GroupRequest->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->GroupRequest->create();
			if ($this->GroupRequest->save($this->request->data)) {
				$this->Session->setFlash(__('The group request has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group request could not be saved. Please, try again.'));
			}
		}
		$users = $this->GroupRequest->User->find('list');
		$groups = $this->GroupRequest->Group->find('list');
		$this->set(compact('users', 'groups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->GroupRequest->exists($id)) {
			throw new NotFoundException(__('Invalid group request'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->GroupRequest->save($this->request->data)) {
				$this->Session->setFlash(__('The group request has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group request could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('GroupRequest.' . $this->GroupRequest->primaryKey => $id));
			$this->request->data = $this->GroupRequest->find('first', $options);
		}
		$users = $this->GroupRequest->User->find('list');
		$groups = $this->GroupRequest->Group->find('list');
		$this->set(compact('users', 'groups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->GroupRequest->id = $id;
		if (!$this->GroupRequest->exists()) {
			throw new NotFoundException(__('Invalid group request'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->GroupRequest->delete()) {
			$this->Session->setFlash(__('The group request has been deleted.'));
		} else {
			$this->Session->setFlash(__('The group request could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * decline method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function decline($uid, $gid) {
		
		if($uid)
			$user_id = $uid;
		else
			$user_id = $this->params['url']['arg'];

		if($gid)
			$group_id = $gid;
		else
			$group_id = $this->params['url']['arg2'];
		
		//Update request status
    	$request = $this->GroupRequest->find('first', array('conditions' => array('GroupRequest.user_id' => $user_id, 'GroupRequest.group_id' => $group_id)));
    	if($request){
    		$this->GroupsUser->Group->GroupRequest->id = $request['GroupRequest']['id'];
    		$this->GroupsUser->Group->GroupRequest->save(array('status' => 2));
    		$this->Session->setFlash(__('The request was declined'));
    		return $this->redirect(array('controller' => 'groups', 'action' => 'view', $group_id));
    	} else {
    		return $this->redirect(array('controller' => 'groups', 'action' => 'view', $group_id));
    	}
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->GroupRequest->recursive = 0;
		$this->set('groupRequests', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->GroupRequest->exists($id)) {
			throw new NotFoundException(__('Invalid group request'));
		}
		$options = array('conditions' => array('GroupRequest.' . $this->GroupRequest->primaryKey => $id));
		$this->set('groupRequest', $this->GroupRequest->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->GroupRequest->create();
			if ($this->GroupRequest->save($this->request->data)) {
				$this->Session->setFlash(__('The group request has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group request could not be saved. Please, try again.'));
			}
		}
		$users = $this->GroupRequest->User->find('list');
		$groups = $this->GroupRequest->Group->find('list');
		$this->set(compact('users', 'groups'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->GroupRequest->exists($id)) {
			throw new NotFoundException(__('Invalid group request'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->GroupRequest->save($this->request->data)) {
				$this->Session->setFlash(__('The group request has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group request could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('GroupRequest.' . $this->GroupRequest->primaryKey => $id));
			$this->request->data = $this->GroupRequest->find('first', $options);
		}
		$users = $this->GroupRequest->User->find('list');
		$groups = $this->GroupRequest->Group->find('list');
		$this->set(compact('users', 'groups'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->GroupRequest->id = $id;
		if (!$this->GroupRequest->exists()) {
			throw new NotFoundException(__('Invalid group request'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->GroupRequest->delete()) {
			$this->Session->setFlash(__('The group request has been deleted.'));
		} else {
			$this->Session->setFlash(__('The group request could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
