<?php
App::uses('AppModel', 'Model');
/**
 * UserMatchingAnswer Model
 *
 * @property User $User
 * @property MatchingQuestion $MatchingQuestion
 */
class UserMatchingAnswer extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'matching_answer';
	
/**
 * Behaviors
 *
 * @var array
 */
	public $actsAs = array('Containable');

/**
 * Save essay answer
 *
 * @param int user id
 * @param int question id
 * @param string description
 * @return boolean True if row was saved, false if not
 */
	public function saveEssayAnswer($user_id, $question_id, $description) {
		$insert = array();
		$insert['UserMatchingAnswer']['user_id'] = $user_id;
		$insert['UserMatchingAnswer']['matching_question_id'] = $question_id;
		$insert['UserMatchingAnswer']['description'] = $description;

		$this->create();
		return $this->save($insert);
	}


/**
 * Save choice answer
 *
 * @param int user id
 * @param int question id
 * @param int matching answer id
 * @return boolean True if row was saved, false if not
 */
	public function saveChoiceAnswer($user_id, $question_id, $matching_answer_id) {
		$insert = array();
		$insert['UserMatchingAnswer']['user_id'] = $user_id;
		$insert['UserMatchingAnswer']['matching_question_id'] = $question_id;
		$insert['UserMatchingAnswer']['matching_answer_id'] = $matching_answer_id;

		$this->create();
		return $this->save($insert);
	}


/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MatchingAnswer' => array(
			'className' => 'MatchingAnswer',
			'foreignKey' => 'matching_answer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MatchingQuestion' => array(
			'className' => 'MatchingQuestion',
			'foreignKey' => 'matching_question_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
