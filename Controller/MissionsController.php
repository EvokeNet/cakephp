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
  // public $helpers = array('BrainstormSession.Brainstorm' => array('unavailable_content_hidden' => true));
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
    //$this->move_basic_training_to_front($missions);

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
}
