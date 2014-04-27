<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

use EtherpadLite\Client;
use EtherpadLite\Request;


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
		
		$userid = $this->getUserId();
		$username = explode(' ', $this->getUserName());
		$user = $this->GroupsUser->User->find('first', array('conditions' => array('User.id' => $userid)));

		$groups = $this->GroupsUser->Group->find('all');

		$this->set(compact('user', 'userid', 'username', 'groups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($group_id = null) {

		$authorized = false;

		$apikey = Configure::read('etherpad_api_key');
		$client = new Client($apikey, 'http://198.50.155.101:2222');

		$group = $this->GroupsUser->getGroupAndUsers($group_id);
		
		$user = $this->GroupsUser->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$users = $this->GroupsUser->find('all', array(
			'conditions' => array(
				'GroupsUser.group_id' => $group_id
			)
		));

		$this->loadModel('Evokation');
		$evokation = $this->Evokation->find('first', array(
			'conditions' => array(
				'Evokation.group_id' => $group_id
			)
		));


		if (!empty($evokation)) {
			$this->request->data = $evokation;
			
			//the group submitted tthe final version, dont allow them to edit no more
			if($evokation['Evokation']['final_sent'] == 1) {
				$this->Session->setFlash(__('Your group has already submitted this Evokation. You are not allowed to edit it until admin approval.'), 'flash_message');
				$this->redirect($this->referer());
			}
		}



		$this->loadModel('Group');
		$thisgroup = $this->Group->find('first', array(
			'conditions' => array(
				'Group.id' => $group_id
			)
		));

		$loggedInUser = $this->Auth->user();
		


		$usersid = array(); //used to set the OR condition used down there

		foreach ($users as $user) {
			array_push($usersid, array('Evidence.user_id' => $user['User']['id']));
			if ($user['User']['id'] == $loggedInUser['User']['id']) {
				$authorized = true;
				//break;
			}
		}

		if(!empty($thisgroup))
			if($thisgroup['Group']['user_id'] == $this->getUserId()) {
				$authorized = true;
				$this->loadModel('User');
				$user = $this->User->find('first', array(
					'conditions' => array(
						'User.id' => $this->getUserId()
					)
				));
				array_push($usersid, array('Evidence.user_id' => $user['User']['id']));
			}
		
			$response = $client->checkToken();
			if ($response->getCode() == 0) {
				
				// First we create an Etherpad Group, mapping the Evoke Group ID
				$mappedGroup = $client->createGroupIfNotExistsFor($group['Group']['id']);
				if ($mappedGroup->getCode() == 0) {
					
					$groupID = $mappedGroup->getData();
					$groupID = $groupID['groupID'];

				} else {
					throw new InternalErrorException(__('Could not create Etherpad Group'));
				}

				// Second we create an Etherpad Author, mapping both the Evoke User ID and User name
				$mappedAuthor = $client->createAuthorIfNotExistsFor($user['User']['id'], $user['User']['name']);
				if ($mappedAuthor->getCode() == 0) {
					
					$authorID = $mappedAuthor->getData();
					$authorID = $authorID['authorID'];

				} else {
					throw new InternalErrorException(__('Could not create Etherpad Group Author'));
				}

				// Third we create a Session, but we need to ensure it does not exist in the Database yet
				$this->loadModel('Setting');
				$session = $this->Setting->find('first', array(
					'conditions' => array(
						'key' => 'evokation.'.$evokation['Evokation']['id']
					)
				));

				if (empty($dbSession)) {

					// There is no previous Session for this User, so let's create it
					$sessionID = $client->createSession($groupID, $authorID, strtotime('+1 day'));
					$sessionID = $sessionID->getData();
					$sessionID = $sessionID['sessionID'];

					// Store the Session in the Database
					$setting = array();
					$setting['Setting']['key'] = 'evokation.'.$evokation['Evokation']['id'];
					$setting['Setting']['value'] = $sessionID;
					$this->Setting->save($setting);

					// We then set a COOKIE with the Session ID
					if(isset($_COOKIE['sessionID'])) {
						unset($_COOKIE['sessionID']);
						setcookie('sessionID', $sessionID);
					}

				} else {

					// There is a previous Session for this user, but we must check if it is valid
					$existingSession = $client->getSessionInfo($dbSession['Setting']['value']);
					$existingSession = $existingSession->getData();
					$sessionTime = $existingSession['validUntil'];

					// Checks if Session 'validUntil' UNIX timestamp is 1 second in the past
					if ($sessionTime <= strtotime('-1 second')) {
						
						$client->deleteSession($dbSession['Setting']['value']);
						
						$newSession = $client->createSession($groupID, $authorID, strtotime('+1 day'));
						$newSessionID = $newSession->getData();
						$newSessionID = $newSessionID['sessionID'];

						// We need to update the DB Session setting to the newly created Session
						$this->Setting->read(null, $dbSession['Setting']['id']);
						$this->Setting->set('value', $newSessionID);
						$this->Setting->save();

						// Finally, we set a COOKIE with the Session ID
						if(isset($_COOKIE['sessionID'])) {
							unset($_COOKIE['sessionID']);
							setcookie('sessionID', $newSessionID);
						}

					}
				}

				// Now we have everything we need to create the Pad
				$pad = $client->createGroupPad($groupID, 'evokation');
				if ($pad->getCode() == 0) {
					$padID = $pad->getData();
					$padID = $padID['padID'];
				} else {
					$padID = $groupID . '$evokation';
				}

			}
		// if ($authorized) {
		
		// 	$response = $client->checkToken();
		// 	if ($response->getCode() == 0) {
				
		// 		// First we create an Etherpad Group, mapping the Evoke Group ID
		// 		$mappedGroup = $client->createGroupIfNotExistsFor($group['Group']['id']);
		// 		if ($mappedGroup->getCode() == 0) {
					
		// 			$groupID = $mappedGroup->getData();
		// 			$groupID = $groupID['groupID'];

		// 		} else {
		// 			throw new InternalErrorException(__('Could not create Etherpad Group'));
		// 		}

		// 		// Second we create an Etherpad Author, mapping both the Evoke User ID and User name
		// 		$mappedAuthor = $client->createAuthorIfNotExistsFor($user['User']['id'], $user['User']['name']);
		// 		if ($mappedAuthor->getCode() == 0) {
					
		// 			$authorID = $mappedAuthor->getData();
		// 			$authorID = $authorID['authorID'];

		// 		} else {
		// 			throw new InternalErrorException(__('Could not create Etherpad Group Author'));
		// 		}

		// 		// Third we create a Session, but we need to ensure it does not exist in the Database yet
		// 		$this->loadModel('Setting');
		// 		$session = $this->Setting->find('first', array(
		// 			'conditions' => array(
		// 				'key' => 'evokation.'.$evokation['Evokation']['id']
		// 			)
		// 		));

		// 		if (empty($dbSession)) {

		// 			// There is no previous Session for this User, so let's create it
		// 			$sessionID = $client->createSession($groupID, $authorID, strtotime('+1 day'));
		// 			$sessionID = $sessionID->getData();
		// 			$sessionID = $sessionID['sessionID'];

		// 			// Store the Session in the Database
		// 			$setting = array();
		// 			$setting['Setting']['key'] = 'evokation.'.$evokation['Evokation']['id'];
		// 			$setting['Setting']['value'] = $sessionID;
		// 			$this->Setting->save($setting);

		// 			// We then set a COOKIE with the Session ID
		// 			if(isset($_COOKIE['sessionID'])) {
		// 				unset($_COOKIE['sessionID']);
		// 				setcookie('sessionID', $sessionID);
		// 			}

		// 		} else {

		// 			// There is a previous Session for this user, but we must check if it is valid
		// 			$existingSession = $client->getSessionInfo($dbSession['Setting']['value']);
		// 			$existingSession = $existingSession->getData();
		// 			$sessionTime = $existingSession['validUntil'];

		// 			// Checks if Session 'validUntil' UNIX timestamp is 1 second in the past
		// 			if ($sessionTime <= strtotime('-1 second')) {
						
		// 				$client->deleteSession($dbSession['Setting']['value']);
						
		// 				$newSession = $client->createSession($groupID, $authorID, strtotime('+1 day'));
		// 				$newSessionID = $newSession->getData();
		// 				$newSessionID = $newSessionID['sessionID'];

		// 				// We need to update the DB Session setting to the newly created Session
		// 				$this->Setting->read(null, $dbSession['Setting']['id']);
		// 				$this->Setting->set('value', $newSessionID);
		// 				$this->Setting->save();

		// 				// Finally, we set a COOKIE with the Session ID
		// 				if(isset($_COOKIE['sessionID'])) {
		// 					unset($_COOKIE['sessionID']);
		// 					setcookie('sessionID', $newSessionID);
		// 				}

		// 			}
		// 		}

		// 		// Now we have everything we need to create the Pad
		// 		$pad = $client->createGroupPad($groupID, 'evokation');
		// 		if ($pad->getCode() == 0) {
		// 			$padID = $pad->getData();
		// 			$padID = $padID['padID'];
		// 		} else {
		// 			$padID = $groupID . '$evokation';
		// 		}

		// 	}
		// } else {
		// 	throw new InternalErrorException(__('You are not authorized to edit this Evokation.'));
		// }

		$evokationsEvidences = array();
		if(!empty($usersid)) {
			//get all the evokations-type evidences from the group members..
			$this->loadModel('Evidence');
			$evokationsEvidences = $this->Evidence->find('all', array(
				'conditions' => array(
					'Evidence.evokation' => 1,
					'Evidence.mission_id' => $thisgroup['Group']['mission_id'],
					'OR' => $usersid
				)
			));
		}

		//getting all attachments from those evokationEvidences
		$evokationEvidencesids = array();

		foreach ($evokationsEvidences as $e) {
			array_push($evokationEvidencesids, array('Attachment.foreign_key' => $e['Evidence']['id']));
		}

		$evokationAttachments = array();
		if(!empty($evokationEvidencesids)) {
			$this->loadModel('Attachment');
			$evokationAttachments = $this->Attachment->find('all', array(
				'conditions' => array(
					'Attachment.model' => 'Evidence',
					'OR' => $evokationEvidencesids
				)
			));
		}

		//getting last update info, if any
		$this->loadModel('EvokationsUpdate');
		$lastUpdate = $this->EvokationsUpdate->find('first', array(
			'order' => array(
				'EvokationsUpdate.Created Desc'
			),
			'conditions' => array(
				'EvokationsUpdate.evokation_id' => $evokation['Evokation']['id']
			)
		));

		$this->set(compact('group', 'users', 'user', 'padID', 'evokationAttachments', 'evokation', 'lastUpdate'));

	}

/**
 * storeFileId method
 *
 * AJAX call to store the fileID from Google Drive in the Database and
 * use it in further calls in document updating.
 *
 * @return boolean TRUE if succeeded, FALSE otherwise
 */
	public function storeFileInfo() {
		$this->autoRender = false;

		if ($this->request->is('ajax')) {

			if(isset($this->request->data['id'])) {

				$this->loadModel('Evokation');
				$this->Evokation->read(null, $this->request->data['id']);
				$this->Evokation->set('title', $this->request->data['title']);
				$this->Evokation->set('abstract', $this->request->data['abstract']);
				
				if ($this->Evokation->save()) {
					return true;
				} else {
					return false;
				}

			} else {
				$this->loadModel('Evokation');
				$this->Evokation->create();
				$this->request->data['Evokation']['gdrive_file_id'] = $this->request->data['gdrive_file_id'];
				$this->request->data['Evokation']['title'] = $this->request->data['title'];
				$this->request->data['Evokation']['group_id'] = $this->request->data['group_id'];
				$this->request->data['Evokation']['abstract'] = $this->request->data['abstract'];

				if($this->Evokation->save($this->request->data)) {
					return $this->Evokation->id;
				} else {
					return false;
				}

			}
		}
	}


/**
 * storeFileId method
 *
 * AJAX call to store the fileID from Google Drive in the Database and
 * use it in further calls in document updating.
 *
 * @return boolean TRUE if succeeded, FALSE otherwise
 */
	public function store_image() {
		$this->autoRender = false;

		if ($this->request->is('ajax')) {

			$type = pathinfo($this->request->data['Evokation']['image_uploader']['tmp_name'], PATHINFO_EXTENSION);

			if(!in_array($type, array('jpg', 'jpeg', 'JPG', 'JPEG', 'png', 'PNG', 'gif', 'GIF', 'bmp', 'BMP'))) {

				$dir = 'uploads' . DS . $this->request->data['Evokation']['id'] . DS . $this->Auth->user('User.id');
				if (!file_exists($dir) and !is_dir($dir)) {
					$folder = new Folder();
					if(!$folder->create($dir)) {
						return false;
					}
				} 

				$filename = WWW_ROOT . $dir . DS . $this->request->data['Evokation']['image_uploader']['name'];
				if(move_uploaded_file($this->request->data['Evokation']['image_uploader']['tmp_name'], $filename)) {
					$url = $this->webroot . $dir . DS . $this->request->data['Evokation']['image_uploader']['name'];
					$size = getimagesize($filename);
					return '<img src="' . $url . '" width="100%" data-size="' .$size[0]. '"/>';
				} else {
					return false;
				}

			}
			// $data = file_get_contents($this->request->data['image_uploader']['tmp_name']);
			// $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
		}
	}


/**
 * add method
 *
 * @return void
 */
	public function add($uid = null, $gid = null) {
		
		if($uid)
			$user_id = $uid;
		else
			$user_id = $this->params['url']['arg'];

		if($gid)
			$group_id = $gid;
		else
			$group_id = $this->params['url']['arg2'];

		$insertData = array('user_id' => $user_id, 'group_id' => $group_id);

		$exists = $this->GroupsUser->find('first', array('conditions' => array('GroupsUser.user_id' => $user_id, 'GroupsUser.group_id' => $group_id)));

		if(!$exists){
			$this->GroupsUser->create();
	        if($this->GroupsUser->save($insertData)){
	        	$this->Session->setFlash(__('The groups user has been saved.'));

	        	//Update request status
	        	$request = $this->GroupsUser->Group->GroupRequest->find('first', array('conditions' => array('GroupRequest.user_id' => $user_id, 'GroupRequest.group_id' => $group_id)));
	        	if($request){
	        		$this->GroupsUser->Group->GroupRequest->id = $request['GroupRequest']['id'];
	        		$this->GroupsUser->Group->GroupRequest->save(array('status' => 1));
	        	}

	        	$me = $this->GroupsUser->Group->find('first', array(
	        		'conditions' => array(
	        			'Group.id' => $gid
	        		)
	        	));

	        	//attribute pp to group creator
				$this->loadModel('QuestPowerPoint');
				$pps = $this->QuestPowerPoint->find('all', array(
					'conditions' => array(
						'quest_id' => $me['Group']['quest_id']
					)
				));

				foreach($pps as $pp) {
					$data['UserPowerPoint']['user_id'] = $user_id;
					$data['UserPowerPoint']['power_points_id'] = $pp['QuestPowerPoint']['power_points_id'];
					$data['UserPowerPoint']['quest_id'] = $pp['QuestPowerPoint']['quest_id'];
					$data['UserPowerPoint']['quantity'] = ($pp['QuestPowerPoint']['quantity']*30);
					$data['UserPowerPoint']['model'] = 'Group';
					$data['UserPowerPoint']['foreign_key'] = $me['Group']['id'];

					$this->loadModel('UserPowerPoint');
					$this->UserPowerPoint->create();
					$this->UserPowerPoint->save($data);
				}

				return $this->redirect(array('controller' => 'groups', 'action' => 'view', $group_id));
	        } else $this->Session->setFlash(__('The groups user could not be saved. Please, try again.'));
		} else {
			$this->Session->setFlash(__('This user already belongs to this group.'));
			return $this->redirect(array('controller' => 'groups', 'action' => 'view', $group_id));
		}
	}


/*
* publish method
* publish to community setting a list of updates!
*/
	public function publish($id = null){
		if(!$id)
			$this->redirect($this->referer());

		$this->loadModel('Evokation');
		$evokation = $this->Evokation->find('first', array(
			'conditions' => array(
				'Evokation.id' => $id
			)
		));

		if (empty($evokation)) 
			$this->redirect($this->referer());

		//get etherpad content!
		$apikey = Configure::read('etherpad_api_key');
		$client = new Client($apikey, 'http://198.50.155.101:2222');

		$response = $client->checkToken();
		if ($response->getCode() == 0) {
			
			$mappedGroup = $client->createGroupIfNotExistsFor($evokation['Evokation']['group_id']);
			if ($mappedGroup->getCode() == 0) {
				
				$groupID = $mappedGroup->getData();
				$groupID = $groupID['groupID'];
			} else {
				throw new InternalErrorException(__('Could not create Etherpad Group'));
			}

			// Now we have everything we need to create the Pad
			$pad = $client->createGroupPad($groupID, 'evokation');
			if ($pad->getCode() == 0) {
				$padID = $pad->getData();
				$padID = $padID['padID'];
			} else {
				$padID = $groupID . '$evokation';
			}
		}

		//retrieve content from server
		$padData = json_decode(file_get_contents('http://198.50.155.101:2222/api/1/getHTML?apikey=' . $apikey . '&padID=' . $padID));
		
		//treat it
		$evokationContent = $padData->data->html;
		$evokationContent = str_replace("<!DOCTYPE HTML><html><body>", "", $evokationContent);
		$evokationContent = str_replace("</body></html>", "", $evokationContent);

		$insert['EvokationsUpdate']['evokation_id'] = $id;
		$insert['EvokationsUpdate']['description'] = $this->request->data['Update']['description'];
		$insert['EvokationsUpdate']['content'] = $evokationContent;

		$this->loadModel('EvokationsUpdate');
		$this->EvokationsUpdate->create();
		$this->EvokationsUpdate->save($insert);

		
		$insert = array();
		$insert['Evokation']['id'] = $id;
		$insert['Evokation']['sent'] = 1;

		$this->loadModel('Evokation');
		$this->Evokation->id = $id;
		$this->Evokation->save($insert);

		$this->redirect(array('controller' => 'users', 'action' => 'dashboard'));

	}


	public function publishFinal($id = null){
		if(!$id)
			$this->redirect($this->referer());

		$this->loadModel('Evokation');
		$evokation = $this->Evokation->find('first', array(
			'conditions' => array(
				'Evokation.id' => $id
			)
		));

		if (empty($evokation)) 
			$this->redirect($this->referer());

		//get etherpad content!
		$apikey = Configure::read('etherpad_api_key');
		$client = new Client($apikey, 'http://198.50.155.101:2222');

		$response = $client->checkToken();
		if ($response->getCode() == 0) {
			
			$mappedGroup = $client->createGroupIfNotExistsFor($evokation['Evokation']['group_id']);
			if ($mappedGroup->getCode() == 0) {
				
				$groupID = $mappedGroup->getData();
				$groupID = $groupID['groupID'];
			} else {
				throw new InternalErrorException(__('Could not create Etherpad Group'));
			}

			// Now we have everything we need to create the Pad
			$pad = $client->createGroupPad($groupID, 'evokation');
			if ($pad->getCode() == 0) {
				$padID = $pad->getData();
				$padID = $padID['padID'];
			} else {
				$padID = $groupID . '$evokation';
			}
		}

		//retrieve content from server
		$padData = json_decode(file_get_contents('http://198.50.155.101:2222/api/1/getHTML?apikey=' . $apikey . '&padID=' . $padID));
		
		//treat it
		$evokationContent = $padData->data->html;
		$evokationContent = str_replace("<!DOCTYPE HTML><html><body>", "", $evokationContent);
		$evokationContent = str_replace("</body></html>", "", $evokationContent);

		$insert['EvokationsUpdate']['evokation_id'] = $id;
		$insert['EvokationsUpdate']['description'] = 'Finished Evokation';
		$insert['EvokationsUpdate']['content'] = $evokationContent;

		$this->loadModel('EvokationsUpdate');
		$this->EvokationsUpdate->create();
		$this->EvokationsUpdate->save($insert);

		
		$insert = array();
		$insert['Evokation']['id'] = $id;
		$insert['Evokation']['sent'] = 1;
		$insert['Evokation']['final_sent'] = 1;
		$insert['Evokation']['approved'] = null;

		$this->loadModel('Evokation');
		$this->Evokation->id = $id;
		$this->Evokation->save($insert);

		$this->redirect(array('controller' => 'users', 'action' => 'dashboard'));

	}


/**
 * send method
 *
 * @return void
 */
	public function send($id, $group_id){

		$user = $this->GroupsUser->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));
		
		$sender = $this->GroupsUser->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$recipient = $this->GroupsUser->User->find('first', array('conditions' => array('User.id' => $id)));

		$group = $this->GroupsUser->Group->find('first', array('conditions' => array('Group.id' => $group_id)));

		/* Adds requests */
		$this->loadModel('GroupRequest');
		$insertData = array('user_id' => $this->getUserId(), 'group_id' => $group_id);
		$exists = $this->GroupRequest->find('first', array('conditions' => array('GroupRequest.user_id' => $this->getUserId(), 'GroupRequest.group_id' => $group_id)));

		if(!$exists){
	        if($this->GroupRequest->save($insertData)){
	        	$this->Session->setFlash(__('The request has been sent'));
	        } else $this->Session->setFlash(__('The request could not be sent'));
		} else {
			$this->Session->setFlash(__('This user already requested to join thsi group'));
		}

		if($recipient['User']['email'] != '' && !is_null($recipient['User']['email'])
		 && $sender['User']['email'] != '' && !is_null($sender['User']['email'])) {

			$Email = new CakeEmail('smtp');
			//$Email->from(array('no-reply@quanti.ca' => $sender['User']['name']));
			$Email->to($recipient['User']['email']);
			$Email->subject(__('Evoke - Request to join group'));
			$Email->emailFormat('html');
			$Email->template('group', 'group');
			$Email->viewVars(array('sender' => $sender, 'recipient' => $recipient, 'group' => $group));
			$Email->send();
			$this->Session->setFlash(__('The email was sent'));
		} else {
			$this->Session->setFlash(__('There was a problem sending the email.', 'flash_message'));
		}
		$this->redirect(array('controller' => 'groups', 'action' => 'index', $group['Group']['mission_id']));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit2($id = null) {
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
		$gu = $this->GroupsUser->find('first', array(
			'conditions' => array(
				'GroupsUser.user_id' => $id
			)
		));
		$this->GroupsUser->id = $gu['GroupsUser']['id'];
		if (!$this->GroupsUser->exists()) {
			throw new NotFoundException(__('Invalid groups user'));
		}
		//$this->request->onlyAllow('post', 'delete');

		$group = $this->GroupsUser->Group->find('first', array(
			'conditions' => array(
				'Group.id' => $gu['GroupsUser']['group_id']
			)
		));

		if ($this->GroupsUser->delete()) {

			//attribute pp to evidence owner
			$this->loadModel('QuestPowerPoint');
			$pps = $this->QuestPowerPoint->find('all', array(
				'conditions' => array(
					'quest_id' => $group['Group']['quest_id']
				)
			));

			foreach($pps as $pp) {				
				$this->loadModel('UserPowerPoint');
				$old = $this->UserPowerPoint->find('first', array(
					'conditions' => array(
						'user_id' => $id,
						'power_points_id' => $pp['QuestPowerPoint']['power_points_id'],
						'quest_id' => $pp['QuestPowerPoint']['quest_id'],
						'quantity' => ($pp['QuestPowerPoint']['quantity']*30),
						'model' => 'Group',
						'foreign_key' => $group['Group']['id']
					)
				));

				if(!empty($old)) {
					$this->UserPowerPoint->id = $old['UserPowerPoint']['id'];
					$this->UserPowerPoint->delete();
				}
			}

			$this->Session->setFlash(__('The groups user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The groups user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('controller' => 'groups', 'action' => 'view', $group['Group']['id']));
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