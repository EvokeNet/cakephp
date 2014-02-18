<?php
App::uses('AppController', 'Controller');
/**
 * Issues Controller
 *
 * @property Issue $Issue
 * @property PaginatorComponent $Paginator
 */
class IssuesController extends AppController {

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
		$this->Issue->recursive = 0;
		$this->set('issues', $this->Paginator->paginate());

		// $this->loadModel('MissionIssue');
		// $missionissues = $this->MissionIssue->find('all', array('order' => 'MissionIssue.issue_id',));
		// $this->set(compact('missionissues'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Issue->exists($id)) {
			throw new NotFoundException(__('Invalid issue'));
		}
		$options = array('conditions' => array('Issue.' . $this->Issue->primaryKey => $id));
		$this->set('issue', $this->Issue->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Issue->create();
			if ($this->Issue->save($this->request->data)) {
				$this->Session->setFlash(__('The issue has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The issue could not be saved. Please, try again.'));
			}
		}
		$parentIssues = $this->Issue->ParentIssue->find('list');
		$this->set(compact('parentIssues'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Issue->exists($id)) {
			throw new NotFoundException(__('Invalid issue'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Issue->save($this->request->data)) {
				$this->Session->setFlash(__('The issue has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The issue could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Issue.' . $this->Issue->primaryKey => $id));
			$this->request->data = $this->Issue->find('first', $options);
		}
		$parentIssues = $this->Issue->ParentIssue->find('list');
		$this->set(compact('parentIssues'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Issue->id = $id;
		if (!$this->Issue->exists()) {
			throw new NotFoundException(__('Invalid issue'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Issue->delete()) {
			$this->Session->setFlash(__('The issue has been deleted.'));
		} else {
			$this->Session->setFlash(__('The issue could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Issue->recursive = 0;
		$this->set('issues', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Issue->exists($id)) {
			throw new NotFoundException(__('Invalid issue'));
		}
		$options = array('conditions' => array('Issue.' . $this->Issue->primaryKey => $id));
		$this->set('issue', $this->Issue->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Issue->create();
			if ($this->Issue->save($this->request->data)) {
				$this->Session->setFlash(__('The issue has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The issue could not be saved. Please, try again.'));
			}
		}
		$parentIssues = $this->Issue->ParentIssue->find('list');
		$this->set(compact('parentIssues'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Issue->exists($id)) {
			throw new NotFoundException(__('Invalid issue'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Issue->save($this->request->data)) {
				$this->Session->setFlash(__('The issue has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The issue could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Issue.' . $this->Issue->primaryKey => $id));
			$this->request->data = $this->Issue->find('first', $options);
		}
		$parentIssues = $this->Issue->ParentIssue->find('list');
		$this->set(compact('parentIssues'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Issue->id = $id;
		if (!$this->Issue->exists()) {
			throw new NotFoundException(__('Invalid issue'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Issue->delete()) {
			$this->Session->setFlash(__('The issue has been deleted.'));
		} else {
			$this->Session->setFlash(__('The issue could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
