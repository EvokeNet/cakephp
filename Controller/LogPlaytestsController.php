<?php
App::uses('AppController', 'Controller');
/**
 * LogPlaytests Controller
 *
 * @property LogPlaytest $LogPlaytest
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class LogPlaytestsController extends AppController {

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
		$this->autoRender = false;
		$this->LogPlaytest->recursive = 0;
		$this->set('log_playtests', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->autoRender = false;
		if (!$this->LogPlaytest->exists($id)) {
			throw new NotFoundException(__('Invalid LogPlaytest'));
		}
		$options = array('conditions' => array('LogPlaytest.' . $this->LogPlaytest->primaryKey => $id));
		$this->set('log_playtest', $this->LogPlaytest->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->autoRender = false;
		if ($this->request->is('post')) {

			//------------- FOR THE PLAYTEST ------------- //
			$loggedInUserId = $this->getUserId();
			$this->loadModel('LogPlaytest');
			return $this->LogPlaytest->log_playtest_add($this->request->data['action_performed']);
			//------------- FOR THE PLAYTEST ------------- //
			
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
		if (!$this->LogPlaytest->exists($id)) {
			throw new NotFoundException(__('Invalid LogPlaytest'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->LogPlaytest->save($this->request->data)) {
				// $this->Session->setFlash(__('The LogPlaytest has been saved.'));
				// return $this->redirect(array('action' => 'index'));
			} else {
				// $this->Session->setFlash(__('The LogPlaytest could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('LogPlaytest.' . $this->LogPlaytest->primaryKey => $id));
			$this->request->data = $this->LogPlaytest->find('first', $options);
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
		$this->LogPlaytest->id = $id;
		if (!$this->LogPlaytest->exists()) {
			throw new NotFoundException(__('Invalid LogPlaytest'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->LogPlaytest->delete()) {
			return false;
			// $this->Session->setFlash(__('The LogPlaytest has been deleted.'));
		} else {
			return true;
			// $this->Session->setFlash(__('The LogPlaytest could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

}
