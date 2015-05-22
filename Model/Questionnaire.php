<?php
App::uses('AppModel', 'Model');
/**
 * Questionnaire Model
 *
 * @property Quest $Quest
 * @property Question $Question
 */
class Questionnaire extends AppModel {

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
		'Quest' => array(
			'className' => 'Quest',
			'foreignKey' => 'quest_id',
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
		'Question' => array(
			'className' => 'Question',
			'foreignKey' => 'questionnaire_id',
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
	);

}
