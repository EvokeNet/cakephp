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



	public function getOrganizations($options = null){
		return $this->find('all', $options);
	}
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */

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
		),
		'UserOrganization' => array(
			'className' => 'UserOrganization',
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
