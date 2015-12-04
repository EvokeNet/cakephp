<?php
App::uses('AppModel', 'Model');
/**
 * Answer Model
 *
 * @property Question $Question
 */
class SuperheroIdentity extends AppModel {

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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'superhero_identity_id',
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
		'SocialInnovatorQuality' => array(
			'className' => 'User',
			'foreignKey' => 'superhero_identity_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
