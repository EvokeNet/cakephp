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

	public function getBadges($order = "Badge.name"){
		return $this->find('all', array(
			'order' => array($order.' ASC')
			));
	}
}
