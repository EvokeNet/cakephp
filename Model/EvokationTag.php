<?php
App::uses('AppModel', 'Model');
/**
 * EvokationTag Model
 *
 * @property Evokation $Evokation
 * @property Tag $Tag
 */
class EvokationTag extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Evokation' => array(
			'className' => 'Evokation',
			'foreignKey' => 'evokation_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Tag' => array(
			'className' => 'Tag',
			'foreignKey' => 'tag_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
