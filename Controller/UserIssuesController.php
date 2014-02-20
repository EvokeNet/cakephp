<?php
App::uses('AppController', 'Controller');
/**
 * UserIssues Controller
 *
 * @property UserIssue $UserIssue
 * @property PaginatorComponent $Paginator
 */
class UserIssuesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UserIssue->recursive = 0;
		$this->set('userIssues', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserIssue->exists($id)) {
			throw new NotFoundException(__('Invalid user issue'));
		}
		$options = array('conditions' => array('UserIssue.' . $this->UserIssue->primaryKey => $id));
		$this->set('userIssue', $this->UserIssue->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			// debug($this->request->data);
			// die();
			$status = false;
			$user = $this->request->data['UserIssue']['user_id'];
			foreach ($this->request->data['UserIssue']['issue_id'] as $a) {
		        $this->UserIssue->create();
		        $insertData = array('user_id' => $user, 'issue_id' => $a);
		        $status = $this->UserIssue->save($insertData);
		        if(!$status) {$this->Session->setFlash(__('The user issue could not be saved. Please, try again.')); break;}
		    } 
	        
	        if($status) $this->Session->setFlash(__('The user issue has been saved.'));
		    
		    return $this->redirect(array('action' => 'index'));
		}
		$users = $this->UserIssue->User->find('list');
		$issues = $this->UserIssue->Issue->find('list');
		$this->set(compact('users', 'issues'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UserIssue->exists($id)) {
			throw new NotFoundException(__('Invalid user issue'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserIssue->save($this->request->data)) {
				$this->Session->setFlash(__('The user issue has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user issue could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserIssue.' . $this->UserIssue->primaryKey => $id));
			$this->request->data = $this->UserIssue->find('first', $options);
		}
		$users = $this->UserIssue->User->find('list');
		$issues = $this->UserIssue->Issue->find('list');
		$this->set(compact('users', 'issues'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserIssue->id = $id;
		if (!$this->UserIssue->exists()) {
			throw new NotFoundException(__('Invalid user issue'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserIssue->delete()) {
			$this->Session->setFlash(__('The user issue has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user issue could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->UserIssue->recursive = 0;
		$this->set('userIssues', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->UserIssue->exists($id)) {
			throw new NotFoundException(__('Invalid user issue'));
		}
		$options = array('conditions' => array('UserIssue.' . $this->UserIssue->primaryKey => $id));
		$this->set('userIssue', $this->UserIssue->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->UserIssue->create();
			if ($this->UserIssue->save($this->request->data)) {
				$this->Session->setFlash(__('The user issue has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user issue could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserIssue->User->find('list');
		$issues = $this->UserIssue->Issue->find('list');
		$this->set(compact('users', 'issues'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->UserIssue->exists($id)) {
			throw new NotFoundException(__('Invalid user issue'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserIssue->save($this->request->data)) {
				$this->Session->setFlash(__('The user issue has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user issue could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserIssue.' . $this->UserIssue->primaryKey => $id));
			$this->request->data = $this->UserIssue->find('first', $options);
		}
		$users = $this->UserIssue->User->find('list');
		$issues = $this->UserIssue->Issue->find('list');
		$this->set(compact('users', 'issues'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->UserIssue->id = $id;
		if (!$this->UserIssue->exists()) {
			throw new NotFoundException(__('Invalid user issue'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserIssue->delete()) {
			$this->Session->setFlash(__('The user issue has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user issue could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
