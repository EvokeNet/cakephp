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
