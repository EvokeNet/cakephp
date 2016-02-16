<?php
App::uses('AppModel', 'Model');
/**
 * SuperheroIdentity Model
 *
 * @property social_innovator_qualities $Quality1
 * @property social_innovator_qualities $Quality2
 * @property Power $Power1
 * @property Power $Power2
 * @property User $User
 */
class SuperheroIdentity extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'Quality1' => array(
			'className' => 'social_innovator_qualities',
			'foreignKey' => 'id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Quality2' => array(
			'className' => 'social_innovator_qualities',
			'foreignKey' => 'id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Power1' => array(
			'className' => 'Power',
			'foreignKey' => 'id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Power2' => array(
			'className' => 'Power',
			'foreignKey' => 'id',
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'superhero_identity_id',
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
