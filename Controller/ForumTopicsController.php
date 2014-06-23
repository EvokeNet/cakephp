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

		//$this->loadModel('User');
		$user = $this->ForumTopic->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$posts = $this->ForumTopic->ForumPost->find('all', array('conditions' => array('ForumPost.forum_topic_id' => $id)));
		$this->set(compact('posts', 'user'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($forum_id = null) {
		if ($this->request->is('post')) {
			$this->ForumTopic->create();
			$this->request->data['ForumTopic']['slug'] = Inflector::slug($this->request->data['ForumTopic']['title']);
			if ($this->ForumTopic->save($this->request->data)) {
				$this->Session->setFlash(__('The forum topic has been saved.'));
				return $this->redirect(array('controller' => 'forums', 'action' => 'view', $forum_id));
			} else {
				$this->Session->setFlash(__('The forum topic could not be saved. Please, try again.'));
			}
		}
		$users = $this->ForumTopic->User->find('list');
		$forums = $this->ForumTopic->Forum->find('list');

		$user = $this->ForumTopic->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$this->set(compact('user', 'forum_id', 'users', 'forums'));
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
		$this->set(compact('users', 'forums'));
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

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->ForumTopic->recursive = 0;
		$this->set('forumTopics', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ForumTopic->exists($id)) {
			throw new NotFoundException(__('Invalid forum topic'));
		}
		$options = array('conditions' => array('ForumTopic.' . $this->ForumTopic->primaryKey => $id));
		$this->set('forumTopic', $this->ForumTopic->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
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
		$this->set(compact('users', 'forums'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
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
		$this->set(compact('users', 'forums'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
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
