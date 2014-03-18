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
	public $components = array('Paginator', 'Session', 'Access');
	public $uses = array('Organization', 'UserOrganization', 'User');
	public $user = null;

	public function beforeFilter() {
        parent::beforeFilter();
        //test to get user data from proper index
		$this->user = $this->Auth->user();
		
		//there was some problem in retrieving user's info concerning his/her role : send him home
		if(!isset($this->user['role_id']) || is_null($this->user['role_id'])) {
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}

		//checking Acl permission
		if(!$this->Access->check($this->user['role_id'],'controllers/'. $this->name .'/'.$this->action)) {
			$this->Session->setFlash(__("You don't have permission to access this area. If needed, contact the administrator."));	
			$this->redirect($this->referer());
		}
    }

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
		$user = $this->Auth->user();
		$org = $this->Organization->UserOrganization->find('first', array('conditions' => array('UserOrganization.organization_id' => $id)));
		if($org['UserOrganization']['user_id'] != $user['id'] && $user['role_id'] != 1){
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
		/*
		if($user['role_id'] != 1) $users = $this->Organization->UserOrganization->User->find('list', array('conditions' => array('User.id' => $user['id'])));
		else $users = $this->Organization->User->find('list');
		$this->set(compact('users'));*/
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
		$user = $this->Auth->user();
		$org = $this->Organization->UserOrganization->find('first', array('conditions' => array('UserOrganization.organization_id' => $id)));
		if($org['UserOrganization']['user_id'] != $user['id'] && $user['role_id'] != 1){
			$this->Session->setFlash(__('You dont have permission to edit this organization.'));
			$this->redirect($this->referer());
		}

		$this->request->onlyAllow('post', 'delete');
		if ($this->UserOrganization->deleteAll(array('UserOrganization.organization_id' => $id)) && $this->Organization->delete()) {
			$this->Session->setFlash(__('The organization has been deleted.'));
			//returning to the admin panel
			return $this->redirect(array('controller' => 'panels', 'action' => 'index', 'organizations'));
		} else {
			$this->Session->setFlash(__('The organization could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}