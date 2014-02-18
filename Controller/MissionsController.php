<?php
App::uses('AppController', 'Controller');
/**
 * Missions Controller
 *
 * @property Mission $Mission
 * @property PaginatorComponent $Paginator
 */
class MissionsController extends AppController {

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
		// $this->Mission->recursive = 0;
		// $this->set('missions', $this->Paginator->paginate());

		$this->loadModel('MissionIssue');
		$missionissues = $this->MissionIssue->find('all', array('order' => 'MissionIssue.issue_id',));
		$this->set(compact('missionissues'));

		$this->loadModel('Issue');
		$issues = $this->Issue->find('all');
		$this->set(compact('issues'));
		//$this->set('mission', $this->Mission->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Mission->exists($id)) {
			throw new NotFoundException(__('Invalid mission'));
		}
		$options = array('conditions' => array('Mission.' . $this->Mission->primaryKey => $id));
		$this->set('mission', $this->Mission->find('first', $options));

		// $opt = array('order' => array('Evidence.created DESC'), 'conditions' => array('Evidence.mission_id' =>$id));
		// $this->set('evidence', $this->Mission->Evidence->find('all', $opt));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Mission->create();
			if ($this->Mission->save($this->request->data)) {
				$this->Session->setFlash(__('The mission has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mission could not be saved. Please, try again.'));
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
		if (!$this->Mission->exists($id)) {
			throw new NotFoundException(__('Invalid mission'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Mission->save($this->request->data)) {
				$this->Session->setFlash(__('The mission has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mission could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Mission.' . $this->Mission->primaryKey => $id));
			$this->request->data = $this->Mission->find('first', $options);
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
		$this->Mission->id = $id;
		if (!$this->Mission->exists()) {
			throw new NotFoundException(__('Invalid mission'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Mission->delete()) {
			$this->Session->setFlash(__('The mission has been deleted.'));
		} else {
			$this->Session->setFlash(__('The mission could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Mission->recursive = 0;
		$this->set('missions', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Mission->exists($id)) {
			throw new NotFoundException(__('Invalid mission'));
		}
		$options = array('conditions' => array('Mission.' . $this->Mission->primaryKey => $id));
		$this->set('mission', $this->Mission->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Mission->create();
			if ($this->Mission->save($this->request->data)) {
				$this->Session->setFlash(__('The mission has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mission could not be saved. Please, try again.'));
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
		if (!$this->Mission->exists($id)) {
			throw new NotFoundException(__('Invalid mission'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Mission->save($this->request->data)) {
				$this->Session->setFlash(__('The mission has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mission could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Mission.' . $this->Mission->primaryKey => $id));
			$this->request->data = $this->Mission->find('first', $options);
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
		$this->Mission->id = $id;
		if (!$this->Mission->exists()) {
			throw new NotFoundException(__('Invalid mission'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Mission->delete()) {
			$this->Session->setFlash(__('The mission has been deleted.'));
		} else {
			$this->Session->setFlash(__('The mission could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
