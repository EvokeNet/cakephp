<?php
App::uses('AppController', 'Controller');
/**
 * Badges Controller
 *
 * @property Badge $Badge
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class BadgesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Access');
	public $uses = array('Badge', 'UserOrganization', 'Organization');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Badge->recursive = 0;
		$this->set('badges', $this->Paginator->paginate());
	}

	public function beforeFilter() {
        parent::beforeFilter();
        //test to get user data from proper index
		$this->user = $this->getUserData();
		
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
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Badge->exists($id)) {
			throw new NotFoundException(__('Invalid badge'));
		}
		$options = array('conditions' => array('Badge.' . $this->Badge->primaryKey => $id));
		$this->set('badge', $this->Badge->find('first', $options));
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
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The badge could not be saved. Please, try again.'));
			}
		}
		$organizations = $this->Badge->Organization->find('list');
		$this->set(compact('organizations'));
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
		//it's a manager, lets check if he's allowed to edit it
		if($this->user['role_id'] == 2){
			//the possible organizations to be responsable for this badge are his own
			$my_orgs = $this->UserOrganization->find('all', array(
				'conditions' => array(
					array(
						'UserOrganization.user_id' => $this->user['id']
					)
				)
			));

			$my_orgs_id = array();
			$k = 0;
			foreach ($my_orgs as $my_org) {
				$my_orgs_id[$k] = array('Organization.id' => $my_org['Organization']['id']);
				$k++;
			}

			$organizations = $this->Organization->find('list', array(
				'order' => array('Organization.name ASC'),
				'conditions' => array(
					'OR' => $my_orgs_id
				)
			));

			//check if I am allowed to edit this!
			$smth = $this->Badge->find('first', array(
				'conditions' => array(
					'Badge.id' => $id,
					'OR' => $my_orgs_id
				)
			));
			if(empty($smth)) $this->redirect(array('action' => 'index'));

		} else{
			$organizations = $this->Badge->Organization->find('list');
		}

		if ($this->request->is(array('post', 'put'))) {
			if ($this->Badge->save($this->request->data)) {
				$this->Session->setFlash(__('The badge has been saved.'));
				
				//returning to the admin panel
				return $this->redirect(array('controller' => 'panels', 'action' => 'index', 'badges'));
			} else {
				$this->Session->setFlash(__('The badge could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Badge.' . $this->Badge->primaryKey => $id));
			$this->request->data = $this->Badge->find('first', $options);
		}
		$this->set(compact('organizations'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Badge->id = $id;
		if (!$this->Badge->exists()) {
			throw new NotFoundException(__('Invalid badge'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Badge->delete()) {
			$this->Session->setFlash(__('The badge has been deleted.'));
			//returning to the admin panel
			return $this->redirect(array('controller' => 'panels', 'action' => 'index', 'badges'));
		} else {
			$this->Session->setFlash(__('The badge could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
