<?php
App::uses('AppController', 'Controller');
/**
 * Badges Controller
 *
 * @property Badge $Badge
 * @property PaginatorComponent $Paginator
 */
class BadgesController extends AppController {

/**
 * Components
 *
 * @var array
 */

	public $components = array('Paginator', 'Session', 'Access');
	public $uses = array('Badge', 'UserOrganization', 'Organization');
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
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$badges = $this->Badge->find('all');

		//List of badges of the current user (just the badge IDs)
		$myBadges = $this->Badge->UserBadge->find('list', array(
			'fields' => array('badge_id'),
			'conditions' => array(
				'UserBadge.user_id' => $this->getUserId()
			)
		));

		foreach ($badges as $b => $badge) {
			//IMAGE
			$this->loadModel('Attachment');
			$badge_img = $this->Attachment->find('first', array(
				'conditions' => array(
					'Attachment.model' => 'Badge',
					'Attachment.foreign_key' => $badge['Badge']['id']
				)
			));
			if(!empty($badge_img)) {
				$badges[$b]['Badge']['img_dir'] = $badge_img['Attachment']['dir'];
				$badges[$b]['Badge']['img_attachment'] = $badge_img['Attachment']['attachment'];
			}

			//OWNS: if the user owns the badge
			if(in_array($badge['Badge']['id'], $myBadges)) {
				$badges[$b]['Badge']['owns'] = true;
			}
			else {
				$badges[$b]['Badge']['owns'] = false;
			}

			//PROGRESS
			$badges[$b]['Badge']['UserPercentage'] = rand(0,100); // ($badgeCurrent / $badgeGoal) * 100;
		}

		$this->loadModel('User');
		$user = $this->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$this->set(compact('user', 'badges'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Badge->create();
			if ($this->Badge->save($this->request->data)) {
				$this->Session->setFlash(__('The badge has been saved.'));
				return $this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The badge could not be saved. Please, try again.'));
			}
		}
	}

/*
* add_badge method
* adds a badge via admin panel and returns to it
*/
	public function panel_add() {

		if ($this->request->is('post')) {
			$this->Badge->create();
			if ($this->Badge->createWithAttachments($this->request->data)) {

				$badge_id = $this->Badge->id;

				$this->Session->setFlash(__('The badge has been saved.'));
				return $this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The badge could not be saved. Please, try again.'));
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
		if (!$this->Badge->exists($id)) {
			throw new NotFoundException(__('Invalid badge'));
		}

		$this->Badge->id = $id;
		if ($this->request->is(array('post', 'put'))) {

			if ($this->Badge->save($this->request->data)) {
				$this->Session->setFlash(__('The badge has been saved.'));
				return $this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The badge could not be saved. Please, try again.'));
			}
		} else {

			$options = array('conditions' => array('Badge.' . $this->Badge->primaryKey => $id));
			$this->request->data = $this->Badge->find('first', $options);
			$me = $this->Badge->find('first', $options);

			$this->set(compact('me'));

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
		$this->autoRender = false;

		$this->Badge->id = $id;
		if (!$this->Badge->exists()) {
			throw new NotFoundException(__('Invalid badge'));
		}
		if ($this->Badge->delete()) {
			$this->Session->setFlash(__('The badge has been deleted.'));
		} else {
			$this->Session->setFlash(__('The badge could not be deleted. Please, try again.'));
		}
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Badge->recursive = 0;
		$this->set('badges', $this->Paginator->paginate());

		$this->loadModel('Organization');
	    $organizations =
	      $this->Organization->find('all', array(
	      'order' => array(
	        'Organization.name ASC'
	      ),
	    ));

	   $this->set('organizations',$organizations);
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Badge->exists($id)) {
			throw new NotFoundException(__('Invalid badge'));
		}

		$options = array(
			'fields' => array(
				'Badge.*',
				'Organization.name',
				'Organization.id'
			),
			'joins' => array(
				array(
					'table' => 'organizations',
					'alias' => 'Organization',
					'type' => 'INNER',
					'conditions' => array(
						'Badge.organization_id = Organization.id'
					)
				)
			),
			'conditions' => array(
				'Badge.' . $this->Badge->primaryKey => $id
			)
		);
		$this->set('badge', $this->Badge->find('first', $options));

		$this->loadModel('Organization');
	    $organizations =
	      $this->Organization->find('all', array(
	      'order' => array(
	        'Organization.name ASC'
	      ),
	    ));

	   $this->set('organizations',$organizations);
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->autoRender = false;
		if ($this->request->is('post')) {
			$this->Badge->create();
			if ($this->Badge->save($this->request->data)) {
				$this->Session->setFlash(__('The badge has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The badge could not be saved. Please, try again.'));
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
		$this->autoRender = false;
		if (!$this->Badge->exists($id)) {
			throw new NotFoundException(__('Invalid badge'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Badge->save($this->request->data)) {
				$this->Session->setFlash(__('The badge has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The badge could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Badge.' . $this->Badge->primaryKey => $id));
			$this->request->data = $this->Badge->find('first', $options);
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
		$this->autoRender = false;
		$this->Badge->id = $id;
		if (!$this->Badge->exists()) {
			throw new NotFoundException(__('Invalid badge'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Badge->delete()) {
			$this->Session->setFlash(__('The badge has been deleted.'));
		} else {
			$this->Session->setFlash(__('The badge could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
