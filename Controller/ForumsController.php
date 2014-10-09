<?php
App::uses('AppController', 'Controller');
/**
 * Forums Controller
 *
 * @property Forum $Forum
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ForumsController extends AppController {

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
		$this->Forum->recursive = 0;
		$this->set('forums', $this->Paginator->paginate());

		$this->loadModel('User');
		$user = $this->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));
		$this->set(compact('user'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Forum->exists($id)) {
			throw new NotFoundException(__('Invalid forum'));
		}
		$options = array('conditions' => array('Forum.' . $this->Forum->primaryKey => $id));
		$this->set('forum', $this->Forum->find('first', $options));

		$this->loadModel('User');
		$user = $this->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$topics = $this->Forum->ForumTopic->find('all', array('conditions' => array('ForumTopic.forum_id' => $id)));
		$this->set(compact('user', 'topics'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Forum->create();
			$this->request->data['Forum']['slug'] = Inflector::slug($this->request->data['Forum']['title']);
			if ($this->Forum->save($this->request->data)) {
				$this->Session->setFlash(__('The forum has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forum could not be saved. Please, try again.'));
			}
		}
		$users = $this->Forum->User->find('list');
		$forumTopics = $this->Forum->ForumTopic->find('list');
		$forumPosts = $this->Forum->ForumPost->find('list');

		$user = $this->Forum->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$this->set(compact('user', 'users', 'forumTopics', 'forumPosts'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Forum->exists($id)) {
			throw new NotFoundException(__('Invalid forum'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Forum->save($this->request->data)) {
				$this->Session->setFlash(__('The forum has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forum could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Forum.' . $this->Forum->primaryKey => $id));
			$this->request->data = $this->Forum->find('first', $options);
		}
		$users = $this->Forum->User->find('list');
		$forumTopics = $this->Forum->ForumTopic->find('list');
		$forumPosts = $this->Forum->ForumPost->find('list');
		$this->set(compact('users', 'forumTopics', 'forumPosts'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Forum->id = $id;
		if (!$this->Forum->exists()) {
			throw new NotFoundException(__('Invalid forum'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Forum->delete()) {
			$this->Session->setFlash(__('The forum has been deleted.'));
		} else {
			$this->Session->setFlash(__('The forum could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Forum->recursive = 0;
		$this->set('forums', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Forum->exists($id)) {
			throw new NotFoundException(__('Invalid forum'));
		}
		$options = array('conditions' => array('Forum.' . $this->Forum->primaryKey => $id));
		$this->set('forum', $this->Forum->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Forum->create();
			if ($this->Forum->save($this->request->data)) {
				$this->Session->setFlash(__('The forum has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forum could not be saved. Please, try again.'));
			}
		}
		$users = $this->Forum->User->find('list');
		$forumTopics = $this->Forum->ForumTopic->find('list');
		$forumPosts = $this->Forum->ForumPost->find('list');
		$this->set(compact('users', 'forumTopics', 'forumPosts'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Forum->exists($id)) {
			throw new NotFoundException(__('Invalid forum'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Forum->save($this->request->data)) {
				$this->Session->setFlash(__('The forum has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forum could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Forum.' . $this->Forum->primaryKey => $id));
			$this->request->data = $this->Forum->find('first', $options);
		}
		$users = $this->Forum->User->find('list');
		$forumTopics = $this->Forum->ForumTopic->find('list');
		$forumPosts = $this->Forum->ForumPost->find('list');
		$this->set(compact('users', 'forumTopics', 'forumPosts'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Forum->id = $id;
		if (!$this->Forum->exists()) {
			throw new NotFoundException(__('Invalid forum'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Forum->delete()) {
			$this->Session->setFlash(__('The forum has been deleted.'));
		} else {
			$this->Session->setFlash(__('The forum could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
