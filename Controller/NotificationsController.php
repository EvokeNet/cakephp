<?php
App::uses('AppController', 'Controller');
/**
 * Notifications Controller
 *
 * @property Notification $Notification
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class NotificationsController extends AppController {

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
		$this->Notification->recursive = 0;
		$this->set('notifications', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Notification->exists($id)) {
			throw new NotFoundException(__('Invalid notification'));
		}
		$options = array('conditions' => array('Notification.' . $this->Notification->primaryKey => $id));
		$this->set('notification', $this->Notification->find('first', $options));
	}

	public function displayPhaseMessage($phase_name = null, $next_phase = null, $mission_id = null){
		$this->Session->setFlash('', 'flash_phase_message', array('phase_name' => $phase_name, 'next' => $next_phase, 'mission_id' => $mission_id));
	}

	public function displayBadgeMessage($badge_id){
		$this->loadModel('Badge');
		$badge = $this->Badge->find('first', array(
			'conditions' => array(
				'Badge.id' => $badge_id
			)
		));

		$lang = $this->getCurrentLanguage();
		$flags['_en'] = true;
		$flags['_es'] = false;
		if($lang=='es') {
			$flags['_en'] = false;
			$flags['_es'] = true;
		}

		if($flags['_es']){
			$badge['Badge']['name'] = $badge['Badge']['name_es'];
			$badge['Badge']['description'] = $badge['Badge']['description_es'];
		}

		$this->loadModel('Attachment');
		$attachment = $this->Attachment->find('first', array(
			'conditions' => array(
				'Attachment.model' => 'Badge',
				'Attachment.foreign_key' => $badge_id
			)
		));

		if(!empty($attachment)){
			$this->Session->setFlash('', 'flash_badge_message', array('badge_name' => $badge['Badge']['name'], 
				'badge_desc' => $badge['Badge']['description'], 'imgPath' => $attachment['Attachment']['id'], 
				'imgFile' => $attachment['Attachment']['attachment']));
		} else{
			$this->Session->setFlash('', 'flash_badge_message', array('badge_name' => $badge['Badge']['name'], 
				'badge_desc' => $badge['Badge']['description'], 'imgPath' => null, 
				'imgFile' => null));
		}
		$this->redirect(array('controller'=>'users','action'=>'dashboard'));
	}

	// public function displayPhaseMessage($phase_id = null, $next_phase = null){
	// 	$this->loadModel('Phase');

	// 	$phase = $this->Phase->find('first', array('conditions' => array('Phase.id' => $phase_id)));

	// 	$nextMP = $this->Phase->getNextPhase($phase, $phase['Mission']['id']);

	// 	if($phase)
	// 		$this->Session->setFlash('', 'flash_phase_message', array('phase_name' => $phase['Phase']['name'], 'next' => $nextMP, 'mission_id' => $phase['Mission']['id']));
	// }

	public function displayBasicTrainingMessage($user_id){
		$this->Session->setFlash('', 'flash_basic_training', array('user_id' => $user_id));
	}

	public function displayAdminMessage($user_id, $admin_notification_id){
		$this->loadModel('AdminNotification');
		$notification = $this->AdminNotification->find('first', array(
			'conditions' => array(
				'AdminNotification.id' => $admin_notification_id
			)
		));

		// debug("oi"); die();

		$this->Session->setFlash('', 'flash_admin_notification', array('user_id' => $user_id, 
		 'notificationId' => $notification['AdminNotification']['id'],
		 'notificationTitle' => $notification['AdminNotification']['title'],
		 'notificationDescription' => $notification['AdminNotification']['description']), 'admin'.$notification['AdminNotification']['id']);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Notification->create();
			if ($this->Notification->save($this->request->data)) {
				$this->Session->setFlash(__('The notification has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The notification could not be saved. Please, try again.'));
			}
		}
		$users = $this->Notification->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Notification->exists($id)) {
			throw new NotFoundException(__('Invalid notification'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Notification->save($this->request->data)) {
				$this->Session->setFlash(__('The notification has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The notification could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Notification.' . $this->Notification->primaryKey => $id));
			$this->request->data = $this->Notification->find('first', $options);
		}
		$users = $this->Notification->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Notification->id = $id;
		if (!$this->Notification->exists()) {
			throw new NotFoundException(__('Invalid notification'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Notification->delete()) {
			$this->Session->setFlash(__('The notification has been deleted.'));
		} else {
			$this->Session->setFlash(__('The notification could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Notification->recursive = 0;
		$this->set('notifications', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Notification->exists($id)) {
			throw new NotFoundException(__('Invalid notification'));
		}
		$options = array('conditions' => array('Notification.' . $this->Notification->primaryKey => $id));
		$this->set('notification', $this->Notification->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Notification->create();
			if ($this->Notification->save($this->request->data)) {
				$this->Session->setFlash(__('The notification has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The notification could not be saved. Please, try again.'));
			}
		}
		$users = $this->Notification->User->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Notification->exists($id)) {
			throw new NotFoundException(__('Invalid notification'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Notification->save($this->request->data)) {
				$this->Session->setFlash(__('The notification has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The notification could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Notification.' . $this->Notification->primaryKey => $id));
			$this->request->data = $this->Notification->find('first', $options);
		}
		$users = $this->Notification->User->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Notification->id = $id;
		if (!$this->Notification->exists()) {
			throw new NotFoundException(__('Invalid notification'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Notification->delete()) {
			$this->Session->setFlash(__('The notification has been deleted.'));
		} else {
			$this->Session->setFlash(__('The notification could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
