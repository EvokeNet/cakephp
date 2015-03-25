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
        $this->Auth->allow('view');
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
	if ($this->request->is('post')) {
		debug ($this->request->data);
		die();
		$this->Evidence->create();

		//CREATE EVIDENCE IN THE DB AND REDIRECT TO VIEW IT
		if ($this->Evidence->save($this->request->data)) {
			return $this->redirect(array(
				'header' => $this->request->header, //Use the same header - useful if the requester is ajax
				'action' => 'view', 
				$this->Evidence->id
			));
		} else {
			$this->Session->setFlash(__('The evidence could not be saved. Please, try again.'));
		}
	}
}

/**
 * Renders add view (form to add an evidence)
 * @return void
 */
	public function add($mission_id, $phase_id, $quest_id = null, $evokation = false) {
		//AJAX LOAD EVIDENCE FORM
		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
		}

		//LOAD QUEST
		$this->loadModel("Quest");
		if ($quest_id != null) {
			$quest = $this->Quest->findById($quest_id);
		}

		$this->set(compact('mission_id', 'phase_id', 'quest_id', 'evokation', 'quest'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null, $ajax = false) {
		if (!$this->Evidence->exists($id)) {
			throw new NotFoundException(__('Invalid evidence'));
		}


		$me = $this->Evidence->find('first', array('conditions' => array('Evidence.id' => $id)));

		$myPoints = $this->Evidence->User->Point->find('all', array('conditions' => array('Point.user_id' => $this->getUserId())));

		$sumMyPoints = 0;
		
		foreach($myPoints as $point){
			$sumMyPoints += $point['Point']['value'];
		}

		$this->loadModel('Dossier');
		$this->loadModel('Attachment');

		$dossier = $this->Dossier->find('first', array(
			'conditions' => array(
				'mission_id' => $me['Evidence']['mission_id']
			)
		));

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

		$lang = $this->getCurrentLanguage();
		$flags['_en'] = true;
		$flags['_es'] = false;
		if($lang=='es') {
			$flags['_en'] = false;
			$flags['_es'] = true;
		}

		if($flags['_es'])
			$langs = 'es';
		else
			$langs = 'en';

		$links = $this->Evidence->Mission->DossierLink->find('all', array('conditions' => array('DossierLink.mission_id' => $me['Evidence']['mission_id'], 'DossierLink.language' => $langs)));
		$video_links = $this->Evidence->Mission->DossierVideo->find('all', array('conditions' => array('DossierVideo.mission_id' => $me['Evidence']['mission_id'], 'DossierVideo.language' => $langs)));

		if($me['Evidence']['user_id'] != $this->getUserId()) {
			//debug($me);
			$this->Session->setFlash(__('You have no permission to edit an evidence that does not belong to you.'));
			$this->redirect($this->referer());
		}

		if ($this->request->is(array('post', 'put'))) {
			if ($this->Evidence->createWithAttachments($this->request->data, true, $id)) {
				
				//check to see if there are img/files that are no loner to be related to the quest...
				if(isset($this->request->data['Attachment']['Old'])) {
					$this->destroyAttachments($this->request->data['Attachment']['Old']);
				}

				//$this->Session->setFlash(__('The evidence has been saved.'));

				/* Starts event */
				$value = 1;
				$origin = 'evidence';

				if($me['Evidence']['evokation'] == 1)
					$origin = 'evidenceEvokation';

		        $quest = $this->Evidence->Quest->find('first', array(
		        	'conditions' => array(
		        		'Quest.id' => $me['Evidence']['quest_id'])));

		        if($quest)
		            $value = $quest['Quest']['points'];

		        $event = new CakeEvent('Controller.Evidence.create', $this, array(
		        	'user_id' => $me['Evidence']['user_id'], 
		            'origin_id' => $me['Evidence']['id'], 
		            'origin' => $origin, 
		        	'points' => $value,
		        ));

		        $this->getEventManager()->dispatch($event);

		        //////////////////COMENTADO PELA GABI///////////////
		  //       //attribute pp to this user if hasnt won from this very evidence:
				// $this->loadModel('UserPowerPoint');
				// $hasWonPowerPointsFromThis = $this->UserPowerPoint->find('first', array(
				// 	'conditions' => array(
				// 		'UserPowerPoint.user_id' => $this->getUserId(),
				// 		'UserPowerPoint.model' => 'Evidence',
				// 		'UserPowerPoint.foreign_key' => $me['Evidence']['id']
				// 	)
				// ));

				// if(empty($hasWonPowerPointsFromThis)) {

				// 	$this->loadModel('QuestPowerPoint');
				// 	$pps = $this->QuestPowerPoint->find('all', array(
				// 		'conditions' => array(
				// 			'quest_id' => $me['Evidence']['quest_id']
				// 		)
				// 	));

				// 	foreach($pps as $pp) {
				// 		$data['UserPowerPoint']['user_id'] = $me['Evidence']['user_id'];
				// 		$data['UserPowerPoint']['power_points_id'] = $pp['QuestPowerPoint']['power_points_id'];
				// 		$data['UserPowerPoint']['quest_id'] = $pp['QuestPowerPoint']['quest_id'];
				// 		$data['UserPowerPoint']['quantity'] = ($pp['QuestPowerPoint']['quantity'] * 30);
				// 		$data['UserPowerPoint']['model'] = 'Evidence';
				// 		$data['UserPowerPoint']['foreign_key'] = $me['Evidence']['id'];

				// 		$this->loadModel('UserPowerPoint');
				// 		$this->UserPowerPoint->create();
				// 		$this->UserPowerPoint->save($data);
				// 	}
				// }
				//////////////////COMENTADO PELA GABI///////////////

				// if(empty($this->request->data['Evidence']['content'])) {
				// 	//debug($me);
				// 	$this->Session->setFlash(__('You need to fill the content'),'flash_message');
				// 	$this->redirect($this->referer());
				// }

		        $this->Session->setFlash(__('The evidence has been saved'));

				/* Ends event */

				//REDIRECT TO VIEW THE EVIDENCE
				return $this->redirect(array(
					'header' => $this->request->header, //Use the same header - useful if the requester is ajax
					'action' => 'view', 
					$me['Evidence']['id']
				));
			} else {
				$this->Session->setFlash(__('The evidence could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Evidence.' . $this->Evidence->primaryKey => $id));
			$this->request->data = $this->Evidence->find('first', $options);
		}

		//getting power points from evoke to display the ones related to quests in quests' lightboxes
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

		$user = $this->Evidence->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$users = $this->Evidence->User->find('list');
		$quests = $this->Evidence->Quest->find('list');
		$missions = $this->Evidence->Mission->find('list');
		$phases = $this->Evidence->Phase->find('list');

		$this->loadModel('Attachment');
		$attachments = $this->Attachment->find('all', array(
			'conditions' => array(
				'Attachment.foreign_key' => $me['Evidence']['id'],
				'Attachment.model' => 'Evidence'
			)
		));

		$q = $this->Evidence->Quest->find('first', array('conditions' => array('Quest.id' => $me['Evidence']['quest_id'])));

		$lang = $this->getCurrentLanguage();

		$this->set(compact('dossier_files', 'lang', 'allPowerPoints', 'dossier', 'links', 'video_links', 'user', 'users', 'quests', 'q', 'missions', 'phases', 'attachments', 'sumMyPoints', 'me', 'ajax'));

		//AJAX LOAD EVIDENCE
		if ($ajax) {
			$this->layout = 'ajax';
		}
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
		$this->Evidence->id = $id;
		if (!$this->Evidence->exists()) {
			throw new NotFoundException(__('Invalid evidence'));
		}

		if ($this->Evidence->delete()) {
			$this->Session->setFlash(__('The evidence has been deleted.'));
			if (!$ajax) {
				return $this->redirect(array('controller' => 'users', 'action' => 'profile'));
			}
		} else {
			$this->Session->setFlash(__('The evidence could not be deleted. Please, try again.'));
		}
		
		$this->autoRender = false;
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