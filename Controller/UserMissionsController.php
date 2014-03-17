<?php
App::uses('AppController', 'Controller');
/**
 * UserMissions Controller
 *
 * @property UserMission $UserMission
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserMissionsController extends AppController {

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
		$this->UserMission->recursive = 0;
		$this->set('userMissions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserMission->exists($id)) {
			throw new NotFoundException(__('Invalid user mission'));
		}
		$options = array('conditions' => array('UserMission.' . $this->UserMission->primaryKey => $id));
		$this->set('userMission', $this->UserMission->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserMission->create();
			if ($this->UserMission->save($this->request->data)) {
				$this->Session->setFlash(__('The user mission has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user mission could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserMission->User->find('list');
		$missions = $this->UserMission->Mission->find('list');
		$this->set(compact('users', 'missions'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UserMission->exists($id)) {
			throw new NotFoundException(__('Invalid user mission'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserMission->save($this->request->data)) {
				$this->Session->setFlash(__('The user mission has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user mission could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserMission.' . $this->UserMission->primaryKey => $id));
			$this->request->data = $this->UserMission->find('first', $options);
		}
		$users = $this->UserMission->User->find('list');
		$missions = $this->UserMission->Mission->find('list');
		$this->set(compact('users', 'missions'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserMission->id = $id;
		if (!$this->UserMission->exists()) {
			throw new NotFoundException(__('Invalid user mission'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserMission->delete()) {
			$this->Session->setFlash(__('The user mission has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user mission could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
