<?php
App::uses('AppController', 'Controller');

use EtherpadLite\Client;
use EtherpadLite\Request;

/**
 * Evokations Controller
 *
 * @property Evokation $Evokation
 * @property PaginatorComponent $Paginator
 */
class EvokationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	
	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('view');
    }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Evokation->recursive = 0;
		$this->set('evokations', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null, $update_id = null) {
		if (!$this->Evokation->exists($id)) {
			throw new NotFoundException(__('Invalid evokation'));
		}

		
		$options = array('conditions' => array('Evokation.' . $this->Evokation->primaryKey => $id));
		$evokation = $this->Evokation->find('first', $options);
		$this->Evokation->id = $id;

		if(!$update_id)
			$current = true;
		else
			$current = false;

		if($current) {
			//evokation update:
			$newUpdate = $this->Evokation->EvokationsUpdate->find('first', array(
				'order' => array(
					'EvokationsUpdate.created Desc'
				),
				'conditions' => array(
					'EvokationsUpdate.evokation_id' => $id
				)
			));

		} else {
			$newUpdate = $this->Evokation->EvokationsUpdate->find('first', array(
				'conditions' => array(
					'EvokationsUpdate.id' => $update_id
				)
			));
		}

		$allUpdates = $this->Evokation->EvokationsUpdate->find('all', array(
			'order' => array(
				'EvokationsUpdate.created Asc'
			),
			'conditions' => array(
				'EvokationsUpdate.evokation_id' => $id
			)
		));

		$updateId = 0;
		if(!empty($newUpdate))
			$updateId = $newUpdate['EvokationsUpdate']['id'];

		$comment = $this->Evokation->Comment->find('all', array(
			'conditions' => array(
				'Comment.evokation_id' => $id,
				'Comment.evokation_update_id' => $updateId
			)
		));
		
		$vote = $this->Evokation->Vote->find('first', array(
			'conditions' => array(
				'Vote.evokation_id' => $id,
				'Vote.user_id' => $this->getUserId(),
				'Vote.evokation_update_id' => $updateId
			)
		));
		$votes = $this->Evokation->Vote->find('all', array(
			'conditions' => array(
				'Vote.evokation_id' => $id,
				'Vote.evokation_update_id' => $updateId
			)
		));


		$group = $this->Evokation->Group->find('first', array(
			'conditions' => array(
				'Group.id' => $evokation['Evokation']['group_id']
			)
		));
		
		$can_edit = false;
		if($group['Group']['user_id'] == $this->getUserId()) $can_edit = true;

		$groupusers = $this->Evokation->Group->GroupsUser->find('all', array('conditions' => array('GroupsUser.group_id' => $group['Group']['id'])));

		foreach ($groupusers as $member) {
			if($member['User']['id'] == $this->getUserId()) $can_edit = true;
		}

		$follows = $this->Evokation->EvokationFollower->find('first', array('conditions' => array('EvokationFollower.user_id' => $this->getUserId(), 'EvokationFollower.evokation_id' => $id)));

		$this->loadModel("User");
		$user = $this->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$myPoints = $this->User->Point->find('all', array('conditions' => array('Point.user_id' => $this->getUserId())));

		$sumMyPoints = 0;
		
		foreach($myPoints as $point){
			$sumMyPoints += $point['Point']['value'];
		}


		//get etherpad content!
		$apikey = Configure::read('etherpad_api_key');
		$client = new Client($apikey, 'http://198.50.155.101:2222');

		$response = $client->checkToken();
		if ($response->getCode() == 0) {
			
			$mappedGroup = $client->createGroupIfNotExistsFor($group['Group']['id']);
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

		$this->set(compact('evokation', 'group', 'user', 'comment', 'votes', 'vote', 'can_edit', 'follows',
		 'sumMyPoints', 'evokationContent', 'newUpdate', 'updateId', 'allUpdates'));
	}

/**
 * view draft method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function viewDraft($id = null) {
		if (!$this->Evokation->exists($id)) {
			throw new NotFoundException(__('Invalid evokation'));
		}
		$options = array('conditions' => array('Evokation.' . $this->Evokation->primaryKey => $id));
		$this->set('evokation', $this->Evokation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Evokation->create();
			if ($this->Evokation->save($this->request->data)) {
				$this->Session->setFlash(__('The evokation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evokation could not be saved. Please, try again.'));
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
		if (!$this->Evokation->exists($id)) {
			throw new NotFoundException(__('Invalid evokation'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Evokation->save($this->request->data)) {
				$this->Session->setFlash(__('The evokation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evokation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Evokation.' . $this->Evokation->primaryKey => $id));
			$this->request->data = $this->Evokation->find('first', $options);
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
		$this->Evokation->id = $id;
		if (!$this->Evokation->exists()) {
			throw new NotFoundException(__('Invalid evokation'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Evokation->delete()) {
			$this->Session->setFlash(__('The evokation has been deleted.'));
		} else {
			$this->Session->setFlash(__('The evokation could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Evokation->recursive = 0;
		$this->set('evokations', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Evokation->exists($id)) {
			throw new NotFoundException(__('Invalid evokation'));
		}
		$options = array('conditions' => array('Evokation.' . $this->Evokation->primaryKey => $id));
		$this->set('evokation', $this->Evokation->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Evokation->create();
			if ($this->Evokation->save($this->request->data)) {
				$this->Session->setFlash(__('The evokation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evokation could not be saved. Please, try again.'));
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
		if (!$this->Evokation->exists($id)) {
			throw new NotFoundException(__('Invalid evokation'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Evokation->save($this->request->data)) {
				$this->Session->setFlash(__('The evokation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evokation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Evokation.' . $this->Evokation->primaryKey => $id));
			$this->request->data = $this->Evokation->find('first', $options);
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
		$this->Evokation->id = $id;
		if (!$this->Evokation->exists()) {
			throw new NotFoundException(__('Invalid evokation'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Evokation->delete()) {
			$this->Session->setFlash(__('The evokation has been deleted.'));
		} else {
			$this->Session->setFlash(__('The evokation could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
