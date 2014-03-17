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
		$this->MissionIssue->recursive = 0;
		$this->set('missionIssues', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MissionIssue->exists($id)) {
			throw new NotFoundException(__('Invalid mission issue'));
		}
		$options = array('conditions' => array('MissionIssue.' . $this->MissionIssue->primaryKey => $id));
		$this->set('missionIssue', $this->MissionIssue->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MissionIssue->create();
			if ($this->MissionIssue->save($this->request->data)) {
				$this->Session->setFlash(__('The mission issue has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mission issue could not be saved. Please, try again.'));
			}
		}
		$missions = $this->MissionIssue->Mission->find('list');
		$issues = $this->MissionIssue->Issue->find('list');
		$this->set(compact('missions', 'issues'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
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
		$missions = $this->MissionIssue->Mission->find('list');
		$issues = $this->MissionIssue->Issue->find('list');
		$this->set(compact('missions', 'issues'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
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

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->MissionIssue->recursive = 0;
		$this->set('missionIssues', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->MissionIssue->exists($id)) {
			throw new NotFoundException(__('Invalid mission issue'));
		}
		$options = array('conditions' => array('MissionIssue.' . $this->MissionIssue->primaryKey => $id));
		$this->set('missionIssue', $this->MissionIssue->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->MissionIssue->create();
			if ($this->MissionIssue->save($this->request->data)) {
				$this->Session->setFlash(__('The mission issue has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mission issue could not be saved. Please, try again.'));
			}
		}
		$missions = $this->MissionIssue->Mission->find('list');
		$issues = $this->MissionIssue->Issue->find('list');
		$this->set(compact('missions', 'issues'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
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
		$missions = $this->MissionIssue->Mission->find('list');
		$issues = $this->MissionIssue->Issue->find('list');
		$this->set(compact('missions', 'issues'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
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
	}}
