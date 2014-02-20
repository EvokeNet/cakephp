<?php
App::uses('AppController', 'Controller');
/**
 * MissionPhases Controller
 *
 * @property MissionPhase $MissionPhase
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MissionPhasesController extends AppController {

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
		$this->MissionPhase->recursive = 0;
		$this->set('missionPhases', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MissionPhase->exists($id)) {
			throw new NotFoundException(__('Invalid mission phase'));
		}
		$options = array('conditions' => array('MissionPhase.' . $this->MissionPhase->primaryKey => $id));
		$this->set('missionPhase', $this->MissionPhase->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MissionPhase->create();
			if ($this->MissionPhase->save($this->request->data)) {
				$this->Session->setFlash(__('The mission phase has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mission phase could not be saved. Please, try again.'));
			}
		}
		$missions = $this->MissionPhase->Mission->find('list');
		$phases = $this->MissionPhase->Phase->find('list');
		$this->set(compact('missions', 'phases'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->MissionPhase->exists($id)) {
			throw new NotFoundException(__('Invalid mission phase'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MissionPhase->save($this->request->data)) {
				$this->Session->setFlash(__('The mission phase has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mission phase could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MissionPhase.' . $this->MissionPhase->primaryKey => $id));
			$this->request->data = $this->MissionPhase->find('first', $options);
		}
		$missions = $this->MissionPhase->Mission->find('list');
		$phases = $this->MissionPhase->Phase->find('list');
		$this->set(compact('missions', 'phases'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->MissionPhase->id = $id;
		if (!$this->MissionPhase->exists()) {
			throw new NotFoundException(__('Invalid mission phase'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->MissionPhase->delete()) {
			$this->Session->setFlash(__('The mission phase has been deleted.'));
		} else {
			$this->Session->setFlash(__('The mission phase could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->MissionPhase->recursive = 0;
		$this->set('missionPhases', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->MissionPhase->exists($id)) {
			throw new NotFoundException(__('Invalid mission phase'));
		}
		$options = array('conditions' => array('MissionPhase.' . $this->MissionPhase->primaryKey => $id));
		$this->set('missionPhase', $this->MissionPhase->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->MissionPhase->create();
			if ($this->MissionPhase->save($this->request->data)) {
				$this->Session->setFlash(__('The mission phase has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mission phase could not be saved. Please, try again.'));
			}
		}
		$missions = $this->MissionPhase->Mission->find('list');
		$phases = $this->MissionPhase->Phase->find('list');
		$this->set(compact('missions', 'phases'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->MissionPhase->exists($id)) {
			throw new NotFoundException(__('Invalid mission phase'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MissionPhase->save($this->request->data)) {
				$this->Session->setFlash(__('The mission phase has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mission phase could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MissionPhase.' . $this->MissionPhase->primaryKey => $id));
			$this->request->data = $this->MissionPhase->find('first', $options);
		}
		$missions = $this->MissionPhase->Mission->find('list');
		$phases = $this->MissionPhase->Phase->find('list');
		$this->set(compact('missions', 'phases'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->MissionPhase->id = $id;
		if (!$this->MissionPhase->exists()) {
			throw new NotFoundException(__('Invalid mission phase'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->MissionPhase->delete()) {
			$this->Session->setFlash(__('The mission phase has been deleted.'));
		} else {
			$this->Session->setFlash(__('The mission phase could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
