<?php
App::uses('AppModel', 'Model');
/**
 * SuperheroIdentity Model
 *
 * @property Social Innovator Quality $hasQuality1
 * @property Social Innovator Quality $hasQuality2
 * @property Power $hasPower1
 * @property Power $hasPower2
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
			'conditions' => array('social_innovator_qualities.id = SuperheroIdentity.quality_1')
		),
		'Quality2' => array(
			'className' => 'social_innovator_qualities',
			'foreignKey' => 'quality_2',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Power1' => array(
			'className' => 'Power',
			'foreignKey' => 'primaryPower',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Power2' => array(
			'className' => 'Power',
			'foreignKey' => 'secondaryPower',
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
