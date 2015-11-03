<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

/**
 * Evidences Controller
 *
 * @property Evidence $Evidence
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class EvidencesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	public $user = null;

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('view','add');
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Evidence->exists($id)) {
			throw new NotFoundException(__('Invalid evidence'));
		}

		//AJAX LOAD
		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
		}

		$evidence = $this->Evidence->find('first', array(
			'contain' => array(
				'Mission' => array('fields' => 'id', 'title'),
				'Phase' => array('fields' => 'name', 'position'),
				'Quest' => array('fields' => 'id', 'title', 'title_es', 'description', 'description_es'),
				'User'),
			'conditions' => array('Evidence.' . $this->Evidence->primaryKey => $id)
		));

		$this->loadModel("Attachment");
		$attachments = $this->Attachment->find('all', array(
			'conditions' => array(
				'Attachment.model' => 'Evidence',
				'Attachment.foreign_key' => $id,
				'Attachment.dir !=' => null
			)
		));

		//LANGUAGES
		$lang = $this->getCurrentLanguage();
		$flags['_en'] = true;
		$flags['_es'] = false;
		if($lang=='es') {
			$flags['_en'] = false;
			$flags['_es'] = true;

			$evidence['Mission']['title'] = $evidence['Mission']['title_es'];
			$evidence['Quest']['title'] = $evidence['Quest']['title_es'];
			$evidence['Quest']['description'] = $evidence['Quest']['description_es'];
		}

		//COMMENT
		$this->loadModel("Comment");
		$comments = $this->Comment->find('all', array(
			'contain' => 'User',
			'conditions' => array('Comment.evidence_id' => $id)
		));

		//LIKES
		$like = $this->Evidence->Like->find('first', array('conditions' => array('Like.evidence_id' => $id, 'Like.user_id' => $this->getUserId()))); //LIKE OF THIS USER
		$likes = $this->Evidence->Like->find('all', array('conditions' => array('Like.evidence_id' => $id))); //ALL LIKES

		//FACEBOOK SHARE
		$facebook = new Facebook(array(
			'appId' => Configure::read('fb_app_id'),
			'secret' => Configure::read('fb_app_secret'),
			'allowSignedRequest' => false
		));

		$this->set(compact('ajax', 'evidence', 'comments', 'like', 'likes', 'attachments', 'facebook'));
	}

/**
 * Receive evidence data via post and creates it in the database
 * @return redirect to view the evidence created
 */
public function addEvidence() {
	$this->autoRender = false;
	$this->autoLayout = false;
	//debug("ADD EVIDENCE");
	if(!empty($this->request->data['evidenceLink'])){
		$this->request->data['Evidence']['main_content'] = $this->request->data['evidenceLink'];
	}
	
	if ($this->request->is('post')) {
		$this->Evidence->create();

		//CREATE EVIDENCE IN THE DB AND REDIRECT TO VIEW IT
		if ($this->Evidence->save($this->request->data)) {
			$json_data = array('user_id' => $this->request->data['Evidence']['user_id'], 'mission_id' => $this->request->data['Evidence']['mission_id'], 'evidence_id' => $this->Evidence->id);
			//return json_encode($json_data);
			return $this->redirect($this->referer());
		} else {
			$this->Session->setFlash(__('The evidence could not be saved. Please, try again.'));
		}
	}
}

/**
 * Renders add view (form to add an evidence)
 * @return void
 */
	public function add($mission_id, $phase_id, $quest_id = null, $evokation_id = null) {
		//AJAX LOAD EVIDENCE FORM
		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
		}

		//LOAD QUEST
		$this->loadModel("Quest");
		if ($quest_id != null) {
			$quest = $this->Quest->findById($quest_id);
		}

		//EVOKATION
		$evokation_part = false;
		if (!is_null($evokation_id)) {
			$evokation_part = true;
		}

		$evidence_type = null;
		$evidence_main_content = null;

		$this->set(compact('evidence_type', 'mission_id', 'phase_id', 'quest_id', 'quest', 'evokation_id', 'evokation_part'));
	}
/**
 * Renders add_evokation_part_act view (form to add an evidence)
 * @return void
 */
	public function add_evokation_part_act($mission_id, $phase_id, $quest_id, $evokation_id = null) {
		//AJAX LOAD EVIDENCE FORM
		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
		}


		$thisEvokation = $this->Evidence->find('first', array(
			'conditions' => array(
				'mission_id'   => $mission_id,
				'phase_id'     => $phase_id,
				'quest_id'	   => $quest_id,
				'evokation_id' => $evokation_id
			)
		));
		// IF THIS EVIDENCE HAS ALREADY BEEN SUBMITTED
		if(count($thisEvokation)){
			$this->request->data['Evidence'] = $thisEvokation['Evidence'];
		}// }else{
		// 	// CREATE THE EVIDENCE REGARDLESS THE USER FILL ANY FIELD
		// 	$this->Evidence->create();

		// 	$this->request->data = array(
		// 		'Evidence' => array(
		// 			'mission_id'      => $mission_id,
		// 			'phase_id'        => $phase_id,
		// 			'quest_id'	      => $quest_id,
		// 			'user_id'	      => $this->Auth->user()['id'],
		// 			'main_content'    => '',
		// 			'type'		      => '',
		// 			'title'		      => '',
		// 			'content'		  => '',
		// 			'evokation_id'	  => $evokation_id,
		// 			'editing_user_id' => $this->Auth->user()['id']
		// 		)
		// 	);

		// 	$this->Evidence->save($this->request->data);

		// 	$this->request->data['Evidence']['id'] = $this->Evidence->id;
		// }

		//LOAD QUEST
		$this->loadModel("Quest");

		$quest = $this->Quest->findById($quest_id);

		$act_phase_id = $quest['Quest']['phase_id'];

		//EVOKATION
		$evokation_part = false;
		if (!is_null($evokation_id)) {
			$evokation_part = true;
		}

		$evidence_type = null;
		$evidence_main_content = null;

		$user_id = $this->Auth->user()['id'];

		$act_evidences = $this->Evidence->getGroupEvidences($user_id, $quest_id, $act_phase_id);

		$this->set(compact('evidence_type', 'mission_id', 'phase_id', 'quest_id', 'quest', 'evokation_id', 'evokation_part', 'act_evidences'));
	}

/**
 * Renders add_evokation_part_pure view (form to add an evidence)
 * @return void
 */
	public function add_evokation_part_pure($mission_id, $phase_id, $quest_id, $evokation_id = null) {
		//AJAX LOAD EVIDENCE FORM
		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
		}

		$thisEvokation = $this->Evidence->find('first', array(
			'conditions' => array(
				'mission_id'   => $mission_id,
				'phase_id'     => $phase_id,
				'quest_id'	   => $quest_id,
				'evokation_id' => $evokation_id
			)
		));

		// IF THIS EVIDENCE HAS ALREADY BEEN SUBMITTED
		if(count($thisEvokation)){
			$this->request->data['Evidence'] = $thisEvokation['Evidence'];
			$this->Evidence->save(array('Evidence' => array(
				'editing_user_id' => $this->Auth->user()['id']
			)));
		}// }else{
		// 	// CREATE THE EVIDENCE REGARDLESS THE USER FILL ANY FIELD
		// 	$this->Evidence->create();

		// 	$this->request->data = array(
		// 		'Evidence' => array(
		// 			'mission_id'      => $mission_id,
		// 			'phase_id'        => $phase_id,
		// 			'quest_id'	      => $quest_id,
		// 			'user_id'	      => $this->Auth->user()['id'],
		// 			'main_content'    => '',
		// 			'type'		      => '',
		// 			'title'		      => '',
		// 			'content'		  => '',
		// 			'evokation_id'	  => $evokation_id,
		// 			'editing_user_id' => $this->Auth->user()['id']
		// 		)
		// 	);

		// 	$this->Evidence->save($this->request->data);

		// 	$this->request->data['Evidence']['id'] = $this->Evidence->id;
		// }

		//LOAD QUEST
		$this->loadModel("Quest");

		$quest = $this->Quest->findById($quest_id);

		$act_phase_id = $quest['Quest']['phase_id'];

		//EVOKATION
		$evokation_part = false;
		if (!is_null($evokation_id)) {
			$evokation_part = true;
		}

		$evidence_type = null;
		$evidence_main_content = null;

		//$user_id = $this->Auth->user()['id'];
		// $act_evidences = $this->Evidence->getGroupEvidences($user_id, $quest_id, $act_phase_id);

		$this->set(compact('evidence_type', 'mission_id', 'phase_id', 'quest_id', 'quest', 'evokation_id', 'evokation_part'));
		//, 'act_evidences'));
	}

	public function preview_evokation($evokation_id, $mission_id, $phase_id = null){

		$evokation_parts = $this->Evidence->getEvokationParts($evokation_id);
		

		$this->loadModel("Quest");
		$this->loadModel("Mission");

		//TRANSLATION
		$lang = $this->getCurrentLanguage();
		if ($lang == 'es') {
			$lang = 'title_es';
		}else{
			$lang = 'title';
		}

		$mission_title = $this->Mission->find('first', array(
			'conditions' => array('id' => $mission_id),
			'fields'	 => array('title', 'title_es')
		))['Mission'][$lang];

		$quests = $this->Quest->find('evokePhase', array(
		 		'conditions' => array('mission_id' => $mission_id)
		));

		$this->set(compact('evokation_parts', 'quests', 'phase_id', 'evokation_id', 'mission_title'));
	}

/**
 * Receive evidence data via post and update it in the database
 * @return redirect to view the evidence created
 */
public function editEvidence() {
	$this->autoRender = false;
	debug("EDIT EVIDENCE");
	if ($this->request->is('post') || $this->request->is('put')) {
		//UPDATE EVIDENCE IN THE DB AND REDIRECT TO VIEW IT
		if ($this->Evidence->save($this->request->data)) {
			return true;
		} else {
			$this->Session->setFlash(__('The evidence could not be saved. Please, try again.'));
			return false;
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
	public function edit($id = null, $ajax = false) {
		//AJAX LOAD EVIDENCE FORM
		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
		}

		//VIEWING PAGE TO EDIT
		$evidence = $this->Evidence->findById($id);

		$evidence_type = $evidence['Evidence']['type'];
		$evidence_main_content = $evidence['Evidence']['main_content'];

		$mission_id = $evidence['Evidence']['mission_id'];
		$phase_id = $evidence['Evidence']['phase_id'];
		$quest_id = $evidence['Evidence']['quest_id'];
		$evokation_id = $evidence['Evidence']['evokation_id'];

		//LOAD QUEST
		$this->loadModel("Quest");
		if ($quest_id != null) {
			$quest = $this->Quest->findById($quest_id);
		}

		//EVOKATION
		$evokation_part = false;
		if (!is_null($evokation_id)) {
			$evokation_part = true;
		}

		$this->set(compact('evidence', 'evidence_type', 'evidence_main_content', 'mission_id', 'phase_id', 'quest_id', 'quest', 'evokation_id', 'evokation_part'));
	}


/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null, $ajax = false) {
		$this->autoRender = false;
		
		$this->Evidence->id = $id;
		if (!$this->Evidence->exists()) {
			throw new NotFoundException(__('Invalid evidence'));
		}

		if ($this->Evidence->delete()) {
			$this->Session->setFlash(__('The evidence has been deleted.'));
			if (!$ajax) {
				$user = $this->Auth->user();
				return $this->redirect(array('controller' => 'users', 'action' => 'profile', $user['id']));
			}
			return true;
		} else {
			if (!$ajax) {
				$this->Session->setFlash(__('The evidence could not be deleted. Please, try again.'));
			}
			return false;
		}
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->autoRender = false;
		if ($this->request->is('post')) {
			$this->Evidence->create();
			if ($this->Evidence->save($this->request->data)) {
				$this->Session->setFlash(__('The evidence has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evidence could not be saved. Please, try again.'));
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
		if (!$this->Evidence->exists($id)) {
			throw new NotFoundException(__('Invalid evidence'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Evidence->save($this->request->data)) {
				$this->Session->setFlash(__('The evidence has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evidence could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Evidence.' . $this->Evidence->primaryKey => $id));
			$this->request->data = $this->Evidence->find('first', $options);
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
		$this->Evidence->id = $id;
		if (!$this->Evidence->exists()) {
			throw new NotFoundException(__('Invalid evidence'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Evidence->delete()) {
			$this->Session->setFlash(__('The evidence has been deleted.'));
		} else {
			$this->Session->setFlash(__('The evidence could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
