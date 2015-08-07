<?php
App::uses('AppController', 'Controller');
/**
 * MissionSubscriptions Controller
 *
 * @property MissionSubscription $MissionSubscription
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MissionSubscriptionsController extends AppController {

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
		$this->MissionSubscription->recursive = 0;
		$this->set('missionSubscriptions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MissionSubscription->exists($id)) {
			throw new NotFoundException(__('Invalid mission subscription'));
		}
		$options = array('conditions' => array('MissionSubscription.' . $this->MissionSubscription->primaryKey => $id));
		$this->set('missionSubscription', $this->MissionSubscription->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MissionSubscription->create();
			if ($this->MissionSubscription->save($this->request->data)) {
				$this->Session->setFlash(__('The mission subscription has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mission subscription could not be saved. Please, try again.'));
			}
		}
		$users = $this->MissionSubscription->User->find('list');
		$missions = $this->MissionSubscription->Mission->find('list');
		$phases = $this->MissionSubscription->Phase->find('list');
		$this->set(compact('users', 'missions', 'phases'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->MissionSubscription->exists($id)) {
			throw new NotFoundException(__('Invalid mission subscription'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MissionSubscription->save($this->request->data)) {
				$this->Session->setFlash(__('The mission subscription has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mission subscription could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MissionSubscription.' . $this->MissionSubscription->primaryKey => $id));
			$this->request->data = $this->MissionSubscription->find('first', $options);
		}
		$users = $this->MissionSubscription->User->find('list');
		$missions = $this->MissionSubscription->Mission->find('list');
		$phases = $this->MissionSubscription->Phase->find('list');
		$this->set(compact('users', 'missions', 'phases'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->MissionSubscription->id = $id;
		if (!$this->MissionSubscription->exists()) {
			throw new NotFoundException(__('Invalid mission subscription'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->MissionSubscription->delete()) {
			$this->Session->setFlash(__('The mission subscription has been deleted.'));
		} else {
			$this->Session->setFlash(__('The mission subscription could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
