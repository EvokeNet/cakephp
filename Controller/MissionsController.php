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
	public $helpers = array('BrainstormSession.Brainstorm' => array('unavailable_content_hidden' => true));
	public $user = null;

	public function beforeFilter() {
		parent::beforeFilter();
		
		$this->user = array();
		//get user data into public var
		$this->user['role_id'] = $this->getUserRole();
		$this->user['id'] = $this->getUserId();
		$this->user['name'] = $this->getUserName();
		
		//there was some problem in retrieving user's info concerning his/her role : send him home
		// if(!isset($this->user['role_id']) || is_null($this->user['role_id'])) {
		// 	$this->redirect(array('controller' => 'users', 'action' => 'login'));
		// }

		$this->Auth->allow('view_sample', 'view_test');

		//checking Acl permission
		/*if(!$this->Access->check($this->user['role_id'],'controllers/'. $this->name .'/'.$this->action)) {
			$this->Session->setFlash(__("You don't have permission to access this area. If needed, contact the administrator."), 'flash_error_message');	
			$this->redirect(array('controller' => 'users', 'action' => 'dashboard', $this->user['id']));
		}*/
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$lang = $this->getCurrentLanguage();
		$flags['_en'] = true;
		$flags['_es'] = false;
		if($lang=='es') {
			$flags['_en'] = false;
			$flags['_es'] = true;
		}

		$missions = $this->Mission->find('all', array('conditions' => array('Mission.basic_training' => 0)));
		foreach ($missions as $m => $mission) {
			if($flags['_es']) {
				$missions[$m]['Mission']['title'] = $mission['Mission']['title_es'];
				$missions[$m]['Mission']['description'] = $mission['Mission']['description_es'];
			}

		}

		$basic_training = $this->Mission->find('first', array('conditions' => array('Mission.basic_training' => 1)));

		$this->loadModel('User');

		$user = $this->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$missionIssues = $this->Mission->MissionIssue->find('all', array('order' => 'MissionIssue.issue_id'));

		$this->loadModel('Issue');
		$issues = $this->Issue->find('all');

		$this->set(compact('missions', 'user', 'missionIssues', 'issues', 'basic_training'));
	}

/**
 * index method
 *
 * @return void
 */
	public function link($user_id, $basic_training, $mission_id, $phase_id, $url) {

		$this->loadModel('UserPhaseChecklist');

		if($basic_training == 1){
			$insertData = array(
				'user_id' => $user_id,  
				'phase_checklist_id' => 3,
				'mission_id' => $mission_id,
				'phase_id' => $phase_id,
				'completed' => true,
			);

			$check3 = $this->UserPhaseChecklist->find('first', array('conditions' => array(
				'UserPhaseChecklist.user_id' => $user_id,  
				'UserPhaseChecklist.phase_checklist_id' => 3,
				'UserPhaseChecklist.mission_id' => $mission_id,
				'UserPhaseChecklist.phase_id' => $phase_id,
			)));

			if(empty($check3))
				$this->UserPhaseChecklist->saveAll($insertData);

		} 

		$url = str_replace('HTMLSLASH', '/', $url);
		return $this->redirect('http://'.$url);

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
		$lang = $this->getCurrentLanguage();
		$flags['_en'] = true;
		$flags['_es'] = false;
		if($lang=='es') {
			$flags['_en'] = false;
			$flags['_es'] = true;
		}


		//MISSION
		$mission = $this->Mission->find('first', array('conditions' => array('Mission.' . $this->Mission->primaryKey => $id)));

		//USER
		$this->loadModel('User');

		$user = $this->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		//CHECK IF USER HAS COMPLETED BASIC TRAINING
		if(($user['User']['basic_training'] == 0) && ($user['User']['role_id'] != 1) && ($mission['Mission']['basic_training'] == 0)) {
			$this->Session->setFlash(__("You haven't completed the Basic Training"), 'flash_message');
			return $this->redirect(array('controller' => 'users', 'action' => 'dashboard', $user['User']['id']));
		}

		//PHASES IN THIS MISSION
		//All phases
		$missionPhases = $this->Mission->Phase->find('all', array('conditions' => array('Phase.mission_id' => $id), 'order' => 'Phase.position'));

		//If a speficif phase ID was requested
		if(!is_null($phaseId)){
			$missionPhase = $this->Mission->Phase->find('first', array('conditions' => array('Phase.mission_id' => $id, 'Phase.id' => $phaseId)));	
			if(!empty($missionPhase))
				$phase_number = $missionPhase['Phase']['position'];
		}
		
		//If a speficif phase number was requested
		if(is_null($phase_number))
			$this->redirect(array('controller' => 'missions', 'action' => 'view', $id, 1)); //?????????? parece que seria só setar $phase_number = 1 aqui!!!!!!!!!

		if($phase_number > count($missionPhases)) {
			$this->Session->setFlash(__("There are no phases for this mission"), 'flash_message');
			$this->redirect($this->referer());
		}

		//Specific phase request
		$missionPhase = $this->Mission->Phase->find('first', array('conditions' => array('Phase.mission_id' => $id, 'Phase.position' => $phase_number)));
		$nextMP = $this->Mission->Phase->getNextPhase($missionPhase, $id);
		$prevMP = $this->Mission->Phase->getPrevPhase($missionPhase, $id);	

		if($flags['_es']) {
			$mission['Mission']['title'] = $mission['Mission']['title_es'];
			$mission['Mission']['description'] = $mission['Mission']['description_es'];

		}

		$novels_en = $this->Mission->Novel->find('all', array(
			'order' => array(
				'Novel.page Asc'
			),
			'conditions' => array(
				'Novel.mission_id' => $id,
				'Novel.language' => 'en'
			)
		));

		$novels_es = $this->Mission->Novel->find('all', array(
			'order' => array(
				'Novel.page Asc'
			),
			'conditions' => array(
				'Novel.mission_id' => $id,
				'Novel.language' => 'es'
			)
		));

		$evidences = $this->Mission->Evidence->find('all', array(
			'order' => array(
				'Evidence.created DESC'
			), 
			'conditions' => array(
				'Evidence.mission_id' => $id, 
				'Evidence.phase_id' => $missionPhase['Phase']['id'],
				'Evidence.title != ' => ''
			)
		));

		//EVIDENCES
		//Liked
		$liked_evidences = array();
		foreach ($evidences as $e) {
			$liked_evidences[count($e['Like'])][] = $e;
		}
		krsort($liked_evidences);

		//EVOKATIONS
		//All
		$this->loadModel('Evokation');
		$allevokations = $this->Evokation->find('all', array(
			'order' => array(
				'Evokation.created DESC'
			),
			'conditions' => array(
				'Evokation.sent' => 1
			)
		));

		//Success
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

		//ISSUES
		$missionIssues = $this->Mission->getMissionIssues($id);

		//QUESTS
		$quests = $this->Mission->Quest->find('all', array('conditions' => array('Quest.mission_id' => $id, 'Quest.phase_id' => $missionPhase['Phase']['id'])));
		
		//will be used in retrieving all users groups id to get his evokations!
		$myGroupsIds = array();

		//GROUPS
		$hasGroup = false;
		//check to see if user has entered a group of this mission..
		foreach ($mission['Group'] as $group) {
			if($group['user_id'] == $this->getUserId()) {
				$hasGroup = true;
				array_push($myGroupsIds, array('Evokation.group_id' => $group['id']));
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
					array_push($myGroupsIds, array('Evokation.group_id' => $member['GroupsUser']['group_id']));
					//break;
				}
			}
		}

		//GROUP EVOKATIONS getting all user's evokations from this mission!
		$myEvokations = array();
		if(!empty($myGroupsIds)) {
			$this->loadModel('Evokation');
			$myEvokations = $this->Evokation->find('all', array(
				'conditions' => array(
					'OR' => $myGroupsIds
				)
			));
		}

		//POINTS - getting power points from evoke to display the ones related to quests in quests' lightboxes
		$this->loadModel('PowerPoint');
		$tmp = $this->PowerPoint->find('all');
		$allPowerPoints = array(); //will contain all evoke's powerpoints with the first index as their id's (i.e. the power point with id 33 will be at $allPowerPoints[33])
		foreach ($tmp as $tmpKey => $tmpPP) {
			if($flags['_es']) {
				$tmp[$tmpKey]['PowerPoint']['name']	= $tmp[$tmpKey]['PowerPoint']['name_es'];
				$tmp[$tmpKey]['PowerPoint']['description']	= $tmp[$tmpKey]['PowerPoint']['description_es'];
			}
			$allPowerPoints[$tmpPP['PowerPoint']['id']] = $tmp[$tmpKey];
		}


		//BADGES - getting badges from evoke to display the ones related to quests in quests' lightboxes
		$this->loadModel('Badge');
		$tmp = $this->Badge->find('all');
		$allBadges = array(); //will contain all evoke's badges with the first index as their id's (i.e. the badge with id 33 will be at $allBadges[33])
		foreach ($tmp as $tmpKey => $tmpB) {
			if($flags['_es']) {
				$tmp[$tmpKey]['Badge']['name']	= $tmp[$tmpKey]['Badge']['name_es'];
				$tmp[$tmpKey]['Badge']['description']	= $tmp[$tmpKey]['Badge']['description_es'];
			}
			$allBadges[$tmpB['Badge']['id']] = $tmp[$tmpKey];
		}

		//QUESTS IDS retrieving all ids from quests of this mission..
		$my_quests_id = array();
		$my_quests_id2 = array();
		$k = 0;
		foreach ($quests as $q => $quest) {
			if($flags['_es']) {
				$quests[$q]['Quest']['title'] = $quest['Quest']['title_es'];
				$quests[$q]['Quest']['description'] = $quest['Quest']['description_es'];
			}

			$my_quests_id[$k] = array('quest_id' => $quest['Quest']['id']);
			$my_quests_id2[$k] = array('foreign_key' => $quest['Quest']['id'], 'model' => 'Quest'); //specials condiditions to search in the Attachment database'
			$k++;
		}

		//QUESTIONNAIRES - needed to be able to display and edit a quest's questionnaire
		$this->loadModel('Questionnaire');
		$questionnaires = $this->Questionnaire->find('all', array(
			'conditions' => array(
				'OR' => $my_quests_id
			)
		));

		//ANSWERS
		$this->loadModel('Answer');
		$answers = $this->Answer->find('all');
		$this->loadModel('UserAnswer');
		$previous_answers = $this->UserAnswer->find('all', array(
			'conditions' => array(
				'user_id' => $this->getUserId()
			)
		));

		//DOSSIER
		$this->loadModel('Dossier');
		$dossier = $this->Dossier->find('first', array(
			'conditions' => array(
				'mission_id' => $id
			)
		));

		//ATTACHMENTS - needed to be able to display quests' media..
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

		$this->loadModel('Launcher');
		$launcher = $this->Launcher->find('all', array(
			'conditions' => array(
				'Launcher.mission_id' => $id
			)
		));

		$launchers = array();
		foreach ($launcher as $lkey => $l) {
			$launcherImg = $this->Attachment->find('first', array(
				'order' => array(
					'Attachment.id Desc'
				),
				'conditions' => array(
					'Attachment.model' => 'Launcher',
					'Attachment.foreign_key' => $l['Launcher']['id']
				)
			));	
			$launcher[$lkey]['Launcher']['image_dir'] = null;
			$launcher[$lkey]['Launcher']['image_name'] = null;
			if(!empty($launcherImg)){
				$launcher[$lkey]['Launcher']['image_dir'] = $launcherImg['Attachment']['dir'];
				$launcher[$lkey]['Launcher']['image_name'] = $launcherImg['Attachment']['attachment'];
			}

			$launchers[$l['Launcher']['phase_id']] = $launcher[$lkey]['Launcher'];
		}

		if($flags['_es'])
			$langs = 'es';
		else
			$langs = 'en';

		$links = $this->Mission->DossierLink->find('all', array('conditions' => array('DossierLink.mission_id' => $id, 'DossierLink.language' => $langs)));
		$video_links = $this->Mission->DossierVideo->find('all', array('conditions' => array('DossierVideo.mission_id' => $id, 'DossierVideo.language' => $langs)));
		$checklists = $this->Mission->PhaseChecklist->find('all', array('conditions' => array('PhaseChecklist.mission_id' => $id, 'PhaseChecklist.phase_id' => $missionPhase['Phase']['id'], 'PhaseChecklist.language' => $langs)));

		$this->loadModel('Evidence');
		$my_evidences = $this->Evidence->find('all', array(
			'order' => array('Evidence.title ASC'),
			'conditions' => array(
				'Evidence.user_id' => $this->getUserId(),
				'Evidence.phase_id' => $missionPhase['Phase']['id'],
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
			if($q['Quest']['type'] == Quest::TYPE_GROUP_CREATION) {
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

		$count_completed_phases = 0;

		$this->loadModel('Badge');

		// $badge = $this->Badge->find('first', array('conditions' => array('Badge.mission_id' => $mission['Mission']['id'])));

		// foreach($missionPhases as $m):
		// 	if(($completed[$m['Phase']['id']] == $total[$m['Phase']['id']]))
		// 		$count_completed_phases++;
		// endforeach;

		// debug($count_completed_phases);
		// debug(count($missionPhases));
		// debug($user['User']['basic_training']);
		// debug($badge);

		if((count($missionPhases) == $count_completed_phases) && ($user['User']['basic_training'] == 1) && (isset($badge))){
			$event = new CakeEvent('Controller.Mission.grit', $this, array(
				'entity_id' => $badge['Badge']['id'],
				'user_id' => $this->getUserId(),
				'entity' => 'gritBadge',
				'mission_name' => $mission['Mission']['title']
			));

			$this->getEventManager()->dispatch($event);
		}
		
		if(isset($completed[$missionPhase['Phase']['id']]) && ($completed[$missionPhase['Phase']['id']] == $total[$missionPhase['Phase']['id']])){

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

		} if(isset($completed[$missionPhase['Phase']['id']]) && 
			($completed[$missionPhase['Phase']['id']] == $total[$missionPhase['Phase']['id']]) && 
			($mission['Mission']['basic_training'] == 1) && ($user['User']['basic_training'] == 0)){

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

		if($mission['Mission']['basic_training'] == 1){
			$myevidences = $this->Mission->Evidence->find('all', array(
				'order' => array(
					'Evidence.created DESC'
				), 
				'conditions' => array(
					'Evidence.mission_id' => $id, 
					'Evidence.user_id' => $user['User']['id']
				)
			));
		}


		$this->set(compact('launchers', 'allBadges', 'allPowerPoints', 'checklists', 'links', 'video_links', 'lang', 'user', 'evidences', 'liked_evidences', 'evokations', 'quests', 'mission', 'missionIssues', 'phase_number', 
			'missionPhases', 'missionPhase', 'nextMP', 'prevMP', 'myEvokations', 'success_evokations', 'myevidences', 'novels_es', 'novels_en',
			'questionnaires', 'answers', 'previous_answers', 'attachments', 'my_evidences', 'evokationsFollowing', 'users', 'organized_by', 'mission_img', 'dossier_files', 'hasGroup', 'total', 'completed', 'sumMyPoints', 'is_phase_completed'));

		// if(isset($prevMP['Phase']['id']) && ((($completed[$prevMP['Phase']['id']] * 100)/$total[$prevMP['Phase']['id']]) != 100)) 
		// 	return $this->redirect(array('controller' => 'missions', 'action' => 'view', $mission['Mission']['id'], $prevMP['Phase']['position']));
		if(isset($prevMP['Phase']['id']) && ($mission['Mission']['basic_training'] == 1) && $completed[$prevMP['Phase']['id']] < 2 && $user['User']['role_id'] > 2){
			$this->Session->setFlash(__('You need to finish at least to quests to complete Basic Training'), 'flash_message');
			return $this->redirect(array('controller' => 'missions', 'action' => 'view', $mission['Mission']['id'], $prevMP['Phase']['position']));
		}
		if(isset($prevMP['Phase']['id']) && ($mission['Mission']['basic_training'] == 0) && $completed[$prevMP['Phase']['id']] < 1 && $user['User']['role_id'] > 2){
			$this->Session->setFlash(__('You need to finish at least one quest to go to next phase'), 'flash_message');
			return $this->redirect(array('controller' => 'missions', 'action' => 'view', $mission['Mission']['id'], $prevMP['Phase']['position']));
		}

		if($mission['Mission']['basic_training'] == 1)
			$this->render('basic_training');
		else if($missionPhase['Phase']['type'] == Phase::TYPE_INDIVIDUAL)
			$this->render('view_discussion');
		else
			$this->render('view_project');
	}

/**
 * Renders tab with all quests in a phase
 * @param int $phase_id - ID of the phase
 */
	public function renderQuestsTab($phase_id = null) {
		if (!$this->Mission->Phase->exists($phase_id)) {
			throw new NotFoundException(__('Invalid mission phase'));
		}

		$user = $this->Auth->user();

		//PHASE
		$phase = $this->Mission->Phase->find('first', array(
			'conditions' => array('Phase.id' => $phase_id),
			'contain' => array('Quest' => 'Group')
		));

		foreach ($phase['Quest'] as $key => &$quest) {
			//WHETHER THE USER HAS COMPLETED THE QUEST OR NOT
			$quest['has_completed'] = $this->Mission->Phase->Quest->hasCompleted($this->user['id'], $quest['id']);

			//RESPONSE (if completed)
			if ($quest['has_completed']) {
				$quest['Response'] = $this->Mission->Phase->Quest->getQuestResponse($this->user['id'], $quest['id']);

				//GROUP -- CHECK IF THE USER IS MEMBER/OWNER
				if ($quest['type'] == Quest::TYPE_GROUP_CREATION) {
					$quest['Response']['Group']['is_owner'] = $this->Mission->Phase->Group->isOwner($quest['Response']['Group']['id'], $user['id']);
					$quest['Response']['Group']['is_member'] = $this->Mission->Phase->Group->isMember($quest['Response']['Group']['id'], $user['id']);
				}
			}
			
			//GROUP -- CHECK IF THE USER IS MEMBER/OWNER
			foreach ($quest['Group'] as $group_key => &$group) { //group belongs to the quest it was created in
				$group['is_owner'] = $this->Mission->Phase->Group->isOwner($group['id'], $user['id']);
				$group['is_member'] = $this->Mission->Phase->Group->isMember($group['id'], $user['id']);

				//BRAINSTORM TIMELINE
				//Members of the group see the brainstorm timeline for all the quests of the phase
				if ($group['is_member']) {
					foreach ($phase['Quest'] as $key2 => &$phase_quest) {
						if ($phase_quest['type'] == Quest::TYPE_BRAINSTORM) {
							$phase_quest['Timeline'] = $this->Mission->Phase->Group->findTimelineByGroupAndQuest($group['id'],$phase_quest['id']);
						}
					}
				}
			}
		}

		//Render
		$this->set(compact('phase'));
		$this->layout = 'ajax';
		$this->render('/Elements/Missions/quest_tabs');
	}

/**
 * Renders tab with dossier content
 * @param int $mission_id - Optional ID to see dossier from a specific mission
 * @param int $limit - Optional limit to the number of items
 */
	public function renderDossierTab($mission_id = null, $limit = null) {
		$dossier_query_params = array();

		//FUNCTION PARAMS
		//Dossier from a specific mission
		if (!is_null($mission_id)) {
			$dossier_query_params['conditions'] = array('mission_id' => $mission_id);
		}

		//Limit to the query
		$dossier_query_params['limit'] = $limit;

		//CONTAINABLE MODELS
		$dossier_query_params['contain'] = 'User';

		//RUN DOSSIER QUERY
		$this->loadModel('Dossier');
		$dossier = $this->Dossier->find('first', $dossier_query_params);
		
		//Dossier files (may be pictures, videos etc.: will be determined by field Type)
		$this->loadModel('Attachment');
		if(!empty($dossier)) {
			$dossier_files = $this->Attachment->find('all', array(
				'conditions' => array(
					'Attachment.foreign_key' => $dossier['Dossier']['id'],
					'Attachment.model' => 'Dossier'
				)
			));
		} else {
			$dossier_files = array();
		}

		//Dossier video links
		$this->loadModel('DossierVideo');
		$video_links = $this->Mission->DossierVideo->find('all', $dossier_query_params);

		//Dossier links
		$this->loadModel('DossierLink');
		$links = $this->Mission->DossierLink->find('all', $dossier_query_params);

		//Render
		$this->set(compact('dossier','dossier_files', 'video_links', 'links'));
		$this->layout = 'ajax';
		$this->render('/Elements/dossier_tabs');
	}


/**
 * Renders a list of evidences in the element evidence_list
 * @param int $mission_id - Optional ID to see evidences from a specific mission
 * @param int/array $user_id - Optional ID (int), or array of IDs, to see evidences from a specific user or set of users
 * @param int $limit - Optional limit to the number of evidences listed
 * @param string $order_by - Optional order for the query
 */
	public function renderEvidenceList() {
		$evidences = $this->getEvidences(
			$this->request->query('mission_id'),
			$this->request->query('user_id'),
			$this->request->query('limit'),
			$this->request->query('offset'),
			$this->request->query('order_by'));

		//Render
		$this->set(compact('evidences'));
		$this->layout = 'ajax';
		$this->render('/Elements/Evidences/evidence_list');
	}

/**
 * Returns the HTML of a list of evidences to be rendered
 * @param int $mission_id - Optional ID to see evidences from a specific mission
 * @param int/array $user_id - Optional ID (int), or array of IDs, to see evidences from a specific user or set of users
 * @param int $limit - Optional limit to the number of evidences listed (default: null)
 * @param int $offset - Optional limit to the number of evidences listed (default: 0)
 * @param string $order_by - Optional order for the query (default: date of creation DESC)
 */
	public function moreEvidences(){
		$this->autoRender = false; // We don't render a view
		
		//QUERY
		$newEvidences = $this->getEvidences(
			$this->request->query('mission_id'),
			$this->request->query('user_id'),
			$this->request->query('limit'),
			$this->request->query('offset'),
			$this->request->query('order_by'));

		//GENERATE HTML TO BE RETURNED
		$elementToRender = 'Evidences/evidence_list_item';
		$ind = 'Evidence';
		
		$newEvidencesHTML = "";

		foreach ($newEvidences as $key => $value) {
			$view = new View($this, false);
			$content = ($view->element($elementToRender, array('e' => $value)));

			$newEvidencesHTML .= $content .' ';
		}

		return $newEvidencesHTML;
	}

/**
 * Returns a list of evidences
 * @param int $mission_id - Optional ID to see evidences from a specific mission
 * @param int/array $user_id - Optional ID (int), or array of IDs, to see evidences from a specific user or set of users
 * @param int $limit - Optional limit to the number of evidences listed (default: null)
 * @param int $offset - Optional limit to the number of evidences listed (default: 0)
 * @param string $order_by - Optional order for the query (default: date of creation DESC)
 */
	public function getEvidences($mission_id = null, $user_id = null, $limit = null, $offset = 0, $order_by = null) {
		$this->autoRender = false; // We don't render a view

		$evidence_query_params = array();
		$evidence_query_params['conditions'] = array();

		//FUNCTION PARAMS
		//Evidences of a specific mission
		if (!is_null($mission_id)) {
			$evidence_query_params['conditions']['mission_id'] = $mission_id;
		}

		//Evidences of a specific user or set of users
		if (!is_null($user_id)) {
			$evidence_query_params['conditions']['user_id'] = $user_id;
		}

		//Limit to the query
		if (!is_null($limit)) {
			$evidence_query_params['limit'] = $limit;
		}
		
		//Offset (distance from beggining)
		if (!is_null($offset)) {
			$evidence_query_params['offset'] = $offset;
		}

		//Order
		if (!is_null($order_by)) {
			$evidence_query_params['order'] = $order_by;
		}
		else {
			$evidence_query_params['order'] = "Evidence.id DESC"; //DEFAULT ORDER: date of creation
		}

		//CONTAINABLE MODELS
		$evidence_query_params['contain'] = 'User';

		//RUN EVIDENCE QUERY
		$this->loadModel('Evidence');
		$evidences = $this->Evidence->find('all', $evidence_query_params);

		return $evidences;
	}


/**
 * View complete missions (after logged in)
 * @param int $mission_id - ID to see a specific mission
 */
	public function view_mission($mission_id, $phase_position = null, $phase_id = null) {
		if (!$this->Mission->exists($mission_id)) {
			throw new NotFoundException(__('Invalid mission'));
		}

		$user = $this->Auth->user();

		//---------------------------------
		//MISSION -> ALL PHASES
		$mission = $this->Mission->find('first', array(
			'conditions' => array('Mission.id' => $mission_id),
			'contain' => array(
				'Phase' => array('Quest' => 'Questionnaire'),
				'Group' => array(
					'User',
					'GroupsUser' => 'User'
				)
			)
		));

		//---------------------------------
		//PHASE THAT WILL BE RENDERED
		$phase_contain = array(
			'Quest' => 'Questionnaire'
		);
		//Did not request a specific phase ID
		if (!is_null($phase_id)) {
			$phase = $this->Mission->Phase->find('first', array(
				'conditions' => array('Phase.mission_id' => $mission_id, 'Phase.id' => $phase_id),
				'contain' => $phase_contain
			));
		}
		//Requested a specific position
		else if (!is_null($phase_position)) {
			$phase = $this->Mission->Phase->find('first', array(
				'conditions' => array('Phase.mission_id' => $mission_id, 'Phase.position' => $phase_position),
				'contain' => $phase_contain
			));
		}
		//Default: phase in the first position
		else {
			$phase = $this->Mission->Phase->find('first', array(
				'conditions' => array('Phase.mission_id' => $mission_id),
				'order' => array('Phase.position' => 'asc'),
				'contain' => $phase_contain
			));
		}

		//---------------------------------
		//FORUM
		$this->loadModel('Optimum.Forum');
		$forum = $this->Forum->find('first', array(
			'contain' => array(
				'ForumFilter' => array(
					'conditions' => array(
						'ForumFilter.model' => 'Phase',
						'ForumFilter.filter_value' => $phase['Phase']['id']
					)
				)
			)
		));

		//---------------------------------
		//GROUP FORUM
		$forum_group = $this->Forum->find('first', array(
			'contain' => array(
				'ForumFilter' => array(
					'conditions' => array(
						'ForumFilter.model' => 'Phase',
						'ForumFilter.filter_value' => $phase['Phase']['id']
					)
				)
			)
		));

		//---------------------------------
		//MARK COMPLETED PHASES //this code can be improved a lot
		//GROUPS
		$myGroups = array();
		$hasGroup = false;
		$this->loadModel('Group');
		$this->loadModel('GroupsUser');

		//Phase evokation - group is created in previous phase
		if ($phase['Phase']['type'] == Phase::TYPE_EVOKATION) {
			$previousPhase = $this->Mission->Phase->getPrevPhase($phase, $phase['Phase']['mission_id']);
			$previousPhaseGroups = $this->Group->find('all', array(
				'conditions' => array('phase_id' => $previousPhase['Phase']['id']),
				'contain' => array(
					'User',
					'GroupsUser' => 'User'
				)
			));

			debug($previousPhaseGroups);

			debug(Set::classicExtract($previousPhaseGroups, '{n}.Group'));

			// Set::combine($a, '{n}.User.id', '{n}.User.Data');

			$phase['Group'] = Set::classicExtract($previousPhaseGroups, '{n}.Group');
		}
		debug($phase['Group']);

		//check to see if user has created/joined a group in this phase of this mission
		//it should be just one
		foreach ($phase['Group'] as &$group) {
			//MEMBERSHIP
			$group['is_owner'] = $this->Group->isOwner($group['id'], $user['id']);
			$group['is_member'] = $this->Group->isMember($group['id'], $user['id']);

			//IS OWNER OR MEMBER
			if ($group['is_owner'] || $group['is_member']) {
				$hasGroup = true;

				//GROUP REQUESTS
				$group['requests_pending'] = $this->Group->GroupRequest->find('all', array('conditions' => array('GroupRequest.group_id' => $group['id'], 'GroupRequest.status = 0')));

				$group['requests'] = $this->Group->GroupRequest->find('all', array('conditions' => array('GroupRequest.group_id' => $group['id'], 'GroupRequest.status' => array(1, 2))));

				array_push($myGroups, $group);
			}
		}

		//ANSWERS
		$this->loadModel('UserAnswer');
		$previous_answers = $this->UserAnswer->find('all', array(
			'conditions' => array(
				'user_id' => $this->user['id']
			)
		));

		//COMPLETED MANDATORY QUESTS
		$this->loadModel('Evidence');

		$i = 0;
		foreach ($mission['Phase'] as $p) {
			//MANDATORY IN THIS PHASE
			$all_mandatory_quests = array();
			$completed_quests = 0;

			foreach ($p['Quest'] as $q) {
				//WHETHER THE USER HAS COMPLETED THE QUEST OR NOT
				$done = $this->Mission->Phase->Quest->hasCompleted($this->user['id'], $q['id']);
				if($done) {
					$completed_quests++;
				}
			}

			//PHASE COMPLETED IF ALL MANDATORY QUESTS ARE COMPLETED
			$mission['Phase'][$i]['completed'] = false;
			if ($completed_quests >= count($all_mandatory_quests)) {
				$mission['Phase'][$i]['completed'] = true;
			}

			$i++;
		}

		//GRAPHIC NOVEL
		$novels = $this->Mission->Novel->find('all', array(
			'order' => array(
				'Novel.page Asc'
			),
			'conditions' => array(
				'Novel.mission_id' => $mission_id,
				'Novel.language' => 'en'
			)
		));

		//FACEBOOK SHARE
		$facebook = new Facebook(array(
			'appId' => Configure::read('fb_app_id'),
			'secret' => Configure::read('fb_app_secret'),
			'allowSignedRequest' => false
		));

		$this->set(compact('mission', 'phase', 'myGroups', 'forum', 'novels', 'user', 'facebook'));
	}


/**
 * View the missions that are open to everybody as examples before they register (can't see some content, can't submit evidences etc.)
 * @param int $id - Optional ID to see a specific mission
 */
	public function view_sample($id = null) {
		$user = $this->Auth->user();

		//MISSION -> PHASES
		$mission = $this->Mission->find('first', array(
			'conditions' => array('Mission.id' => $id),
			'contain' => array(
				'Phase' => array('order' => array('Phase.position' => 'asc'))
			)
		));

		//FIRST PHASE
		$phase = $this->Mission->Phase->find('first', array(
			'conditions' => array('Phase.mission_id' => $id),
			'order' => array('Phase.position' => 'asc'),
			'contain' => 'Quest'
		));

		//GRAPHIC NOVELS
		$novels = $this->Mission->Novel->find('all', array(
			'order' => array(
				'Novel.page Asc'
			),
			'conditions' => array(
				'Novel.mission_id' => $id,
				'Novel.language' => 'en'
			)
		));

		$this->set(compact('mission', 'phase', 'novels', 'user'));
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

		$lang = $this->getCurrentLanguage();
		$flags['_en'] = true;
		$flags['_es'] = false;
		if($lang=='es') {
			$flags['_en'] = false;
			$flags['_es'] = true;
		}

		$this->loadModel('User');
		$user = $this->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$quests = $this->Mission->Quest->find('all', array('conditions' => array('Quest.mission_id' => $id)));

		$my_quests_id = array();
		$my_quests_id2 = array();
		$k = 0;
		foreach ($quests as $q => $quest) {
			if($flags['_es']) {
				$quests[$q]['Quest']['title'] = $quest['Quest']['title_es'];
				$quests[$q]['Quest']['description'] = $quest['Quest']['description_es'];
			}
			
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
		

		$mission = $this->Mission->find('first', $options);

		if($flags['_es']) {
			$mission['Mission']['title'] = $mission['Mission']['title_es'];
			$mission['Mission']['description'] = $mission['Mission']['description_es'];

		}

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
	}
}