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
	public $components = array('Paginator', 'Session', 'Access');
	public $user = null;

	public function beforeFilter() {
        parent::beforeFilter();
        
        $this->user = array();
        //get user data into public var
		$this->user['role_id'] = $this->getUserRole();
		$this->user['id'] = $this->getUserId();
		$this->user['name'] = $this->getUserName();
		
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
 * add method
 *
 * @return void
 */
	public function add() {
		$this->autoRender = false;

		if ($this->request->is('post')) {
			$this->UserOrganization->create();
			if ($this->UserOrganization->save($this->request->data)) {
				$this->Session->setFlash(__('The user organization has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user organization could not be saved. Please, try again.'));
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
		$this->autoRender = false;

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
	}
}
