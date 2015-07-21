<?php
App::uses('AppController', 'Controller');

/**
 * Evokations Controller
 *
 * @property Evokation $Evokation
 * @property PaginatorComponent $Paginator
 */
class EvokationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	
	public function beforeFilter() {
        parent::beforeFilter();
        //$this->Auth->allow('view');
    }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Evokation->recursive = 0;
		$this->set('evokations', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @deprecated This method has been emptied out in Evoke 2.0. Previously, it used etherpad for evokation content.
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null, $update_id = null) {
		if (!$this->Evokation->exists($id)) {
			throw new NotFoundException(__('Invalid evokation'));
		}
	}

/**
 * view draft method
 *
 * @deprecated This method has been emptied out in Evoke 2.0.
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function viewDraft($id = null) {
		if (!$this->Evokation->exists($id)) {
			throw new NotFoundException(__('Invalid evokation'));
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Evokation->create();
			if ($this->Evokation->save($this->request->data)) {
				$this->Session->setFlash(__('The evokation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evokation could not be saved. Please, try again.'));
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
		if (!$this->Evokation->exists($id)) {
			throw new NotFoundException(__('Invalid evokation'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Evokation->save($this->request->data)) {
				$this->Session->setFlash(__('The evokation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evokation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Evokation.' . $this->Evokation->primaryKey => $id));
			$this->request->data = $this->Evokation->find('first', $options);
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
		$this->Evokation->id = $id;
		if (!$this->Evokation->exists()) {
			throw new NotFoundException(__('Invalid evokation'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Evokation->delete()) {
			$this->Session->setFlash(__('The evokation has been deleted.'));
		} else {
			$this->Session->setFlash(__('The evokation could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Evokation->recursive = 0;
		$this->set('evokations', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Evokation->exists($id)) {
			throw new NotFoundException(__('Invalid evokation'));
		}
		$options = array('conditions' => array('Evokation.' . $this->Evokation->primaryKey => $id));
		$this->set('evokation', $this->Evokation->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Evokation->create();
			if ($this->Evokation->save($this->request->data)) {
				$this->Session->setFlash(__('The evokation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evokation could not be saved. Please, try again.'));
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
		if (!$this->Evokation->exists($id)) {
			throw new NotFoundException(__('Invalid evokation'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Evokation->save($this->request->data)) {
				$this->Session->setFlash(__('The evokation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evokation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Evokation.' . $this->Evokation->primaryKey => $id));
			$this->request->data = $this->Evokation->find('first', $options);
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
		$this->Evokation->id = $id;
		if (!$this->Evokation->exists()) {
			throw new NotFoundException(__('Invalid evokation'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Evokation->delete()) {
			$this->Session->setFlash(__('The evokation has been deleted.'));
		} else {
			$this->Session->setFlash(__('The evokation could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
