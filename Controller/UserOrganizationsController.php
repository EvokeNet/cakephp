<?php
App::uses('AppController', 'Controller');
/**
 * UserOrganizations Controller
 *
 * @property UserOrganization $UserOrganization
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserOrganizationsController extends AppController {

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
		$this->UserOrganization->recursive = 0;
		$this->set('userOrganizations', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserOrganization->exists($id)) {
			throw new NotFoundException(__('Invalid user organization'));
		}
		$options = array('conditions' => array('UserOrganization.' . $this->UserOrganization->primaryKey => $id));
		$this->set('userOrganization', $this->UserOrganization->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserOrganization->create();
			if ($this->UserOrganization->save($this->request->data)) {
				$this->Session->setFlash(__('The user organization has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user organization could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserOrganization->User->find('list');
		$organizations = $this->UserOrganization->Organization->find('list');
		$this->set(compact('users', 'organizations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UserOrganization->exists($id)) {
			throw new NotFoundException(__('Invalid user organization'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserOrganization->save($this->request->data)) {
				$this->Session->setFlash(__('The user organization has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user organization could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserOrganization.' . $this->UserOrganization->primaryKey => $id));
			$this->request->data = $this->UserOrganization->find('first', $options);
		}
		$users = $this->UserOrganization->User->find('list');
		$organizations = $this->UserOrganization->Organization->find('list');
		$this->set(compact('users', 'organizations'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserOrganization->id = $id;
		if (!$this->UserOrganization->exists()) {
			throw new NotFoundException(__('Invalid user organization'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserOrganization->delete()) {
			$this->Session->setFlash(__('The user organization has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user organization could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
