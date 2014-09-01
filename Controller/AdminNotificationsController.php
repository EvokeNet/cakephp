<?php
App::uses('AppController', 'Controller');
/**
 * AdminNotifications Controller
 *
 * @property AdminNotification $AdminNotification
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AdminNotificationsController extends AppController {

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
		$this->AdminNotification->recursive = 0;
		$this->set('adminNotifications', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AdminNotification->exists($id)) {
			throw new NotFoundException(__('Invalid admin notification'));
		}
		$options = array('conditions' => array('AdminNotification.' . $this->AdminNotification->primaryKey => $id));
		$this->set('adminNotification', $this->AdminNotification->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AdminNotification->create();
			if ($this->AdminNotification->save($this->request->data)) {
				$this->Session->setFlash(__('The admin notification has been saved.'));
				return $this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The admin notification could not be saved. Please, try again.'));
			}
		}
		$users = $this->AdminNotification->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->AdminNotification->exists($id)) {
			throw new NotFoundException(__('Invalid admin notification'));
		}
		$this->AdminNotification->id = $id;

		if ($this->request->is(array('post', 'put'))) {
			if ($this->AdminNotification->save($this->request->data)) {
				$this->Session->setFlash(__('The admin notification has been saved.'));
				return $this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The admin notification could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AdminNotification.' . $this->AdminNotification->primaryKey => $id));
			$this->request->data = $this->AdminNotification->find('first', $options);
		}
		$users = $this->AdminNotification->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->AdminNotification->id = $id;
		if (!$this->AdminNotification->exists()) {
			throw new NotFoundException(__('Invalid admin notification'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->AdminNotification->delete()) {
			$this->Session->setFlash(__('The admin notification has been deleted.'));
		} else {
			$this->Session->setFlash(__('The admin notification could not be deleted. Please, try again.'));
		}
		return $this->redirect($this->referer());
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->AdminNotification->recursive = 0;
		$this->set('adminNotifications', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->AdminNotification->exists($id)) {
			throw new NotFoundException(__('Invalid admin notification'));
		}
		$options = array('conditions' => array('AdminNotification.' . $this->AdminNotification->primaryKey => $id));
		$this->set('adminNotification', $this->AdminNotification->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->AdminNotification->create();
			if ($this->AdminNotification->save($this->request->data)) {
				$this->Session->setFlash(__('The admin notification has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The admin notification could not be saved. Please, try again.'));
			}
		}
		$users = $this->AdminNotification->User->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->AdminNotification->exists($id)) {
			throw new NotFoundException(__('Invalid admin notification'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->AdminNotification->save($this->request->data)) {
				$this->Session->setFlash(__('The admin notification has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The admin notification could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AdminNotification.' . $this->AdminNotification->primaryKey => $id));
			$this->request->data = $this->AdminNotification->find('first', $options);
		}
		$users = $this->AdminNotification->User->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->AdminNotification->id = $id;
		if (!$this->AdminNotification->exists()) {
			throw new NotFoundException(__('Invalid admin notification'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->AdminNotification->delete()) {
			$this->Session->setFlash(__('The admin notification has been deleted.'));
		} else {
			$this->Session->setFlash(__('The admin notification could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
