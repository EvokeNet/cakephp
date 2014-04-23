<?php
App::uses('AppController', 'Controller');
/**
 * Missions Controller
 *
 * @property Mission $Mission
 * @property PaginatorComponent $Paginator
 */
class MissionsController extends AppController {

/**
 * Components
 *
 * @var array
 */

	public $components = array('Paginator', 'Session', 'Access');
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

		//checking Acl permission
		if(!$this->Access->check($this->user['role_id'],'controllers/'. $this->name .'/'.$this->action)) {
			$this->Session->setFlash(__("You don't have permission to access this area. If needed, contact the administrator."), 'flash_error_message');	
			$this->redirect(array('controller' => 'users', 'action' => 'dashboard', $this->user['id']));
		}
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Mission->recursive = 0;
		$this->set('missions', $this->Paginator->paginate());

		$this->loadModel('User');

		$user = $this->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$missionIssues = $this->Mission->MissionIssue->find('all', array('order' => 'MissionIssue.issue_id'));

		$this->loadModel('Issue');
		$issues = $this->Issue->find('all');

		$this->set(compact('user', 'missionIssues', 'issues'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null, $phase_number = null, $phaseId = null) {
		if (!$this->Mission->exists($id)) {
			throw new NotFoundException(__('Invalid mission'));
		}

		$mission = $this->Mission->find('first', array('conditions' => array('Mission.' . $this->Mission->primaryKey => $id)));

		$this->loadModel('User');

		$user = $this->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		if(($user['User']['basic_training'] == 0) && ($user['User']['role_id'] != 1) && ($mission['Mission']['basic_training'] == 0)) {
			$this->Session->setFlash(__("You haven't completed the Basic Training"), 'flash_message');
			return $this->redirect(array('controller' => 'users', 'action' => 'dashboard', $user['User']['id']));
		}

		$missionPhases = $this->Mission->Phase->find('all', array('conditions' => array('Phase.mission_id' => $id), 'order' => 'Phase.position'));

		if(!is_null($phaseId)){
			$missionPhase = $this->Mission->Phase->find('first', array('conditions' => array('Phase.mission_id' => $id, 'Phase.id' => $phaseId)));	
			if(!empty($missionPhase))
				$phase_number = $missionPhase['Phase']['position'];
		}
		

		if($phase_number > count($missionPhases)) {
			$this->Session->setFlash(__("This mission/phase does not exist!"));
			$this->redirect($this->referer());
		}

		$missionPhase = $this->Mission->Phase->find('first', array('conditions' => array('Phase.mission_id' => $id, 'Phase.position' => $phase_number)));
		$nextMP = $this->Mission->Phase->getNextPhase($missionPhase, $id);
		$prevMP = $this->Mission->Phase->getPrevPhase($missionPhase, $id);

		//$evidences = $this->Mission->getEvidences($id);

		$evidences = $this->Mission->Evidence->find('all', array('order' => array('Evidence.created DESC'), 'conditions' => array('Evidence.mission_id' => $id)));

		//$eevis = $this->Mission->Evidence->find('all', array('fields' => array 'fields' => array('SUM(Like.rating) as avg_rating'), order' => array('Evidence.created DESC'), 'conditions' => array('Evidence.mission_id' => $id)));
		//debug($evidence);

		$this->loadModel('Evokation');
		$allevokations = $this->Evokation->find('all', array(
			'order' => array(
				'Evokation.created DESC'
			),
			'conditions' => array(
				'Evokation.sent' => 1
			)
		));

		$success_evokations = array();
		$evokations = array();
		//only get evokations from this mission
		foreach ($allevokations as $evokation) {
			if($evokation['Group']['mission_id'] = $id) {
				$evokations[] = $evokation;
				if($evokation['Evokation']['approved'] == 1)
					$success_evokations[] = $evokation;
			}
		}

		$missionIssues = $this->Mission->getMissionIssues($id);
		$quests = $this->Mission->Quest->find('all', array('conditions' => array('Quest.mission_id' => $id, 'Quest.phase_id' => $missionPhase['Phase']['id'])));
		
		//will be used in retrieving all users groups id to get his evokations!
		$myEvokations_groupsids = array();

		$hasGroup = false;
		//check to see if user has entered a group of this mission..
		foreach ($mission['Group'] as $group) {
			if($group['user_id'] == $this->getUserId()) {
				$hasGroup = true;
				array_push($myEvokations_groupsids, array('Evokation.group_id' => $group['id']));
				//break;
			}

			$this->loadModel('GroupsUser');
			$groupsuser = $this->GroupsUser->find('all', array(
				'conditions' => array(
					'GroupsUser.group_id' => $group['id']
				)
			));
			foreach ($groupsuser as $member) {
				if($member['GroupsUser']['user_id'] == $this->getUserId()) {
					$hasGroup = true;
					array_push($myEvokations_groupsids, array('Evokation.group_id' => $member['GroupsUser']['group_id']));
					//break;
				}
			}
		}

		//getting all user's evokations from this mission!
		$myEvokations = array();
		if(!empty($myEvokations_groupsids)) {
			$this->loadModel('Evokation');
			$myEvokations = $this->Evokation->find('all', array(
				'conditions' => array(
					'OR' => $myEvokations_groupsids
				)
			));
		}

		//retrieving all ids from quests of this mission..
		$my_quests_id = array();
		$my_quests_id2 = array();
		$k = 0;
		foreach ($quests as $quest) {
			$my_quests_id[$k] = array('quest_id' => $quest['Quest']['id']);
			$my_quests_id2[$k] = array('foreign_key' => $quest['Quest']['id'], 'model' => 'Quest'); //specials condiditions to search in the Attachment database'
			$k++;
		}

		//needed to be able to display and edit a quest's questionnaire
		$this->loadModel('Questionnaire');
		$questionnaires = $this->Questionnaire->find('all', array(
			'conditions' => array(
				'OR' => $my_quests_id
			)
		));

		$this->loadModel('Answer');
		$answers = $this->Answer->find('all');
		$this->loadModel('UserAnswer');
		$previous_answers = $this->UserAnswer->find('all', array(
			'conditions' => array(
				'user_id' => $this->getUserId()
			)
		));

		$this->loadModel('Dossier');
		$dossier = $this->Dossier->find('first', array(
			'conditions' => array(
				'mission_id' => $id
			)
		));

		//needed to be able to display quests' media..
		$this->loadModel('Attachment');
		$attachments = $this->Attachment->find('all', array(
			'conditions' => array(
				'OR' => $my_quests_id2
			)
		));

		$mission_img = null;
		if(!is_null($id)){
			$mission_img = $this->Attachment->find('all', array('order' => array('Attachment.id' => 'desc'), 'conditions' => array('Model' => 'Mission', 'foreign_key' => $id)));
		}

		if(!empty($dossier)) {
			//dossier files
			$dossier_files = $this->Attachment->find('all', array(
				'conditions' => array(
					'Attachment.foreign_key' => $dossier['Dossier']['id'],
					'Attachment.model' => 'Dossier'
				)
			));
		} else {
			$dossier_files = array();
		}

		$this->loadModel('Evidence');
		$my_evidences = $this->Evidence->find('all', array(
			'order' => array('Evidence.title ASC'),
			'conditions' => array(
				'user_id' => $this->getUserId(),
				'OR' => $my_quests_id
			)
		));

		//checking number of mandatory quests per phase and number of completed ones..
		$all_mandatory_quests = $this->Mission->Quest->find('all', array('conditions' => array('Quest.mission_id' => $id, 'Quest.mandatory' => 1)));

		$tmp = 0;
		$total = array();
		$completed = array();
		foreach ($all_mandatory_quests as $q) {
			$tmp = $q['Quest']['phase_id'];
			if(isset($total[$tmp]))
				$total[$tmp]++;
			else 
				$total[$tmp] = 1;

			$done = false;

			$this->loadModel('Evidence');
			$my_evidences_quest = $this->Evidence->find('all', array(
				'order' => array('Evidence.title ASC'),
				'conditions' => array(
					'user_id' => $this->getUserId(),
					'quest_id' => $q['Quest']['id']
				)
			));
			//if it was an 'evidence' type quest
			if(!empty($my_evidences_quest)) {
				$done = true; 
			}
			

			//if it was a questionnaire type quest
			//theres only one
			if($q['Questionnaire']['id'] != "") {
				foreach ($previous_answers as $previous_answer) {
					if($q['Quest']['id'] == $q['Questionnaire']['quest_id'] && $q['Questionnaire']['id'] == $previous_answer['Question']['questionnaire_id']) {
						$done = true; 
						break;
					}
				}
			}
			

			//if its a group type quest, check to see if user owns or belongs to a group of this mission
			if($q['Quest']['type'] == 3) {
				if($hasGroup) {
					$done = true;
				}
			}

			if($done){
				if(isset($completed[$tmp]))
					$completed[$tmp]++;
				else
					$completed[$tmp] = 1;
			} else {
				if(!isset($completed[$tmp]))
					$completed[$tmp] = 0;
			} 
		}

		$users = $this->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$myPoints = $this->User->Point->find('all', array('conditions' => array('Point.user_id' => $this->getUserId())));

		$sumMyPoints = 0;
		
		foreach($myPoints as $point){
			$sumMyPoints += $point['Point']['value'];
		}

		$evokationsFollowing = $this->User->EvokationFollower->find('all');

		$is_phase_completed = false;

		if(($completed[$missionPhase['Phase']['id']] == $total[$missionPhase['Phase']['id']])){

			$event = new CakeEvent('Controller.Phase.completed', $this, array(
	            'entity_id' => $missionPhase['Phase']['id'],
	            'user_id' => $this->getUserId(),
	            'entity' => 'phaseCompleted',
	            'points' => $missionPhase['Phase']['points'],
	            'phase_name' => $missionPhase['Phase']['name'],
	            'next_phase' => $nextMP['Phase']['id'],
	            'mission_id' => $missionPhase['Mission']['id']
	        ));

	        $this->getEventManager()->dispatch($event);

	        $is_phase_completed = true;

	        // $this->loadModel('Notification');

	        // $exists = $this->Notification->find('first', array('conditions' => array('origin_id' => $missionPhase['Phase']['id'], 'user_id' => $this->getUserId(),
	        //     'origin' => 'phaseCompleted')));

	        // if(!$exists)
	        // 	$this->Session->setFlash(__("You have completed the Basic Training"), 'flash_lightbox_message');

	        // $event2 = new CakeEvent('Controller.Phase.notifyCompleted', $this, array(
	        //     'entity_id' => $missionPhase['Phase']['id'],
	        //     'user_id' => $this->getUserId(),
	        //     'entity' => 'phaseCompleted',
	        // ));

	        // $this->getEventManager()->dispatch($event2);

	        // $this->Session->setFlash(sprintf(__("You have completed the %s Phase"), $missionPhase['Phase']['name']), 'flash_lightbox_message');

		} if(($completed[$missionPhase['Phase']['id']] == $total[$missionPhase['Phase']['id']]) && ($mission['Mission']['basic_training'] == 1) && ($user['User']['basic_training'] == 0)){

			$this->loadModel('PointsDefinition');
	        $def = new PointsDefinition();
	        $preset_point = $def->find('first', array(
	            'conditions' => array(
	                'type' => 'BasicTraining'
	            )
	        ));

	        if($preset_point)
	            $value = $preset_point['PointsDefinition']['points'];

			$event3 = new CakeEvent('Controller.BasicTraining.completed', $this, array(
	            'entity_id' => $mission['Mission']['id'],
	            'user_id' => $this->getUserId(),
	            'entity' => 'BasicTraining',
	            'points' => $value
	        ));

	        $this->getEventManager()->dispatch($event3);

	        // $this->loadModel('Notification');

	        // $exists = $this->Notification->find('first', array('conditions' => array('origin_id' => $mission['Mission']['id'], 'user_id' => $this->getUserId(),
	        //     'origin' => 'phaseCompleted')));
	        // if(!$exists)
	        	// $this->Session->setFlash(__("You have completed the Basic Training"), 'flash_lightbox_message');
			//return $this->redirect(array('controller' => 'users', 'action' => 'dashboard', $user['User']['id']));
		}

		$this->set(compact('user', 'evidences', 'evokations', 'quests', 'mission', 'missionIssues', 'phase_number', 'missionPhases', 'missionPhase', 'nextMP', 'prevMP', 'myEvokations', 'success_evokations',
			'questionnaires', 'answers', 'previous_answers', 'attachments', 'my_evidences', 'evokationsFollowing', 'users', 'organized_by', 'mission_img', 'dossier_files', 'hasGroup', 'total', 'completed', 'sumMyPoints', 'is_phase_completed'));

		if($mission['Mission']['basic_training'] == 1)
			$this->render('basic_training');
		else if($missionPhase['Phase']['type'] == 0)
			$this->render('view_discussion');
		else
			$this->render('view_project');
	}

/**
 * basic training method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function basicTraining($id = null) {
		if (!$this->Mission->exists($id)) {
			throw new NotFoundException(__('Invalid mission'));
		}

		$this->loadModel('User');
		$user = $this->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$quests = $this->Mission->Quest->find('all', array('conditions' => array('Quest.mission_id' => $id)));

		$my_quests_id = array();
		$my_quests_id2 = array();
		$k = 0;
		foreach ($quests as $quest) {
			$my_quests_id[$k] = array('quest_id' => $quest['Quest']['id']);
			$my_quests_id2[$k] = array('foreign_key' => $quest['Quest']['id'], 'model' => 'Quest'); //specials condiditions to search in the Attachment database'
			$k++;
		}

		$this->loadModel('Questionnaire');
		$questionnaires = $this->Questionnaire->find('all', array(
			'conditions' => array(
				'OR' => $my_quests_id
			)
		));

		$this->loadModel('Answer');
		$answers = $this->Answer->find('all');
		$this->loadModel('UserAnswer');
		$previous_answers = $this->UserAnswer->find('all', array(
			'conditions' => array(
				'user_id' => $this->getUserId()
			)
		));

		$options = array('conditions' => array('Mission.' . $this->Mission->primaryKey => $id));
		$this->set('mission', $this->Mission->find('first', $options));

		$this->set(compact('user', 'quests', 'questionnaires', 'previous_answers'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Mission->create();
			if ($this->Mission->save($this->request->data)) {
				$this->Session->setFlash(__('The mission has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mission could not be saved. Please, try again.'));
			}
		}

		$missions = $this->Mission->find('list');		
		$this->set(compact("missions"));

	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Mission->exists($id)) {
			throw new NotFoundException(__('Invalid mission'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Mission->save($this->request->data)) {
				$this->Session->setFlash(__('The mission has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mission could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Mission.' . $this->Mission->primaryKey => $id));
			$this->request->data = $this->Mission->find('first', $options);
		}

			//'questionnaires', 'answers', 'previous_answers', 'attachments', 'my_evidences', 'organized_by', 'mission_img', 'dossier_files'));

	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Mission->id = $id;
		if (!$this->Mission->exists()) {
			throw new NotFoundException(__('Invalid mission'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Mission->delete()) {
			$this->Session->setFlash(__('The mission has been deleted.'));

			//deletar todos os registros de missions_issue referentes a esse issue
			$this->loadModel('MissionIssue');
			$this->MissionIssue->deleteAll(array('mission_id = '.$id));
		} else {
			$this->Session->setFlash(__('The mission could not be deleted. Please, try again.'));
		}
		//returning to the admin panels
		return $this->redirect(array('controller' => 'panels', 'action' => 'index', 'missions'));	
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Mission->recursive = 0;
		$this->set('missions', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Mission->exists($id)) {
			throw new NotFoundException(__('Invalid mission'));
		}
		$options = array('conditions' => array('Mission.' . $this->Mission->primaryKey => $id));
		$this->set('mission', $this->Mission->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Mission->create();
			if ($this->Mission->save($this->request->data)) {
				$this->Session->setFlash(__('The mission has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mission could not be saved. Please, try again.'));
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
		if (!$this->Mission->exists($id)) {
			throw new NotFoundException(__('Invalid mission'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Mission->save($this->request->data)) {
				$this->Session->setFlash(__('The mission has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mission could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Mission.' . $this->Mission->primaryKey => $id));
			$this->request->data = $this->Mission->find('first', $options);
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
		$this->Mission->id = $id;
		if (!$this->Mission->exists()) {
			throw new NotFoundException(__('Invalid mission'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Mission->delete()) {
			$this->Session->setFlash(__('The mission has been deleted.'));
		} else {
			$this->Session->setFlash(__('The mission could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
