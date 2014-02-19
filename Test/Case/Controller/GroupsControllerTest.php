<?php
App::uses('GroupsController', 'Controller');

/**
 * GroupsController Test Case
 *
 */
class GroupsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.group',
		'app.user',
		'app.comment',
		'app.evidence',
		'app.point',
		'app.user_badge',
		'app.user_organization',
		'app.vote',
		'app.friends_user',
		'app.evokation'
	);

}
