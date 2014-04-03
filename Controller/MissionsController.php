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
			$this->Session->setFlash(__("You don't have permission to access this area. If needed, contact the administrator."));	
			$this->redirect($this->referer());
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
	public function view($id = null, $phase_number = null) {
		if (!$this->Mission->exists($id)) {
			throw new NotFoundException(__('Invalid mission'));
		}

		$missionPhases = $this->Mission->Phase->find('all', array('conditions' => array('Phase.mission_id' => $id), 'order' => 'Phase.position'));

		if($phase_number > count($missionPhases)) {
			$this->Session->setFlash(__("This mission/phase does not exist!"));
			$this->redirect($this->referer());
		}

		$missionPhase = $this->Mission->Phase->find('first', array('conditions' => array('Phase.mission_id' => $id, 'Phase.position' => $phase_number)));
		$nextMP = $this->Mission->Phase->getNextPhase($missionPhase, $id);
		$prevMP = $this->Mission->Phase->getPrevPhase($missionPhase, $id);

		$this->loadModel('User');

		$user = $this->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		//$evidences = $this->Mission->getEvidences($id);

		$evidences = $this->Mission->Evidence->find('all', array('order' => array('Evidence.created DESC')));
		//debug($evidence);

		$this->loadModel('Evokation');
		$evokations = $this->Evokation->find('all', array('order' => array('Evokation.created DESC')));

		$mission = $this->Mission->find('first', array('conditions' => array('Mission.' . $this->Mission->primaryKey => $id)));
		$missionIssues = $this->Mission->getMissionIssues($id);
		$quests = $this->Mission->Quest->find('all', array('conditions' => array('Quest.mission_id' => $id, 'Quest.phase_id' => $missionPhase['Phase']['id'])));

		$hasGroup = false;
		//check to see if user has entered a group of this mission..
		foreach ($mission['Group'] as $group) {
			if($group['user_id'] == $this->getUserId()) {
				$hasGroup = true;
				break;
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
					break;
				}
			}
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

		$users = $this->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$this->set(compact('user', 'evidences', 'evokations', 'quests', 'mission', 'missionIssues', 'phase_number', 'missionPhases', 'missionPhase', 'nextMP', 'prevMP', 
			'questionnaires', 'answers', 'previous_answers', 'attachments', 'my_evidences', 'users', 'organized_by', 'mission_img', 'dossier_files', 'hasGroup'));

		if($missionPhase['Phase']['type'] == 0)
			$this->render('view_discussion');
		else
			$this->render('view_project');

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
