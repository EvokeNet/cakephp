<?php
App::uses('AppModel', 'Model');
/**
 * ForumTopic Model
 *
 * @property User $User
 * @property ForumCategorie $ForumCategorie
 * @property ForumPost $ForumPost
 */
class ForumTopic extends AppModel {

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
		'ForumCategorie' => array(
			'className' => 'ForumCategorie',
			'foreignKey' => 'forum_categorie_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ForumPost' => array(
			'className' => 'ForumPost',
			'foreignKey' => 'forum_topic_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
