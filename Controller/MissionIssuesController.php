<?php
App::uses('AppController', 'Controller');
/**
 * MissionIssues Controller
 *
 * @property MissionIssue $MissionIssue
 * @property PaginatorComponent $Paginator
 */
class MissionIssuesController extends AppController {

/**
 * Components
 *
 * @var array
 */

	public $components = array('Paginator', 'Access');
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
			$this->MissionIssue->create();
			if ($this->MissionIssue->save($this->request->data)) {
				$this->Session->setFlash(__('The mission issue has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mission issue could not be saved. Please, try again.'));
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

		if (!$this->MissionIssue->exists($id)) {
			throw new NotFoundException(__('Invalid mission issue'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MissionIssue->save($this->request->data)) {
				$this->Session->setFlash(__('The mission issue has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mission issue could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MissionIssue.' . $this->MissionIssue->primaryKey => $id));
			$this->request->data = $this->MissionIssue->find('first', $options);
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

		$this->MissionIssue->id = $id;
		if (!$this->MissionIssue->exists()) {
			throw new NotFoundException(__('Invalid mission issue'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->MissionIssue->delete()) {
			$this->Session->setFlash(__('The mission issue has been deleted.'));
		} else {
			$this->Session->setFlash(__('The mission issue could not be deleted. Please, try again.'));
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
			$this->MissionIssue->create();
			if ($this->MissionIssue->save($this->request->data)) {
				$this->Session->setFlash(__('The mission issue has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mission issue could not be saved. Please, try again.'));
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

		if (!$this->MissionIssue->exists($id)) {
			throw new NotFoundException(__('Invalid mission issue'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MissionIssue->save($this->request->data)) {
				$this->Session->setFlash(__('The mission issue has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mission issue could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MissionIssue.' . $this->MissionIssue->primaryKey => $id));
			$this->request->data = $this->MissionIssue->find('first', $options);
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

		$this->MissionIssue->id = $id;
		if (!$this->MissionIssue->exists()) {
			throw new NotFoundException(__('Invalid mission issue'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->MissionIssue->delete()) {
			$this->Session->setFlash(__('The mission issue has been deleted.'));
		} else {
			$this->Session->setFlash(__('The mission issue could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
