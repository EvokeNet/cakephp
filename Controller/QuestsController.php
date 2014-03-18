<?php
App::uses('AppController', 'Controller');
/**
 * Quests Controller
 *
 * @property Quest $Quest
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class QuestsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Access');
	public $user = null;

	public function beforeFilter() {
        parent::beforeFilter();
        //test to get user data from proper index
		$this->user = $this->Auth->user();
		
		//there was some problem in retrieving user's info concerning his/her role : send him home
		if(!isset($this->user['role_id']) || is_null($this->user['role_id'])) {
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}

		//checking Acl permission
		if(!$this->Access->check($this->user['role_id'],'controllers/'. $this->name .'/'.$this->action)) {
			$this->Session->setFlash(__("You don't have permission to access this area. If needed, contact the administrator."));	
			$this->redirect($this->referer());
		}
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Quest->recursive = 0;
		$this->set('quests', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Quest->exists($id)) {
			throw new NotFoundException(__('Invalid quest'));
		}
		$options = array('conditions' => array('Quest.' . $this->Quest->primaryKey => $id));
		$this->set('quest', $this->Quest->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Quest->create();
			if ($this->Quest->save($this->request->data)) {
				$this->Session->setFlash(__('The quest has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quest could not be saved. Please, try again.'));
			}
		}
		$missions = $this->Quest->Mission->find('list');
		$phases = $this->Quest->Phase->find('list');
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
		if (!$this->Quest->exists($id)) {
			throw new NotFoundException(__('Invalid quest'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Quest->save($this->request->data)) {
				$this->Session->setFlash(__('The quest has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quest could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Quest.' . $this->Quest->primaryKey => $id));
			$this->request->data = $this->Quest->find('first', $options);
		}
		$missions = $this->Quest->Mission->find('list');
		$phases = $this->Quest->Phase->find('list');
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
		$this->Quest->id = $id;
		if (!$this->Quest->exists()) {
			throw new NotFoundException(__('Invalid quest'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Quest->delete()) {
			$this->Session->setFlash(__('The quest has been deleted.'));
		} else {
			$this->Session->setFlash(__('The quest could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Quest->recursive = 0;
		$this->set('quests', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Quest->exists($id)) {
			throw new NotFoundException(__('Invalid quest'));
		}
		$options = array('conditions' => array('Quest.' . $this->Quest->primaryKey => $id));
		$this->set('quest', $this->Quest->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Quest->create();
			if ($this->Quest->save($this->request->data)) {
				$this->Session->setFlash(__('The quest has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quest could not be saved. Please, try again.'));
			}
		}
		$missions = $this->Quest->Mission->find('list');
		$phases = $this->Quest->Phase->find('list');
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
		if (!$this->Quest->exists($id)) {
			throw new NotFoundException(__('Invalid quest'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Quest->save($this->request->data)) {
				$this->Session->setFlash(__('The quest has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quest could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Quest.' . $this->Quest->primaryKey => $id));
			$this->request->data = $this->Quest->find('first', $options);
		}
		$missions = $this->Quest->Mission->find('list');
		$phases = $this->Quest->Phase->find('list');
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
		$this->Quest->id = $id;
		if (!$this->Quest->exists()) {
			throw new NotFoundException(__('Invalid quest'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Quest->delete()) {
			$this->Session->setFlash(__('The quest has been deleted.'));
		} else {
			$this->Session->setFlash(__('The quest could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
