<?php
App::uses('AppModel', 'Model');
/**
 * MatchingQuestion Model
 *
 * @property UsersMatchingAnswer $UsersMatchingAnswer
 */
class MatchingQuestion extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'matching_question';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'UsersMatchingAnswer' => array(
			'className' => 'UsersMatchingAnswer',
			'foreignKey' => 'matching_question_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
