<?php
App::uses('AppModel', 'Model');
/**
 * Question Model
 *
 * @property Questionnaire $Questionnaire
 * @property Answer $Answer
 * @property UserAnswer $UserAnswer
 */
class Question extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'description';

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
		'Questionnaire' => array(
			'className' => 'Questionnaire',
			'foreignKey' => 'questionnaire_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Answer' => array(
			'className' => 'Answer',
			'foreignKey' => 'question_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'UserAnswer' => array(
			'className' => 'UserAnswer',
			'foreignKey' => 'question_id',
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
