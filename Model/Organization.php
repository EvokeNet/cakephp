<?php
App::uses('AppModel', 'Model');
/**
 * Organization Model
 *
 * @property User $User
 * @property Mission $Mission
 */
class Organization extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';



	public function getOrganizations($order = 'Organization.name'){
		return $this->find('all', array(
			'order' => array($order.' ASC'))
		);
	}
	//The Associations below have been created with all possible keys, those that are not needed can be removed

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
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Mission' => array(
			'className' => 'Mission',
			'foreignKey' => 'organization_id',
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
