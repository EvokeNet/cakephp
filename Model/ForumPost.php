<?php
App::uses('AppModel', 'Model');
/**
 * ForumPost Model
 *
 * @property User $User
 * @property Forum $Forum
 * @property ForumTopic $ForumTopic
 * @property Forum $Forum
 */
class ForumPost extends AppModel {


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
		),
		'ForumTopic' => array(
			'className' => 'ForumTopic',
			'foreignKey' => 'forum_topic_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

// /**
//  * hasMany associations
//  *
//  * @var array
//  */
// 	public $hasMany = array(
// 		'Forum' => array(
// 			'className' => 'Forum',
// 			'foreignKey' => 'forum_post_id',
// 			'dependent' => false,
// 			'conditions' => '',
// 			'fields' => '',
// 			'order' => '',
// 			'limit' => '',
// 			'offset' => '',
// 			'exclusive' => '',
// 			'finderQuery' => '',
// 			'counterQuery' => ''
// 		)
// 	);

}
