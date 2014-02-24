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

	public function getOrganizations(){
		return $this->find('all');
	}
}
