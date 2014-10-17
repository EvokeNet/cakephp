<?php
App::uses('AppController', 'Controller');
/**
 * UserBadges Controller
 *
 * @property UserBadge $UserBadge
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserBadgesController extends AppController {

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
		$this->UserBadge->recursive = 0;
		$this->set('userBadges', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserBadge->exists($id)) {
			throw new NotFoundException(__('Invalid user badge'));
		}
		$options = array('conditions' => array('UserBadge.' . $this->UserBadge->primaryKey => $id));
		$this->set('userBadge', $this->UserBadge->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserBadge->create();
			if ($this->UserBadge->save($this->request->data)) {
				$this->Session->setFlash(__('The user badge has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user badge could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserBadge->User->find('list');
		$badges = $this->UserBadge->Badge->find('list');
		$this->set(compact('users', 'badges'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UserBadge->exists($id)) {
			throw new NotFoundException(__('Invalid user badge'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserBadge->save($this->request->data)) {
				$this->Session->setFlash(__('The user badge has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user badge could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserBadge.' . $this->UserBadge->primaryKey => $id));
			$this->request->data = $this->UserBadge->find('first', $options);
		}
		$users = $this->UserBadge->User->find('list');
		$badges = $this->UserBadge->Badge->find('list');
		$this->set(compact('users', 'badges'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserBadge->id = $id;
		if (!$this->UserBadge->exists()) {
			throw new NotFoundException(__('Invalid user badge'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UserBadge->delete()) {
			$this->Session->setFlash(__('The user badge has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user badge could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->UserBadge->recursive = 0;
		$this->set('userBadges', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->UserBadge->exists($id)) {
			throw new NotFoundException(__('Invalid user badge'));
		}
		$options = array('conditions' => array('UserBadge.' . $this->UserBadge->primaryKey => $id));
		$this->set('userBadge', $this->UserBadge->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->UserBadge->create();
			if ($this->UserBadge->save($this->request->data)) {
				$this->Session->setFlash(__('The user badge has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user badge could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserBadge->User->find('list');
		$badges = $this->UserBadge->Badge->find('list');
		$this->set(compact('users', 'badges'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->UserBadge->exists($id)) {
			throw new NotFoundException(__('Invalid user badge'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserBadge->save($this->request->data)) {
				$this->Session->setFlash(__('The user badge has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user badge could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserBadge.' . $this->UserBadge->primaryKey => $id));
			$this->request->data = $this->UserBadge->find('first', $options);
		}
		$users = $this->UserBadge->User->find('list');
		$badges = $this->UserBadge->Badge->find('list');
		$this->set(compact('users', 'badges'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->UserBadge->id = $id;
		if (!$this->UserBadge->exists()) {
			throw new NotFoundException(__('Invalid user badge'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UserBadge->delete()) {
			$this->Session->setFlash(__('The user badge has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user badge could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
