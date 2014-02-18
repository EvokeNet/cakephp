<?php
App::uses('AppController', 'Controller');
/**
 * Evidences Controller
 *
 * @property Evidence $Evidence
 * @property PaginatorComponent $Paginator
 */
class EvidencesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Evidence->recursive = 0;
		$this->set('evidences', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Evidence->exists($id)) {
			throw new NotFoundException(__('Invalid evidence'));
		}
		
		$options = array('conditions' => array('Evidence.' . $this->Evidence->primaryKey => $id));
		$this->set('evidence', $this->Evidence->find('first', $options));

		$opt = array('conditions' => array('Comment.evidence_id' => $id));
		$this->set("comment", $this->Evidence->Comment->find('all', $opt));

		// $option = array('joins' => array(
		// 		array(
		// 		    'table' => 'comments',
		// 		    'alias' => 'Comment',
		// 		    'type' => 'inner',
		// 		    'foreignKey' => true,
		// 		    'conditions'=> array('Comment.evidence_id' => $id),
		// 		),
		// 		array(
		// 		    'table' => 'users',
		// 		    'alias' => 'CommentUser',
		// 		    'type' => 'inner',
		// 		    'foreignKey' => true,
		// 		    'conditions'=> array('Comment.user_id = CommentUser.id'),
		// 		),           
		//      )  
		// );

		// // debug($this->Evidence->Comment->User->find('all', $option));
		// // die();
		// $this->set('usernames', $this->Evidence->Comment->User->find('all', $option));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Evidence->create();
			if ($this->Evidence->save($this->request->data)) {
				$this->Session->setFlash(__('The evidence has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evidence could not be saved. Please, try again.'));
			}
		}
		$users = $this->Evidence->User->find('list');
		$quests = $this->Evidence->Quest->find('list');
		$missions = $this->Evidence->Mission->find('list');
		$this->set(compact('users', 'quests', 'missions'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Evidence->exists($id)) {
			throw new NotFoundException(__('Invalid evidence'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Evidence->save($this->request->data)) {
				$this->Session->setFlash(__('The evidence has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evidence could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Evidence.' . $this->Evidence->primaryKey => $id));
			$this->request->data = $this->Evidence->find('first', $options);
		}
		$users = $this->Evidence->User->find('list');
		$quests = $this->Evidence->Quest->find('list');
		$missions = $this->Evidence->Mission->find('list');
		$this->set(compact('users', 'quests', 'missions'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Evidence->id = $id;
		if (!$this->Evidence->exists()) {
			throw new NotFoundException(__('Invalid evidence'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Evidence->delete()) {
			$this->Session->setFlash(__('The evidence has been deleted.'));
		} else {
			$this->Session->setFlash(__('The evidence could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Evidence->recursive = 0;
		$this->set('evidences', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Evidence->exists($id)) {
			throw new NotFoundException(__('Invalid evidence'));
		}
		$options = array('conditions' => array('Evidence.' . $this->Evidence->primaryKey => $id));
		$this->set('evidence', $this->Evidence->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Evidence->create();
			if ($this->Evidence->save($this->request->data)) {
				$this->Session->setFlash(__('The evidence has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evidence could not be saved. Please, try again.'));
			}
		}
		$users = $this->Evidence->User->find('list');
		$quests = $this->Evidence->Quest->find('list');
		$missions = $this->Evidence->Mission->find('list');
		$this->set(compact('users', 'quests', 'missions'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Evidence->exists($id)) {
			throw new NotFoundException(__('Invalid evidence'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Evidence->save($this->request->data)) {
				$this->Session->setFlash(__('The evidence has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evidence could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Evidence.' . $this->Evidence->primaryKey => $id));
			$this->request->data = $this->Evidence->find('first', $options);
		}
		$users = $this->Evidence->User->find('list');
		$quests = $this->Evidence->Quest->find('list');
		$missions = $this->Evidence->Mission->find('list');
		$this->set(compact('users', 'quests', 'missions'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Evidence->id = $id;
		if (!$this->Evidence->exists()) {
			throw new NotFoundException(__('Invalid evidence'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Evidence->delete()) {
			$this->Session->setFlash(__('The evidence has been deleted.'));
		} else {
			$this->Session->setFlash(__('The evidence could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
