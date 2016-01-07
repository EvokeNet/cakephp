<?php
App::uses('AppController', 'Controller');
/**
 * ForumPosts Controller
 *
 * @property ForumPost $ForumPost
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ForumPostsController extends AppController {

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
		$this->ForumPost->recursive = 0;
		$this->set('forumPosts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ForumPost->exists($id)) {
			throw new NotFoundException(__('Invalid forum post'));
		}
		$options = array('conditions' => array('ForumPost.' . $this->ForumPost->primaryKey => $id));
		$this->set('forumPost', $this->ForumPost->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ForumPost->create();
			if ($this->ForumPost->save($this->request->data)) {
				$this->Session->setFlash(__('The forum post has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forum post could not be saved. Please, try again.'));
			}
		}
		$users = $this->ForumPost->User->find('list');
		$forums = $this->ForumPost->Forum->find('list');
		$forumTopics = $this->ForumPost->ForumTopic->find('list');
		$this->set(compact('users', 'forums', 'forumTopics'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ForumPost->exists($id)) {
			throw new NotFoundException(__('Invalid forum post'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ForumPost->save($this->request->data)) {
				$this->Session->setFlash(__('The forum post has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forum post could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ForumPost.' . $this->ForumPost->primaryKey => $id));
			$this->request->data = $this->ForumPost->find('first', $options);
		}
		$users = $this->ForumPost->User->find('list');
		$forums = $this->ForumPost->Forum->find('list');
		$forumTopics = $this->ForumPost->ForumTopic->find('list');
		$this->set(compact('users', 'forums', 'forumTopics'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ForumPost->id = $id;
		if (!$this->ForumPost->exists()) {
			throw new NotFoundException(__('Invalid forum post'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ForumPost->delete()) {
			$this->Session->setFlash(__('The forum post has been deleted.'));
		} else {
			$this->Session->setFlash(__('The forum post could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
