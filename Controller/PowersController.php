<?php
App::uses('AppController', 'Controller');
/**
 * Powers Controller
 *
 * @property Power $Power
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PowersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Power->recursive = 0;
		$this->set('powers', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Power->exists($id)) {
			throw new NotFoundException(__('Invalid power'));
		}
		$options = array('conditions' => array('Power.' . $this->Power->primaryKey => $id));
		$this->set('power', $this->Power->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Power->create();
			if ($this->Power->save($this->request->data)) {
				$this->Session->setFlash(__('The power has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The power could not be saved. Please, try again.'));
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
		if (!$this->Power->exists($id)) {
			throw new NotFoundException(__('Invalid power'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Power->save($this->request->data)) {
				$this->Session->setFlash(__('The power has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The power could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Power.' . $this->Power->primaryKey => $id));
			$this->request->data = $this->Power->find('first', $options);
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
		$this->Power->id = $id;
		if (!$this->Power->exists()) {
			throw new NotFoundException(__('Invalid power'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Power->delete()) {
			$this->Session->setFlash(__('The power has been deleted.'));
		} else {
			$this->Session->setFlash(__('The power could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
