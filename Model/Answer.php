<?php
App::uses('AppModel', 'Model');
/**
 * Answer Model
 *
 * @property Question $Question
 */
class Answer extends AppModel {

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
		'Question' => array(
			'className' => 'Question',
			'foreignKey' => 'question_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
