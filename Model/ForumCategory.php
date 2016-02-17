<?php
App::uses('AppModel', 'Model');
/**
 * ForumCategory Model
 *
 * @property User $User
 * @property Forum $Forum
 */
class ForumCategory extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Forum' => array(
			'className' => 'Forum',
			'foreignKey' => 'forum_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
