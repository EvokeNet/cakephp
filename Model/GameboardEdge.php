<?php
App::uses('AppModel', 'Model');
/**
 * GameboardEdge Model
 *
 * @property Gameboard $Gameboard
 * @property GameboardNode $source
 * @property GameboardNode $target
 */
class GameboardEdge extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';


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
		)
	);
}
