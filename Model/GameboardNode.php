<?php
App::uses('AppModel', 'Model');
/**
 * GameboardNode Model
 *
 * @property Gameboard $Gameboard
 * @property Mission $Mission
 */
class GameboardNode extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'role';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Gameboard' => array(
			'className' => 'Gameboard',
			'foreignKey' => 'gameboard_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Mission' => array(
			'className' => 'Mission',
			'foreignKey' => 'mission_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
