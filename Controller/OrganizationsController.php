<?php
App::uses('AppController', 'Controller');
/**
 * Organizations Controller
 *
 * @property Organization $Organization
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class OrganizationsController extends AppController {

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
		$this->Organization->recursive = 0;
		$this->set('organizations', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Organization->exists($id)) {
			throw new NotFoundException(__('Invalid organization'));
		}
		$options = array('conditions' => array('Organization.' . $this->Organization->primaryKey => $id));
		$this->set('organization', $this->Organization->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Organization->create();
			if ($this->Organization->save($this->request->data)) {
				$this->Session->setFlash(__('The organization has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The organization could not be saved. Please, try again.'));
			}
		}
		$users = $this->Organization->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Organization->exists($id)) {
			throw new NotFoundException(__('Invalid organization'));
		}

		//check to see if the user is owner of the organization or an admin one..
		$user = $this->getUserData();
		$org = $this->Organization->find('first', array('conditions' => array('Organization.id' => $id)));
		if($org['Organization']['user_id'] != $user['id'] && $user['role_id'] != 1){
			$this->Session->setFlash(__('You dont have permission to edit this organization.'));
			$this->redirect($this->referer());
		}

		if ($this->request->is(array('post', 'put'))) {
			if ($this->Organization->save($this->request->data)) {
				$this->Session->setFlash(__('The organization has been saved.'));
				
				//returning to the admin panel
				return $this->redirect(array('controller' => 'panels', 'action' => 'index', 'organizations'));
			} else {
				$this->Session->setFlash(__('The organization could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Organization.' . $this->Organization->primaryKey => $id));
			$this->request->data = $this->Organization->find('first', $options);
		}

		if($user['role_id'] != 1) $users = $this->Organization->User->find('list', array('conditions' => array('User.id' => $user['id'])));
		else $users = $this->Organization->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Organization->id = $id;
		if (!$this->Organization->exists()) {
			throw new NotFoundException(__('Invalid organization'));
		}

		//check to see if the user is owner of the organization or an admin one..
		$user = $this->getUserData();
		$org = $this->Organization->find('first', array('conditions' => array('Organization.id' => $id)));
		if($org['Organization']['user_id'] != $user['id'] && $user['role_id'] != 1){
			$this->Session->setFlash(__('You dont have permission to edit this organization.'));
			$this->redirect($this->referer());
		}

		$this->request->onlyAllow('post', 'delete');
		if ($this->Organization->delete()) {
			$this->Session->setFlash(__('The organization has been deleted.'));
			//returning to the admin panel
			return $this->redirect(array('controller' => 'panels', 'action' => 'index', 'organizations'));
		} else {
			$this->Session->setFlash(__('The organization could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
