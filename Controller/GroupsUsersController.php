<?php
App::uses('AppController', 'Controller');
APP::uses('GoogleAuthentication', 'Lib/GoogleAuthentication');

/**
 * GroupsUsers Controller
 *
 * @property GroupsUser $GroupsUser
 * @property PaginatorComponent $Paginator
 */
class GroupsUsersController extends AppController {

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
		$this->GroupsUser->recursive = 0;
		$this->set('groupsUsers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($group_id = null) {

		$this->loadModel('Setting');
		$gAuth = new GoogleAuthentication(
			Configure::read('google_client_id'),
			Configure::read('google_client_secret'),
			Configure::read('google_api_key')
		);

		$setting_access_token = $this->Setting->find('first', array(
			'conditions'=> array(
				'Setting.key' => 'google_auth_access_token'
			)
		));

		$setting_refresh_token = $this->Setting->find('first', array(
			'conditions'=> array(
				'Setting.key' => 'google_auth_refresh_token'
			)
		));

		if(empty($setting_refresh_token)) {
			$token = $gAuth->authorize();

			if(!empty($token)) {

				$setting = array();

				$this->Setting->create();
				$setting['Setting']['key'] = 'google_auth_refresh_token';
				$setting['Setting']['value'] = $token;
				$this->Setting->save($setting);

				$this->Setting->create();
				$setting['Setting']['key'] = 'google_auth_access_token';
				$setting['Setting']['value'] = $token;
				$this->Setting->save($setting);

				$this->Session->write('access_token', $token);

			}
		} else {

			$access_token = $setting_access_token['Setting']['value'];
			$refresh_token = $setting_refresh_token['Setting']['value'];

			$token = $gAuth->authorize($access_token, $refresh_token);

			if (!empty($token)) {
				$setting = $this->Setting->find('first', array(
					'conditions' => array(
						'key' => 'google_auth_access_token'
					)
				));
				$this->Setting->id = $setting['Setting']['id'];
				$this->Setting->set('value', $token);
				$this->Setting->save();
			}
			$this->Session->write('access_token', $token);
		}

		$group = $this->GroupsUser->getGroupAndUsers($group_id);
		$this->set('group', $group);

	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->GroupsUser->create();
			if ($this->GroupsUser->save($this->request->data)) {
				$this->Session->setFlash(__('The groups user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The groups user could not be saved. Please, try again.'));
			}
		}
		$users = $this->GroupsUser->User->find('list');
		$groups = $this->GroupsUser->Group->find('list');
		$this->set(compact('users', 'groups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->GroupsUser->exists($id)) {
			throw new NotFoundException(__('Invalid groups user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->GroupsUser->save($this->request->data)) {
				$this->Session->setFlash(__('The groups user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The groups user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('GroupsUser.' . $this->GroupsUser->primaryKey => $id));
			$this->request->data = $this->GroupsUser->find('first', $options);
		}
		$users = $this->GroupsUser->User->find('list');
		$groups = $this->GroupsUser->Group->find('list');
		$this->set(compact('users', 'groups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->GroupsUser->id = $id;
		if (!$this->GroupsUser->exists()) {
			throw new NotFoundException(__('Invalid groups user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->GroupsUser->delete()) {
			$this->Session->setFlash(__('The groups user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The groups user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->GroupsUser->recursive = 0;
		$this->set('groupsUsers', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->GroupsUser->exists($id)) {
			throw new NotFoundException(__('Invalid groups user'));
		}
		$options = array('conditions' => array('GroupsUser.' . $this->GroupsUser->primaryKey => $id));
		$this->set('groupsUser', $this->GroupsUser->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->GroupsUser->create();
			if ($this->GroupsUser->save($this->request->data)) {
				$this->Session->setFlash(__('The groups user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The groups user could not be saved. Please, try again.'));
			}
		}
		$users = $this->GroupsUser->User->find('list');
		$groups = $this->GroupsUser->Group->find('list');
		$this->set(compact('users', 'groups'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->GroupsUser->exists($id)) {
			throw new NotFoundException(__('Invalid groups user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->GroupsUser->save($this->request->data)) {
				$this->Session->setFlash(__('The groups user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The groups user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('GroupsUser.' . $this->GroupsUser->primaryKey => $id));
			$this->request->data = $this->GroupsUser->find('first', $options);
		}
		$users = $this->GroupsUser->User->find('list');
		$groups = $this->GroupsUser->Group->find('list');
		$this->set(compact('users', 'groups'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->GroupsUser->id = $id;
		if (!$this->GroupsUser->exists()) {
			throw new NotFoundException(__('Invalid groups user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->GroupsUser->delete()) {
			$this->Session->setFlash(__('The groups user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The groups user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
