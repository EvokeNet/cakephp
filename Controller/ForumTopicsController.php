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
		$updateForumTopic = $this->ForumTopic->find('first',$options);

		//FORUM TOPIC
		$this->loadModel('ForumTopic');
		$options = array(
			'fields' => array(
				'id',
				'title',
				'content',
				'forum_categorie_id',
				'User.id',
				'User.name',
				'created'
			),
			'joins' => array(
				array(
					'table' => 'users',
					'alias' => 'User',
					'type' => 'INNER',
					'conditions' => array(
						'ForumTopic.user_id = User.id'
					),
				),
			),
			'conditions' => array(
				'ForumTopic.id ='.$id
			)
		);

		$forumTopic = $this->ForumTopic->find('first',$options);

		//CHECK OWNER
		if (!$this->Permission->hasPrivilege($id,'ForumTopic')){
			//COUNT VIEW
			$updateForumTopic['ForumTopic']['view_count'] = $updateForumTopic['ForumTopic']['view_count']+1;
			$this->ForumTopic->save($updateForumTopic);
		}

		//FORUM POSTS
		$this->loadModel('ForumPost');
		$alias = $this->ForumPost->alias;

		//CUSTOM PAGINATOR FOR FORUM POSTS

		$this->paginate = array(
			'ForumPost' => array(
				'fields' => array(
					'ForumPost.id',
					'ForumPost.title',
					'ForumPost.content',
					'User.id',
					'User.name',
					'ForumPost.created'
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
				'conditions' => array(
					'ForumTopic.id ='.$id
				),
				'order' => array(
					'created' => 'asc'
				)
			)
		);

		$forumPosts = $this->paginate($alias);

		// SET VARIABLES
		$this->set('forumPosts', $forumPosts);
		$this->set('forumTopic', $forumTopic);

	}


/**
 * new post method
 *
 * @return void
 */	
	public function post($id = null) {

		if (!$this->ForumTopic->exists($id)) {
				throw new NotFoundException(__('Invalid forum topic'));
			}

		$options = array('conditions' => array('ForumTopic.' . $this->ForumTopic->primaryKey => $id));
		$this->set('forumTopic', $this->ForumTopic->find('first', $options));

		if ($this->request->is('post')) {

			$this->loadModel('ForumPost');
			$this->ForumPost->create();

			if ($this->ForumPost->save($this->request->data)) {
				$this->Session->setFlash(__('The forum post has been saved.'));
				$insertedId = $this->ForumPost->getLastInsertId();
				$forumTopicId = $this->ForumPost->find('first',array('conditions' => 'id = '.$insertedId))['ForumPost']['forum_topic_id'];
				$pageNumber = ceil($this->ForumPost->find('count',array('conditions' => 'forum_topic_id = '.$forumTopicId))/20);
				return $this->redirect(array('action' => 'view/'.$id.'/page:'.$pageNumber.'#'.$insertedId));
			} else {
				$this->Session->setFlash(__('The forum post could not be saved. Please, try again.'));
			}

		}

	}


/**
 * new topic method
 *
 * @return void
 */	
	public function new_topic($id = null) {

		$this->loadModel('ForumCategory');
		$this->loadModel('ForumTopic');

		if (!$this->ForumCategory->exists($id)) {
				throw new NotFoundException(__('Invalid forum category'));
			}

		$options = array('conditions' => array('ForumCategory.' . $this->ForumCategory->primaryKey => $id));
		$this->set('forumCategory', $this->ForumCategory->find('first', $options));

		if ($this->request->is('post')) {
			$this->ForumTopic->create();

			if ($this->ForumTopic->save($this->request->data)) {
				$this->Session->setFlash(__('The forum topic has been saved.'));

				return $this->redirect(array('action' => '../forum_categories/view/'.$id));
			} else {
				$this->Session->setFlash(__('The forum topic could not be saved. Please, try again.'));
			}

		}

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
		$forumCategories = $this->ForumTopic->ForumCategorie->find('list');
		$this->set(compact('users', 'forumCategories'));
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

		//OPTIONS FOR TOPIC
		$options = array(
			'fields' => array(
				'ForumTopic.id',
				'ForumTopic.title',
				'ForumTopic.content',
				'ForumTopic.status',
				'ForumTopic.view_count',
				'ForumTopic.slug',
				'ForumCategory.id',
				'ForumCategory.title',
				'User.id'
			),
			'joins' => array(
				array(
					'table' => 'forum_categories',
					'alias' => 'ForumCategory',
					'type' => 'INNER',
					'conditions' => array(
						'ForumTopic.forum_categorie_id = ForumCategory.id'
					),
				),
				array(
					'table' => 'users',
					'alias' => 'User',
					'type' => 'INNER',
					'conditions' => array(
						'ForumTopic.user_id = User.id'
					),
				),
			),
			'conditions' => array('ForumTopic.' . $this->ForumTopic->primaryKey => $id)
		);
			
		$forumTopic = $this->ForumTopic->find('first', $options);


		//CHECK PRIVILEGE
		if (!$this->Permission->hasPrivilege($id,'ForumTopic')){
			return $this->redirect( 
				array(
					'controller' => 'ForumTopics',
					'action' => 'view',
					$forumTopic['ForumTopic']['id'],
				)
			);
		}

		if ($this->request->is(array('post', 'put'))) {
			if ($this->ForumTopic->save($this->request->data)) {
				$this->Session->setFlash(__('The forum topic has been saved.'));
				return $this->redirect( 
					array(
						'controller' => 'ForumTopics',
						'action' => 'view',
						$forumTopic['ForumTopic']['id'],
					)
				);

			} else {
				$this->Session->setFlash(__('The forum topic could not be saved. Please, try again.'));
			}
		} else {
			//SET FORUM TOPIC
			$this->request->data = $forumTopic;
			$this->set('forumTopic', $forumTopic);
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
		$this->ForumTopic->id = $id;

		if (!$this->ForumTopic->exists()) {
			throw new NotFoundException(__('Invalid forum topic'));
		}

		$forumTopic = $this->ForumTopic->find('first',array('conditions' => array('ForumTopic.id ='.$id)));

		//CHECK PERMISSION
		if (!$this->Permission->hasPrivilege($id,'ForumTopic')){
			return $this->redirect( 
				array(
					'controller' => 'ForumTopics',
					'action' => 'view',
					$forumTopic['ForumTopic']['id'],
				)
			);
		}

		$this->request->allowMethod('post', 'delete');
		if ($this->ForumTopic->delete()) {


			$options = array(
				'fields' => array(
					'ForumPost.id'
				),
				'conditions' => array(
					'ForumPost.forum_topic_id ='.$forumTopic['ForumTopic']['id']
				),
				'order' => array(
					'id' => 'DESC'
				)
			);

			$this->loadModel('ForumPost');

			$forumPosts = $this->ForumPost->find('all', $options);

			foreach($forumPosts as $forumPost){
				$this->ForumPost->id = $forumPost['ForumPost']['id'];
				$this->ForumPost->delete();
			}

			$this->Session->setFlash(__('The forum topic has been deleted.'));
			return $this->redirect( 
				array(
					'controller' => 'ForumCategories',
					'action' => 'view',
					$forumTopic['ForumTopic']['forum_categorie_id'],
				)
			);

		} else {
			$this->Session->setFlash(__('The forum topic could not be deleted. Please, try again.'));
		}
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
		$forumCategories = $this->ForumTopic->ForumCategorie->find('list');
		$this->set(compact('users', 'forumCategories'));
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
		$forumCategories = $this->ForumTopic->ForumCategorie->find('list');
		$this->set(compact('users', 'forumCategories'));
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
