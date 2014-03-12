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

	public function getOrganizations($order = 'Organization.name'){
		return $this->find('all', array(
			'order' => array($order.' ASC'))
		);
	}
}
