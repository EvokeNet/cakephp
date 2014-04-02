<?php
App::uses('AppModel', 'Model');
/**
 * Organization Model
 *
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

	public $hasMany = array(
		'Badge' => array(
			'className' => 'Badge',
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
