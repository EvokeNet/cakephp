<?php
App::uses('AppController', 'Controller');
/**
 * UserAnswers Controller
 *
 * @property UserAnswer $UserAnswer
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserAnswersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * add method
 *
 * @return void
 */
	public function add($mission_id) {
		$this->autoRender = false;

		if ($this->request->is('post')) {
			
			//user has completed a quest, so if he doesnt exist in 'usersmissions', add him now!
			$this->loadModel('UserMission');
			$is_in = $this->UserMission->find('first', array('conditions' => array('UserMission.user_id' => $this->getUserId(), 'UserMission.mission_id' => $mission_id)));
			if(empty($is_in)) {
				$this->UserMission->create();
				$data['UserMission']['user_id'] = $this->getUserId();
				$data['UserMission']['mission_id'] = $mission_id;

				if ($this->UserMission->save($data)) {
					$this->Session->setFlash(__('The user mission has been saved.'));
				} else {
					$this->Session->setFlash(__('The user mission could not be saved. Please, try again.'));
				}
			}

			//iterate all answers of this questionnaire
			foreach ($this->request->data['UserAnswer'] as $data) {
				if(isset($data['description'])){
					//its an essay
					$insert_data = array('description' => $data['description'], 'answer_id' => null, 'question_id' => $data['question_id'], 'user_id' => $this->getUserId());
					$this->insertAnswer($insert_data);
				} 
				if(isset($data['answer_id'])) {
					if(is_array($data['answer_id'])) {
						//its multiple-choice
						$insert_data = array('description' => null, 'question_id' => $data['question_id'], 'user_id' => $this->getUserId());
						$k = 1;
						foreach ($data['answer_id'] as $answer) {
							$insert_data['answer_id'] = $answer;
							$this->insertAnswer($insert_data, $k);
							$k++;
						}
					} else {
						//its a single-choice
						$insert_data = array('description' => null, 'answer_id' => $data['answer_id'], 'question_id' => $data['question_id'], 'user_id' => $this->getUserId());
						$this->insertAnswer($insert_data);
					}
				}
			}

			$this->Session->setFlash(__('The questionnaire was saved'), 'flash_message');
		}
	}

	// public function insertAnswer($data, $control = 1) {
	// 	//check if user had already answered such questions, if so, delete them...
	// 	if($control == 1) $this->checkPreviousAnswers($data['question_id']);

	// 	$this->UserAnswer->create();
	// 	if ($this->UserAnswer->save($data)) {
	// 		$this->Session->setFlash(__('The user answer has been saved.'));
	// 	} else {
	// 		$this->Session->setFlash(__('The user answer could not be saved. Please, try again.'));
	// 	}
	// }

	// public function checkPreviousAnswers($question_id = null) {
	// 	//check to see if this user had already answered this question..
	// 	$previous_answers = $this->UserAnswer->find('all', array(
	// 		'conditions' => array(
	// 			'UserAnswer.question_id' => $question_id,
	// 			'user_id' => $this->getUserId()
	// 		)
	// 	));

	// 	//for every answer found to this question, erase it
	// 	foreach ($previous_answers as $previous_answer) {
	// 		$this->UserAnswer->id = $previous_answer['UserAnswer']['id'];
	// 		if ($this->UserAnswer->delete()) {
	// 			$this->Session->setFlash(__('The user answer has been deleted.'));
	// 		} else {
	// 			$this->Session->setFlash(__('The user answer could not be deleted. Please, try again.'));
	// 		}
	// 	}
	// }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->autoRender = false;

		if (!$this->UserAnswer->exists($id)) {
			throw new NotFoundException(__('Invalid user answer'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserAnswer->save($this->request->data)) {
				$this->Session->setFlash(__('The user answer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user answer could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserAnswer.' . $this->UserAnswer->primaryKey => $id));
			$this->request->data = $this->UserAnswer->find('first', $options);
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

		$this->UserAnswer->id = $id;
		if (!$this->UserAnswer->exists()) {
			throw new NotFoundException(__('Invalid user answer'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserAnswer->delete()) {
			$this->Session->setFlash(__('The user answer has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user answer could not be deleted. Please, try again.'));
		}
	}
}