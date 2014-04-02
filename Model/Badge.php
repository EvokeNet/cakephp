<?php
App::uses('AppModel', 'Model');
/**
 * Badge Model
 *
 */
class Badge extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	public function getBadges($options = null) {
		return $this->find('all', $options);
	}

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Organization' => array(
			'className' => 'Organization',
			'foreignKey' => 'organization_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
