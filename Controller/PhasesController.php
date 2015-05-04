<?php
App::uses('AppController', 'Controller');
/**
 * Phases Controller
 *
 * @property Phase $Phase
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PhasesController extends AppController {

/**
 * Components
 *
 * @var array
 */

	public $components = array('Paginator', 'Session', 'Access');
	public $user = null;

	public function beforeFilter() {
        parent::beforeFilter();
        
        $this->user = array();
        //get user data into public var
		$this->user['role_id'] = $this->getUserRole();
		$this->user['id'] = $this->getUserId();
		$this->user['name'] = $this->getUserName();
		
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
		$this->Phase->recursive = 0;
		$this->set('phases', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Phase->exists($id)) {
			throw new NotFoundException(__('Invalid phase'));
		}
		$options = array('conditions' => array('Phase.' . $this->Phase->primaryKey => $id));
		$this->set('phase', $this->Phase->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Phase->create();
			if ($this->Phase->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The phase has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The phase could not be saved. Please, try again.'));
			}
		}
		$missions = $this->Phase->Mission->find('list');
		$this->set(compact('missions'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		// if (!$this->Phase->exists($id)) {
		// 	throw new NotFoundException(__('Invalid phase'));
		// }

		// $this->Phase->id = $id;

		// if ($this->request->is(array('post', 'put'))) {
		// 	if ($this->Phase->saveAll($this->request->data)) {
		// 		$this->Session->setFlash(__('The user has been saved.'));
		// 		return $this->redirect($this->referer());
		// 	} else {
		// 		$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
		// 	}
		// } else {
		// 	return $this->redirect($this->referer());
		// }
		
		$this->Phase->id = $id;

		if (!$this->Phase->exists()) {
			throw new NotFoundException(__('Invalid phase'));
		}

		//$phase = $this->Phase->find('first', array('conditions' => array('Phase.id' => $id)));

		//$this->Phase->locale = Configure::read('Config.languages');
		
		if ($this->request->is('post', 'put')) {

			if ($this->Phase->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The phase has been saved.'.$id));
				return $this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The phase could not be saved. Please, try again.'));
			}
		} 
		// else {
		// 	$options = array('conditions' => array('Phase.' . $this->Phase->primaryKey => $id));
		// 	$this->request->data = $this->Phase->find('first', $options);
		// }
		// $missions = $this->Phase->Mission->find('list');
		// $this->set(compact('missions'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Phase->id = $id;
		if (!$this->Phase->exists()) {
			throw new NotFoundException(__('Invalid phase'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Phase->delete()) {
			$this->Session->setFlash(__('The phase has been deleted.'));
		} else {
			$this->Session->setFlash(__('The phase could not be deleted. Please, try again.'));
		}
		$this->redirect($this->referer());
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Phase->recursive = 0;
		$this->set('phases', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Phase->exists($id)) {
			throw new NotFoundException(__('Invalid phase'));
		}
		$options = array('conditions' => array('Phase.' . $this->Phase->primaryKey => $id));
		$this->set('phase', $this->Phase->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Phase->create();
			if ($this->Phase->save($this->request->data)) {
				$this->Session->setFlash(__('The phase has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The phase could not be saved. Please, try again.'));
			}
		}
		$missions = $this->Phase->Mission->find('list');
		$this->set(compact('missions'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Phase->exists($id)) {
			throw new NotFoundException(__('Invalid phase'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Phase->save($this->request->data)) {
				$this->Session->setFlash(__('The phase has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The phase could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Phase.' . $this->Phase->primaryKey => $id));
			$this->request->data = $this->Phase->find('first', $options);
		}
		$missions = $this->Phase->Mission->find('list');
		$this->set(compact('missions'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Phase->id = $id;
		if (!$this->Phase->exists()) {
			throw new NotFoundException(__('Invalid phase'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Phase->delete()) {
			$this->Session->setFlash(__('The phase has been deleted.'));
		} else {
			$this->Session->setFlash(__('The phase could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
