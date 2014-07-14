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

		$user = $this->Notification->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$users = $this->Notification->User->find('all');

		$notifications = $this->Notification->find('all', array('conditions' => array(
			'Notification.user_id' => $user['User']['id'],
			'Notification.origin' => array('like', 'commentEvidence', 'commentEvokation', 'voteEvokation', 'gritBadge'),
			), 
			'limit' => 5,
			'order' => array(
				'Notification.created DESC'
			),
		));

		$this->loadModel('Badge');
		$this->loadModel('Attachment');

		$badges = $this->Badge->find('all');

		foreach ($notifications as $key => $value):
		 	foreach($users as $u):
				if($u['User']['id'] == $value['Notification']['action_user_id']){
					$notifications[$key]['user_name'] = $u['User']['name'];
					$notifications[$key]['user_pa'] = $u['User']['photo_attachment'];
					$notifications[$key]['user_fb'] = $u['User']['facebook_id'];
					$notifications[$key]['user_pd'] = $u['User']['photo_dir'];
					break;
				}
			endforeach;

			if($value['Notification']['origin'] == 'gritBadge'){
				foreach($badges as $badge):
					if($badge['Badge']['id'] == $value['Notification']['origin_id']){
						$notifications[$key]['badge_name'] = $badge['Badge']['name'];

						$badge_img = $this->Attachment->find('first', array(
							'conditions' => array(
								'Attachment.model' => 'Badge',
								'Attachment.foreign_key' => $badge['Badge']['id']
							)
						));

						if(!empty($badge_img)) {
							$notifications[$key]['imd'] = $badge_img['Attachment']['dir']; 
							$notifications[$key]['ima'] = $badge_img['Attachment']['attachment'];
						}
						// $notifications[$key]['badge_imd'] = $badge['Badge']['img_dir'];
						// $notifications[$key]['badge_ima'] = $badge['Badge']['img_attachment'];
						break;
					}
				endforeach;
			}
	 	endforeach;

		// $this->Notification->recursive = 0;
		// $this->set('notifications', $this->Paginator->paginate());

		$this->set(compact('notifications', 'user'));
	}

/**
*
 * moreNotifications method
 *
 * @return void
 *
 */
	public function moreNotifications($lastOne, $limit = 1, $user_id = -1){
		$this->autoRender = false; // We don't render a view in this example
    	$this->request->onlyAllow('ajax'); // No direct access via browser URL

   		$last = $this->Notification->find('first', array(
   			'order' => array(
				'Notification.created DESC'
			),
    		'conditions' => array(
    			'Notification.id' => $lastOne
    		)
    	));	

    	$lang = $this->getCurrentLanguage();

    	$users = $this->Notification->User->find('all');

    	$this->loadModel('Badge');
    	$this->loadModel('Attachment');
		$badges = $this->Badge->find('all');

    	if(empty($last))
    			return json_encode(array());

	   	$obj = $this->Notification->find('all', array(
			'order' => array(
				'Notification.created DESC'
			),
			'conditions' => array(
				'Notification.created <' => $last['Notification']['created'],
				'Notification.user_id' => $this->getUserId(),
				'Notification.origin' => array('like', 'commentEvidence', 'commentEvokation', 'voteEvokation', 'gritBadge'),
			),
			'limit' => $limit
		));

		$el = 'notification_box';
		$ind = 'Notification';
    	

    	$data = "";

	    $str = "lastBegin-1lastEnd";
	    $older = "";

	    $date = '';

    	foreach ($obj as $key => $value) {
    		
    		foreach($users as $u):
				if(($u['User']['id'] == $value['Notification']['action_user_id']) && ($value['Notification']['origin'] != 'gritBadge')){
					$value['user_name'] = $u['User']['name'];
					$value['user_pa'] = $u['User']['photo_attachment'];
					$value['user_fb'] = $u['User']['facebook_id'];
					$value['user_pd'] = $u['User']['photo_dir'];
					break;
				}
			endforeach;

			if($value['Notification']['origin'] == 'gritBadge'){
				foreach($badges as $badge):
					if($badge['Badge']['id'] == $value['Notification']['origin_id']){
						$value['badge_name'] = $badge['Badge']['name'];

						$badge_img = $this->Attachment->find('first', array(
							'conditions' => array(
								'Attachment.model' => 'Badge',
								'Attachment.foreign_key' => $badge['Badge']['id']
							)
						));

						if(!empty($badge_img)) {
							$obj[$key]['imd'] = $badge_img['Attachment']['dir']; 
							$obj[$key]['ima'] = $badge_img['Attachment']['attachment'];
						}
						// $notifications[$key]['badge_imd'] = $badge['Badge']['img_dir'];
						// $notifications[$key]['badge_ima'] = $badge['Badge']['img_attachment'];
						break;
					}
				endforeach;
			}

			if($date != date('j-n-Y', strtotime($value['Notification']['created']))){
				$date = date('j-n-Y', strtotime($value['Notification']['created']));
				//echo $date;
			}

    		$view = new View($this, false);
			$content = ($view->element($el, array('n' => $value)));
			
			$data .= $content .' ';

    		$older = $value[$ind]['id'];
    	}
    	if($older != "") {
    		$str = "lastBegin".$older."lastEnd";
    	}
    	return $str.$data;
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

		//$this->redirect(array('controller'=>'users','action'=>'dashboard'));
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
 * flushToRedis method
 *
 * After a notification was triggered
 * 
 * @return void
 */
	public function flushToRedis($user_id = null, $notification_id = null) {

		$redis = new Redis() or die("Cannot load Redis module.");
		$redis->connect('127.0.0.1');

		$redis->lpush($user_id.'_new_notifications', $notification_id);
		$redis->lpush($user_id.'_notifications_history', $notification_id);

		// var_dump($user_id.'_new_notifications');
		// var_dump($redis->llen($user_id.'_new_notifications'));
		// var_dump($redis->llen($user_id.'_new_notifications'));
		// var_dump($redis->lrange($user_id.'_new_notifications', 0, 200));

		// $redis->publish('notif', 'User: ' . $user_id);
		// $redis->publish('notif', 'Name: ' . ($user_id.'_new_notifications'));
		// $redis->publish('notif', 'Notes: ' . $notification_id);
		$redis->publish('notif', $redis->llen($user_id.'_new_notifications'));
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
