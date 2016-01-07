<?php
App::uses('AppModel', 'Model');
/**
 * ForumPost Model
 *
 * @property User $User
 * @property Forum $Forum
 * @property ForumTopic $ForumTopic
 */
class ForumPost extends AppModel {

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
		),
		'ForumTopic' => array(
			'className' => 'ForumTopic',
			'foreignKey' => 'forum_topic_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
