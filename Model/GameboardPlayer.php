<?php
App::uses('AppModel', 'Model');
/**
 * GameboardPlayer Model
 *
 * @property Gameboard $Gameboard
 * @property User $User
 * @property Node $Node
 */
class GameboardPlayer extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'gameboards_player';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'user_id';


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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Node' => array(
			'className' => 'Node',
			'foreignKey' => 'node_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
