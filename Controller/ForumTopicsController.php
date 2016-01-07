<?php
App::uses('AppController', 'Controller');
/**
 * ForumTopics Controller
 *
 * @property ForumTopic $ForumTopic
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ForumTopicsController extends AppController {

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
		$this->ForumTopic->recursive = 0;
		$this->set('forumTopics', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ForumTopic->exists($id)) {
			throw new NotFoundException(__('Invalid forum topic'));
		}
		$options = array('conditions' => array('ForumTopic.' . $this->ForumTopic->primaryKey => $id));
		$this->set('forumTopic', $this->ForumTopic->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ForumTopic->create();
			if ($this->ForumTopic->save($this->request->data)) {
				$this->Session->setFlash(__('The forum topic has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forum topic could not be saved. Please, try again.'));
			}
		}
		$users = $this->ForumTopic->User->find('list');
		$forums = $this->ForumTopic->Forum->find('list');
		$firstPosts = $this->ForumTopic->FirstPost->find('list');
		$lastPosts = $this->ForumTopic->LastPost->find('list');
		$lastUsers = $this->ForumTopic->LastUser->find('list');
		$this->set(compact('users', 'forums', 'firstPosts', 'lastPosts', 'lastUsers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ForumTopic->exists($id)) {
			throw new NotFoundException(__('Invalid forum topic'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ForumTopic->save($this->request->data)) {
				$this->Session->setFlash(__('The forum topic has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forum topic could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ForumTopic.' . $this->ForumTopic->primaryKey => $id));
			$this->request->data = $this->ForumTopic->find('first', $options);
		}
		$users = $this->ForumTopic->User->find('list');
		$forums = $this->ForumTopic->Forum->find('list');
		$firstPosts = $this->ForumTopic->FirstPost->find('list');
		$lastPosts = $this->ForumTopic->LastPost->find('list');
		$lastUsers = $this->ForumTopic->LastUser->find('list');
		$this->set(compact('users', 'forums', 'firstPosts', 'lastPosts', 'lastUsers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ForumTopic->id = $id;
		if (!$this->ForumTopic->exists()) {
			throw new NotFoundException(__('Invalid forum topic'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ForumTopic->delete()) {
			$this->Session->setFlash(__('The forum topic has been deleted.'));
		} else {
			$this->Session->setFlash(__('The forum topic could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
