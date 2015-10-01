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

	//public $helpers = array('Media.Media');

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('view','add');
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Evidence->recursive = 0;
		$this->set('evidences', $this->Paginator->paginate());
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
	if ($this->request->is('post')) {
		$this->Evidence->create();

		// debug($this->request->data);
		// debug($_POST);
		// return json_encode($_POST);

		//CREATE EVIDENCE IN THE DB AND REDIRECT TO VIEW IT
		if ($this->Evidence->save($this->request->data)) {
			$json_data = array('user_id' => $this->request->data['Evidence']['user_id'], 'mission_id' => $this->request->data['Evidence']['mission_id'], 'evidence_id' => $this->Evidence->id);
			// debug($this->request->data);
			// debug($_POST);
			return json_encode($json_data);
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

		debug($mission_id, $phase_id, $quest_id);

		$thisEvokation = $this->Evidence->find('first', array(
			'conditions' => array(
				'mission_id'   => $mission_id,
				'phase_id'     => $phase_id,
				'quest_id'	   => $quest_id,
				'evokation_id' => $evokation_id
			)
		));
		// IF THIS EVIDENCE HAS ALREADY BEEN SUBMITTED
		//debug($thisEvokation);
		if(count($thisEvokation)){
			$this->request->data['Evidence'] = $thisEvokation['Evidence'];
		}
		//debug($this->request->data['Evidence']);
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

		$act_evidences = $this->Evidence->getGroupEvidences($user_id, $quest_id, $act_phase_id);

		$this->set(compact('evidence_type', 'mission_id', 'phase_id', 'quest_id', 'quest', 'evokation_id', 'evokation_part', 'act_evidences'));
	}

	public function preview_evokation($evokation_id, $mission_id){
		
		debug($mission_id);
		$evokation_parts = $this->Evidence->getEvokationParts($evokation_id);
		

		$this->loadModel("Quest");

		//debug($evokation_parts[0]['Evidence']['mission_id']);

		$quests = $this->Quest->find('evokePhase', array(
		 		'conditions' => array('mission_id' => $mission_id)
		));

		//print_r($quests);

		$this->set(compact('evokation_parts', 'quests'));
	}

/**
 * Receive evidence data via post and update it in the database
 * @return redirect to view the evidence created
 */
public function editEvidence() {
	if ($this->request->is('post')) {
		//UPDATE EVIDENCE IN THE DB AND REDIRECT TO VIEW IT
		if ($this->Evidence->save($this->request->data)) {
			return $this->redirect(array(
				'header' => $this->request->header,
				'action' => 'view',
				$this->Evidence->id
			));
		} else {
			$this->Session->setFlash(__('The evidence could not be saved. Please, try again.'));
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

	public function destroyAttachments($data){
		//iterate received array and check if attachment is meant to desapear
		foreach ($data as $d) {
			if(!strpos($d['id'], 'NO-')) {
				//good to go, lets erase it..
				$this->loadModel('Attachment');
				$this->Attachment->id = $d['id'];
				$a['Attachment']['model'] = null;
				$a['Attachment']['foreign_key'] = null;
				if ($this->Attachment->save($a)) {
					$this->Session->setFlash(__('The attachment has been deleted.'));
				} else {
					$this->Session->setFlash(__('The attachment could not be deleted. Please, try again.'));
				}
			}
		}
	}

	/**
	 * Verifica se o diretório existe, se não ele cria.
	 * @access public
	 * @param Array $imagem
	 * @param String $data
	*/
	public function checa_dir($dir)
	{
		$folder = new Folder();
		if (!is_dir($dir)){
			$folder->create($dir);
		}
	}

	/**
	 * Verifica se o nome do arquivo já existe, se existir adiciona um numero ao nome e verifica novamente
	 * @access public
	 * @param Array $imagem
	 * @param String $data
	 * @return nome da imagem
	*/
	public function checa_nome($imagem, $dir)
	{
		$imagem_info = pathinfo($dir.$imagem['name']);
		$imagem_nome = $this->trata_nome($imagem_info['filename']).'.'.$imagem_info['extension'];
		debug($imagem_nome);
		$conta = 2;
		while (file_exists($dir.$imagem_nome)) {
			$imagem_nome  = $this->trata_nome($imagem_info['filename']).'-'.$conta;
			$imagem_nome .= '.'.$imagem_info['extension'];
			$conta++;
			debug($imagem_nome);
		}
		$imagem['name'] = $imagem_nome;
		return $imagem;
	}

	/**
	 * Trata o nome removendo espaços, acentos e caracteres em maiúsculo.
	 * @access public
	 * @param Array $imagem
	 * @param String $data
	*/
	public function trata_nome($imagem_nome)
	{
		$imagem_nome = strtolower(Inflector::slug($imagem_nome,'-'));
		return $imagem_nome;
	}

	/**
	 * Move o arquivo para a pasta de destino.
	 * @access public
	 * @param Array $imagem
	 * @param String $data
	*/
	public function move_arquivos($imagem, $dir)
	{
		$arquivo = new File($imagem['tmp_name']);
		$arquivo->copy($dir.$imagem['name']);
		$arquivo->close();
	}

/**
 * upload method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function uploadPicMedium($id = null) {

		$this->layout = false;
		$this->autoRender = false;

		$img = $_FILES['file'];

		$dir = WWW_ROOT . 'files' . DS . 'attachment' . DS . 'attachment' . DS . 'medium' . DS;

		if(($img['error']!=0) and ($img['size']==0)) {
			throw new NotImplementedException('Something went wrong. Error '.$img['error'].' Size: '.$img['size']);
		}

		// $this->checa_dir($dir);

		$folder = new Folder();

		if (!is_dir($dir)){
			$folder->create($dir);
		}

		// $img = $this->checa_nome($img, $dir);

		$img_info = pathinfo($dir.$img['name']);
		$img_nome = $this->trata_nome($img_info['filename']).'.'.$img_info['extension'];
		//debug($img_nome);
		$counter = 2;

		while (file_exists($dir.$img_nome)) {
			$img_nome  = $this->trata_nome($img_info['filename']).'-'.$counter;
			$img_nome .= '.'.$img_info['extension'];
			$counter++;
			//debug($img_nome);
		}

		$img['name'] = $img_nome;

		// $this->move_arquivos($img, $dir);

		$file = new File($img['tmp_name']);
		$file->copy($dir . $img['name']);
		$file->close();

		// debug($dir. $img['name']);
		//echo $dir. $img['name'];
		echo $this->webroot . 'webroot' . DS . 'files' . DS . 'attachment' . DS . 'attachment' . DS . 'medium' . DS . $img['name'];

	}

/**
 * upload method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function deletePicMedium() {

		// debug($_POST['file']['name']);
		// debug($_POST['name']);

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
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Evidence->recursive = 0;
		$this->set('evidences', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Evidence->exists($id)) {
			throw new NotFoundException(__('Invalid evidence'));
		}
		$options = array('conditions' => array('Evidence.' . $this->Evidence->primaryKey => $id));
		$this->set('evidence', $this->Evidence->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Evidence->create();
			if ($this->Evidence->save($this->request->data)) {
				$this->Session->setFlash(__('The evidence has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evidence could not be saved. Please, try again.'));
			}
		}
		$users = $this->Evidence->User->find('list');
		$quests = $this->Evidence->Quest->find('list');
		$missions = $this->Evidence->Mission->find('list');
		$phases = $this->Evidence->Phase->find('list');
		$this->set(compact('users', 'quests', 'missions', 'phases'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
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
		$users = $this->Evidence->User->find('list');
		$quests = $this->Evidence->Quest->find('list');
		$missions = $this->Evidence->Mission->find('list');
		$phases = $this->Evidence->Phase->find('list');
		$this->set(compact('users', 'quests', 'missions', 'phases'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
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
