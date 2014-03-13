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

	public function getBadges($options = null){
		return $this->find('all', $options);
	}
}
