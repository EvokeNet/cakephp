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
		$forumTopics = $this->ForumPost->ForumTopic->find('list');
		$this->set(compact('users', 'forumTopics'));
	}

/**
 * redirect to post page method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function redirectToPostPage($id = null){
	//TOPIC ID
	$forumTopicId = $this->ForumPost->find('first', 
		array(
			'conditions' => 'id = '.$id)
		)['ForumPost']['forum_topic_id'];

	//GET POST NUMBER IN TOPIC
	$countPosts = $this->ForumPost->find('count',
			array(
				'conditions' => array(
					'forum_topic_id = '.$forumTopicId,
					'id <='.$id
					),
				)
			);

	//CALCULATE PAGE NUMBER
	$pageNumber = ceil($countPosts/20);

	//REDIRECT TO CORRECT PAGE
	return $this->redirect(
		array(
			'controller' => 'ForumTopics',
			'action' => 'view',
			$forumTopicId,
			'page' => $pageNumber,
			'#' => $id
		)
	);
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

		//OPTIONS FOR POST
		$options = array(
			'fields' => array(
				'ForumPost.id',
				'ForumPost.title',
				'ForumPost.content',
				'ForumPost.slug',
				'ForumTopic.id',
				'ForumTopic.title',
				'User.id'
			),
			'joins' => array(
				array(
					'table' => 'forum_topics',
					'alias' => 'ForumTopic',
					'type' => 'INNER',
					'conditions' => array(
						'ForumPost.forum_topic_id = ForumTopic.id'
					),
				),
				array(
					'table' => 'users',
					'alias' => 'User',
					'type' => 'INNER',
					'conditions' => array(
						'ForumPost.user_id = User.id'
					),
				),
			),
			'conditions' => array('ForumPost.' . $this->ForumPost->primaryKey => $id)
		);
			
		$forumPost = $this->ForumPost->find('first', $options);

		//CHECK PERMISSION
		if (!$this->Permission->hasPrivilege($id,'ForumPost')){
			$this->redirectToPostPage($id);
		}

		if ($this->request->is(array('post', 'put'))) {
			if ($this->ForumPost->save($this->request->data)) {
				$this->Session->setFlash(__('The forum post has been saved.'));
				return $this->redirectToPostPage($id);
			} else {
				$this->Session->setFlash(__('The forum post could not be saved. Please, try again.'));
			}
		}else{
			//SET FORUM POST
			$this->request->data = $forumPost;
			$this->set('forumPost', $forumPost);
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

		$this->ForumPost->id = $id;
		if (!$this->ForumPost->exists()) {
			throw new NotFoundException(__('Invalid forum post'));
		}

		$forumPost = $this->ForumPost->find('first',array('conditions' => array('ForumPost.id ='.$id)));

		//CHECK PERMISSION
		if (!$this->Permission->hasPrivilege($id,'ForumPost')){
			$this->redirectToPostPage($id);
		}

		$options = array(
			'fields' => array(
				'ForumPost.id'
			),
			'conditions' => array(
				'ForumPost.forum_topic_id ='.$forumPost['ForumPost']['forum_topic_id'],
				'ForumPost.id < '.$id
			),
			'order' => array(
				'id' => 'DESC'
			)
		);

		$lastForumPost = $this->ForumPost->find('first', $options);

		$this->request->allowMethod('post', 'delete');
		if ($this->ForumPost->delete()) {
			$this->Session->setFlash(__('The forum post has been deleted.'));

			if(isset($lastForumPost['ForumPost']['id'])){
				return $this->redirectToPostPage($lastForumPost['ForumPost']['id']);	
			}else{
				return $this->redirect(
					array(
						'controller' => 'ForumTopics',
						'action' => 'view',
						$forumPost['ForumPost']['forum_topic_id']
					)
				);
			}

		} else {
			$this->Session->setFlash(__('The forum post could not be deleted. Please, try again.'));
		}
	
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->ForumPost->recursive = 0;
		$this->set('forumPosts', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ForumPost->exists($id)) {
			throw new NotFoundException(__('Invalid forum post'));
		}
		$options = array('conditions' => array('ForumPost.' . $this->ForumPost->primaryKey => $id));
		$this->set('forumPost', $this->ForumPost->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
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
		$forumTopics = $this->ForumPost->ForumTopic->find('list');
		$this->set(compact('users', 'forumTopics'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
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
		$forumTopics = $this->ForumPost->ForumTopic->find('list');
		$this->set(compact('users', 'forumTopics'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
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

