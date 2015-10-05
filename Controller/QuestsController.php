<?php
App::uses('AppController', 'Controller');
/**
 * Quests Controller
 *
 * @property Quest $Quest
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class QuestsController extends AppController {

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
 * add method
 *
 * @return void
 */
	public function add() {
		$this->autoRender = false;

		if ($this->request->is('post')) {
			$this->Quest->create();
			if ($this->Quest->save($this->request->data)) {
				//$this->Session->setFlash(__('The quest has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				//$this->Session->setFlash(__('The quest could not be saved. Please, try again.'));
			}
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function panel_add() {
		$this->autoRender = false;

		if ($this->request->is('post')) {
			
			
			$powerInsert['Power'] = $this->request->data['Power'];
			
				if ($this->Quest->createWithAttachments($this->request->data)) {
					$this->Session->setFlash(__('The quest has been saved.'));
					
					$quest_id = $this->Quest->id;

					$data = $this->request->data;
					
					$data['Quest']['id'] = $quest_id;
					$this->Quest->saveAll($data);

					//create questpowerpoints entries..
					foreach ($powerInsert['Power'] as $powerId => $powerEntry) {
						if($powerEntry['quantity'] > 0){
							$insert['QuestPowerPoint']['quest_id'] = $quest_id;
							$insert['QuestPowerPoint']['power_points_id'] = $powerId;
							$insert['QuestPowerPoint']['quantity'] = $powerEntry['quantity'];

							$this->QuestPowerPoint->create();
							$this->QuestPowerPoint->save($insert);
						}
					}

					//now checking to see if it were a questionnarie type quest (type = 1)
					if($this->request->data['Quest']['type'] == Quest::TYPE_QUESTIONNAIRE) {
						//create a questionnaire..
						$questionnaire_data = array("Questionnaire" => array("quest_id" => $quest_id));
						$this->Questionnaire->create();
						if ($this->Questionnaire->save($questionnaire_data)) {
							$this->Session->setFlash(__('The questionnaire has been saved.'));

							$questionnaire_id = $this->Questionnaire->id;
							
							foreach ($this->request->data['Questions'] as $question) {
								//create questions saving them into the questionnaire
								$question['questionnaire_id'] = $questionnaire_id;
								$this->Question->create();
								if ($this->Question->save($question)) {
									$this->Session->setFlash(__('The question has been saved.'));
									
									$question_id = $this->Question->id;

									//if there are possible answers to this question (i.e. 'single/multiple choice type question'), add them
									if(isset($question['Answer'])) {
										foreach ($question['Answer'] as $answer) {
											//create question answer for each question
											$answer['question_id'] = $question_id;
											$this->Answer->create();
											if ($this->Answer->save($answer)) {
												// $this->Session->setFlash(__('The answer has been saved.'));
											} else {
												// $this->Session->setFlash(__('The answer could not be saved. Please, try again.'));
											}
										}
									}
								} else {
									$this->Session->setFlash(__('The question could not be saved. Please, try again.'));
								}
							}
						} else {
							$this->Session->setFlash(__('The questionnaire could not be saved. Please, try again.'));
						}
					} 

				} else {
					$this->Session->setFlash(__('The quest could not be saved. Please, try again.'));
				}

				$this->Session->setFlash(__('The quest has been saved.'));
				// return $this->redirect(array('action' => 'index'));
				$this->redirect($this->referer());
			
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

		if (!$this->Quest->exists($id)) {
			throw new NotFoundException(__('Invalid quest'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Quest->save($this->request->data)) {
				$this->Session->setFlash(__('The quest has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quest could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Quest.' . $this->Quest->primaryKey => $id));
			$this->request->data = $this->Quest->find('first', $options);
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

		$this->Quest->id = $id;
		if (!$this->Quest->exists()) {
			throw new NotFoundException(__('Invalid quest'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Quest->delete()) {
			$this->Session->setFlash(__('The quest has been deleted.'));
		} else {
			$this->Session->setFlash(__('The quest could not be deleted. Please, try again.'));
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
			$this->Quest->create();
			if ($this->Quest->save($this->request->data)) {
				$this->Session->setFlash(__('The quest has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quest could not be saved. Please, try again.'));
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

		if (!$this->Quest->exists($id)) {
			throw new NotFoundException(__('Invalid quest'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Quest->save($this->request->data)) {
				$this->Session->setFlash(__('The quest has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quest could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Quest.' . $this->Quest->primaryKey => $id));
			$this->request->data = $this->Quest->find('first', $options);
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

		$this->Quest->id = $id;
		if (!$this->Quest->exists()) {
			throw new NotFoundException(__('Invalid quest'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Quest->delete()) {
			$this->Session->setFlash(__('The quest has been deleted.'));
		} else {
			$this->Session->setFlash(__('The quest could not be deleted. Please, try again.'));
		}
	}
}
