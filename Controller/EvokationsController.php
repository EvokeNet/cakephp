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
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Evokation->exists($id)) {
			throw new NotFoundException(__('Invalid evokation'));
		}
		
		$options = array('conditions' => array('Evokation.' . $this->Evokation->primaryKey => $id));
		$evokation = $this->Evokation->find('first', $options);
		$this->Evokation->id = $id;
		$comment = $this->Evokation->Comment->find('all', array('conditions' => array('Comment.evokation_id' => $id)));
		$vote = $this->Evokation->Vote->find('first', array('conditions' => array('Vote.evokation_id' => $id, 'Vote.user_id' => $this->getUserId())));
		$votes = $this->Evokation->Vote->find('all', array('conditions' => array('Vote.evokation_id' => $id)));
		
		$group = $this->Evokation->Group->find('first');
		$can_edit = false;
		if($group['Group']['user_id'] == $this->getUserId()) $can_edit = true;

		$groupusers = $this->Evokation->Group->GroupsUser->find('all', array('conditions' => array('GroupsUser.group_id' => $group['Group']['id'])));

		foreach ($groupusers as $member) {
			if($member['User']['id'] == $this->getUserId()) $can_edit = true;
		}

		$follows = $this->Evokation->EvokationFollower->find('first', array('conditions' => array('EvokationFollower.user_id' => $this->getUserId(), 'EvokationFollower.evokation_id' => $id)));

		$this->loadModel("User");
		$user = $this->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$myPoints = $this->User->Point->find('all', array('conditions' => array('Point.user_id' => $this->getUserId())));

		$sumMyPoints = 0;
		
		foreach($myPoints as $point){
			$sumMyPoints += $point['Point']['value'];
		}

		$this->set(compact('evokation', 'group', 'user', 'comment', 'votes', 'vote', 'can_edit', 'follows', 'sumMyPoints'));
	}

/**
 * view draft method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function viewDraft($id = null) {
		if (!$this->Evokation->exists($id)) {
			throw new NotFoundException(__('Invalid evokation'));
		}
		$options = array('conditions' => array('Evokation.' . $this->Evokation->primaryKey => $id));
		$this->set('evokation', $this->Evokation->find('first', $options));
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
