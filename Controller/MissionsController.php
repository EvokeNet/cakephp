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

    $this->Auth->allow('view_sample');
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

    $missions = $this->Mission->find('all');

    // move basic training to the front if it's not already there
    $this->move_basic_training_to_front($missions);

    foreach ($missions as $m => $mission) {
      if($flags['_es']) {
        $missions[$m]['Mission']['title'] = $mission['Mission']['title_es'];
        $missions[$m]['Mission']['description'] = $mission['Mission']['description_es'];
      }
    }

    $this->loadModel('User');

    $user = $this->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

    $missionIssues = $this->Mission->MissionIssue->find('all', array('order' => 'MissionIssue.issue_id'));

    $this->loadModel('Issue');
    $issues = $this->Issue->find('all');

    $this->set(compact('missions', 'user', 'missionIssues', 'issues', 'basic_training'));
  }

/**
 * Renders panels main content
 * @param int $mission_id - ID of the current mission
 */
  public function renderPanelsMainContent($mission_id = null) {
    if (!$this->Mission->exists($mission_id)) {
      throw new NotFoundException(__('Invalid mission'));
    }

    $mission = $this->Mission->find('first', array(
      'conditions' => array('Mission.id' => $mission_id),
      'contain' => array('Group', 'Phase')
    ));

    $user = $this->Auth->user();

    //COMPLETED PHASE
    $i = 0;
    foreach ($mission['Phase'] as $p) {
      $mission['Phase'][$i]['completed'] = $this->Mission->Phase->hasCompleted($this->user['id'],$p['id']);
      $i++;
    }

    //CURRENTLY DISPLAYING PHASE (determined in the view actions)
    $phase = $this->Session->read('displayedPhase');

    //GROUPS
    $myGroups = array();
    $this->loadModel('Group');

    //check to see if user has created/joined a group in this mission
    //it should be just one
    foreach ($mission['Group'] as &$group) {
      //MEMBERSHIP
      $group['is_owner'] = $this->Group->isOwner($group['id'], $user['id']);
      $group['is_member'] = $this->Group->isMember($group['id'], $user['id']);

      //IS OWNER OR MEMBER
      if ($group['is_owner'] || $group['is_member']) {
        $hasGroup = true;

        //GROUP LEADER, MEMBERS, REQUESTS, and EVOKATIONS/EVIDENCES
        $group_details = $this->Group->find('first',array(
          'conditions' => array('Group.id' => $group['id']),
          'contain' => array(
            'Leader',
            'Member',
            'GroupRequestsPending' => 'User',
            'GroupRequestsDone' => 'User',
            'Evokation' => 'Evidence'
          )
        ));
        $group['Leader'] = $group_details['Leader'];
        $group['Member'] = $group_details['Member'];
        $group['GroupRequestsPending'] = $group_details['GroupRequestsPending'];
        $group['GroupRequestsDone'] = $group_details['GroupRequestsDone'];
        $group['Evokation'] = $group_details['Evokation'];

        array_push($myGroups, $group);
      }
    }

    //TRANSLATION
    $lang = $this->getCurrentLanguage();

    if ($lang == 'es') {
      //Mission
      $mission['Mission']['title'] = $mission['Mission']['title_es'];
      $mission['Mission']['description'] = $mission['Mission']['description_es'];

      //All phases
      foreach ($mission['Phase'] as &$mission_phase) {
        $mission_phase['name'] = $mission_phase['name_es'];
        $mission_phase['description'] = $mission_phase['description_es'];
      }
    }

    //Render
    $this->set(compact('phase','mission','myGroups','evokationQuests'));
    $this->layout = 'ajax';
    $this->render('/Elements/Missions/panels_main_content');
  }

/**
 * Renders the quests for the evokaiton part
 * @param int $phase_id - ID of the phase
 * @param int $mission_id - ID of the mission
 */
  public function renderEvokationQuests($phase_id = null, $mission_id, $evokation_id) {
    if (!$this->Mission->Phase->exists($phase_id)) {
      throw new NotFoundException(__('Invalid mission phase'));
    }

    $this->loadModel('Quest');
    $this->loadModel('Evidence');
    $this->loadModel('Evokation');
    //evokePhase is a custom find type to retrieve just the quests to be displayed in the Evoke phase
    $evokationQuests = $this->Quest->find('evokePhase',array(
      'conditions' => array('mission_id' => $mission_id)
    ));

    foreach ($evokationQuests as $key => &$eq) {
      $user_id  = $this->Auth->user()['id'];
      $quest_id = $eq['Quest']['id'];

      $eq['status'] = $this->Quest->getStatus($user_id, $quest_id, $phase_id);
    }

    $user_id  = $this->Auth->user()['id'];

      $evk_parts = $this->Evidence->find('all', array(
        'conditions' => array(
          'user_id' 	   => $user_id,
          'evokation_id' => $evokation_id
        )
      ));

      $sent = $this->Evokation->find('first', array(
        'conditions' => array(
          'id' => $evokation_id
        ),
        'fields' => array(
          'final_sent'
        )
      ))['Evokation']['final_sent'];

      $toRender = '/Elements/Missions/evokation_quests';
      // If this evokation has already been sent
      if($sent){
        $toRender = '/Elements/Missions/evokation_sent';
      }

    // flag to check if this user has subimitted all evokation parts for this mission
    $done = count($evk_parts) == count($evokationQuests);

    //Render
    $this->set(compact('phase_id', 'evokationQuests', 'evokation_id', 'done'));
    $this->layout = 'ajax';
    $this->render($toRender);

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

    $lang = $this->getCurrentLanguage();

    $this->loadModel('Phase');
    $this->loadModel('Quest');
    $this->loadModel('Group');
    $this->loadModel('User');

    //PHASE
    $phase = $this->Phase->find('first', array(
      'conditions' => array('Phase.id' => $phase_id),
      'contain' => array('Quest' => 'Group')
    ));

    foreach ($phase['Quest'] as $key => &$quest) {
      //TRANSLATION
      if ($lang == 'es') {
        $quest['title'] = $quest['title_es'];
        $quest['description'] = $quest['description_es'];
      }

      //WHETHER THE USER HAS COMPLETED THE QUEST OR NOT
      $quest['has_completed'] = $this->Quest->hasCompleted($this->user['id'], $quest['id']);

      //RESPONSE (if completed)
      if ($quest['has_completed']) {
        $quest['Response'] = $this->Quest->getQuestResponse($this->user['id'], $quest['id']);

        //GROUP -- CHECK IF THE USER IS MEMBER/OWNER /
        if ($quest['type'] == Quest::TYPE_GROUP_CREATION) {
          $quest['Response']['Group']['is_owner'] = $this->Group->isOwner($quest['Response']['Group']['id'], $user['id']);
          $quest['Response']['Group']['is_member'] = $this->Group->isMember($quest['Response']['Group']['id'], $user['id']);
        }
      }

      //GROUP -- CHECK IF THE USER SENT REQUESTS
      if ($quest['type'] == Quest::TYPE_GROUP_CREATION) {
        $quest['GroupRequestsPending'] = $this->Group->GroupRequest->findAllByUserIdAndStatus($user['id'],0);
      }

      //GROUP -- CHECK IF THE USER IS MEMBER/OWNER
      foreach ($quest['Group'] as $group_key => &$group) { //group belongs to the quest it was created in
        $group['is_owner'] = $this->Group->isOwner($group['id'], $user['id']);
        $group['is_member'] = $this->Group->isMember($group['id'], $user['id']);

        //BRAINSTORM TIMELINE
        //Members of the group see the brainstorm timeline for all the quests of the phase
        if ($group['is_member']) {
          foreach ($phase['Quest'] as $key2 => &$phase_quest) {
            if ($phase_quest['type'] == Quest::TYPE_BRAINSTORM) {
              $phase_quest['Timeline'] = $this->Group->findTimelineByGroupAndQuest($group['id'],$phase_quest['id']);
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
    if ($this->params->query['mission_id'] && is_null($mission_id)) {
      $mission_id = $this->params->query['mission_id'];
    }
    if ($this->params->query['limit'] && is_null($limit)) {
      $limit = $this->params->query['limit'];
    }

    $dossier_query_params = array();
    $lang = $this->getCurrentLanguage();

    //FUNCTION PARAMS
    //Dossier from a specific mission
    if (!is_null($mission_id)) {
      $dossier_query_params['conditions'] = array(
        'mission_id' => $mission_id,
        'language' => $lang
      );
    }

    //Limit to the query
    $dossier_query_params['limit'] = $limit;

    //CONTAINABLE MODELS
    $dossier_query_params['contain'] = 'User';

    //RUN DOSSIER QUERY
    $this->loadModel('Dossier');
    $dossier = $this->Dossier->find('first');

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

  public function renderEvokationList(){
    $mission_id = $this->request->query('mission_id');
    $limit      = $this->request->query('limit');
    $offset     = $this->request->query('offset');
    $groups     = $this->getEvokations($mission_id, $offset, $limit);


    //Render
    $this->set(compact('groups'));
    $this->layout = 'ajax';
    $this->render('/Elements/Evokations/evokation_list');
  }


  public function getEvokations($mission_id = null, $offset = null, $limit = null){
    $this->autoRender = false; // We don't render a view

    $evokation_query_params = array();
    $evokation_query_params['conditions'] = array();
    $evokation_query_params['joins'] = array(
      array(
        'table'      => 'evokations',
        'alias'      => 'EvokationJoin',
        'type'       => 'INNER',
        'conditions' => array(
          'EvokationJoin.group_id   = Group.id',
          'EvokationJoin.final_sent = 1'
        )
      )
    );

    if (!is_null($mission_id)) {
      $evokation_query_params['conditions']['mission_id'] = $mission_id;
    }
    if (!is_null($offset)) {
      $evokation_query_params['offset'] = $offset;
    }
    if (!is_null($limit)) {
      $evokation_query_params['limit'] = $limit;
    }
    // get the evokation that each group has sent
    $evokation_query_params['contain'] = 'Evokation';

    $this->loadModel('Group');
    return $this->Group->find('all', $evokation_query_params);
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

  public function moreEvokations(){
    $this->autoRender = false; // We don't render a view

    //QUERY
    $newEvokations = $this->getEvokations(
      $this->request->query('mission_id'),
      $this->request->query('offset'),
      $this->request->query('limit'));

    //GENERATE HTML TO BE RETURNED
    $elementToRender = 'Evokations/evokation_list_item';
    $ind = 'Evokation';

    $newEvokationsHTML = "";

    foreach ($newEvokations as $key => $value) {
      // debug($value);
      $view = new View($this, false);
      $content = ($view->element($elementToRender, array('g' => $value)));

      $newEvokationsHTML .= $content .' ';
    }

    return $newEvokationsHTML;
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

    $lang = $this->getCurrentLanguage();

    //---------------------------------
    //MISSION -> ALL PHASES
    $mission = $this->Mission->find('first', array(
      'conditions' => array('Mission.id' => $mission_id),
      'contain' => array(
        'Phase' => array('Quest' => 'Questionnaire'),
        'Group'
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

    //Session variable for currently displayed phase
    $this->Session->write('displayedPhase', $phase);

    //---------------------------------
    //FORUM
    $this->loadModel('Optimum.Forum');
    $forum = $this->Mission->Phase->findForum($phase['Phase']['id']);

    //---------------------------------
    //GROUPS
    $myGroups = array();
    $hasGroup = false;
    $this->loadModel('Group');
    $this->loadModel('GroupsUser');

    //check to see if user has created/joined a group in this mission
    //it should be just one
    foreach ($mission['Group'] as &$group) {
      //MEMBERSHIP
      $group['is_owner'] = $this->Group->isOwner($group['id'], $user['id']);
      $group['is_member'] = $this->Group->isMember($group['id'], $user['id']);

      //IS OWNER OR MEMBER
      if ($group['is_owner'] || $group['is_member']) {
        $hasGroup = true;

        //GROUP FORUM
        $group['Forum'] = $this->Group->findForum($group['id']);

        //GROUP LEADER, MEMBERS, REQUESTS, and EVOKATIONS/EVIDENCES
        $group_details = $this->Group->find('first',array(
          'conditions' => array('Group.id' => $group['id']),
          'contain' => array(
            'Leader',
            'Member',
            'GroupRequestsPending' => 'User',
            'GroupRequestsDone' => 'User',
            'Evokation' => 'Evidence'
          )
        ));
        $group['Leader'] = $group_details['Leader'];
        $group['Member'] = $group_details['Member'];
        $group['GroupRequestsPending'] = $group_details['GroupRequestsPending'];
        $group['GroupRequestsDone'] = $group_details['GroupRequestsDone'];
        $group['Evokation'] = $group_details['Evokation'];

        array_push($myGroups, $group);
      }
    }

    //---------------------------------
    //ANSWERS
    $this->loadModel('UserAnswer');
    $previous_answers = $this->UserAnswer->find('all', array(
      'conditions' => array(
        'user_id' => $this->user['id']
      )
    ));

    //---------------------------------
    //COMPLETED PHASE
    $i = 0;
    foreach ($mission['Phase'] as $p) {
      $mission['Phase'][$i]['completed'] = $this->Mission->Phase->hasCompleted($this->user['id'],$p['id']);
      $i++;
    }

    //---------------------------------
    //GRAPHIC NOVEL
    $novels = $this->Mission->Novel->find('all', array(
      'order' => array(
        'Novel.page Asc'
      ),
      'conditions' => array(
        'Novel.mission_id' => $mission_id,
        'Novel.language' => $lang
      )
    ));

    //---------------------------------
    //FACEBOOK SHARE
    $facebook = new Facebook(array(
      'appId' => Configure::read('fb_app_id'),
      'secret' => Configure::read('fb_app_secret'),
      'allowSignedRequest' => false
    ));

    //---------------------------------
    //TRANSLATION
    if ($lang == 'es') {
      //debug($mission['Mission']['description']);
      //print_r($mission['Mission']['description_es']);
      //Mission
      $mission['Mission']['title'] = $mission['Mission']['title_es'];
      $mission['Mission']['description'] = $mission['Mission']['description_es'];
      //print_r($mission['Mission']['description']);
      //All phases
      foreach ($mission['Phase'] as &$mission_phase) {
        $mission_phase['name'] = $mission_phase['name_es'];
        $mission_phase['description'] = $mission_phase['description_es'];
      }

      //Current phase
      $phase['Phase']['name'] = $phase['Phase']['name_es'];
      $phase['Phase']['description'] = $phase['Phase']['description_es'];
    }

    $this->set(compact('mission', 'phase', 'myGroups', 'forum', 'novels', 'user', 'facebook', 'evokationQuests'));
  }

/**
 * View the missions that are open to everybody as examples before they register (can't see some content, can't submit evidences etc.)
 * @param int $id - Optional ID to see a specific mission
 */
  public function view_sample($id = null) {
    $user = $this->Auth->user();

    $lang = $this->getCurrentLanguage();

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

    //Session variable for currently displayed phase
    $this->Session->write('displayedPhase', $phase);

    //GRAPHIC NOVELS
    $novels = $this->Mission->Novel->find('all', array(
      'order' => array(
        'Novel.page Asc'
      ),
      'conditions' => array(
        'Novel.mission_id' => $id,
        'Novel.language' => $lang
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
    $this->autoRender = false;

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
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
  public function edit($id = null) {
    $this->autoRender = false;

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
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
  public function delete($id = null) {
    $this->autoRender = false;

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
  }

  public function admin_index() {
    $this->Mission->recursive = 0;
    $this->set('missions', $this->Paginator->paginate());
  }

/**
 * admin_add method
 *
 * @return void
 */
  public function admin_add() {
    $this->autoRender = false;

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
    $this->autoRender = false;

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
    $this->autoRender = false;

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
  }

  /**
   * Moves basic training to the front of the missions array
   * @param  referenced array of objects $missions
   * @return
   */
  private function move_basic_training_to_front(&$missions) {

    if ($missions[0]['Mission']['basic_training'] != 1) {
      $basic_training = [];

      foreach ($missions as $m => $mission) {
        if ($mission['Mission']['basic_training'] == 1) {
          $basic_training = $mission;
          unset($missions[$m]);
        }
      }
      array_unshift($missions, $basic_training);
    }
  }
}
