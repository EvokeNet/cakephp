<?php
App::uses('AppModel', 'Model');
/**
 * Answer Model
 *
 * @property Question $Question
 */
class Quality extends AppModel {

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
		
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'MatchingAnswer' => array(
			'className' => 'MatchingAnswer',
			'foreignKey' => 'matching_answer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
