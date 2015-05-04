<?php
App::uses('EvokationsController', 'Controller');

/**
 * EvokationsController Test Case
 *
 */
class EvokationsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.evokation',
		'app.group',
		'app.user',
		'app.comment',
		'app.evidence',
		'app.point',
		'app.user_badge',
		'app.user_organization',
		'app.vote',
		'app.friends_user'
	);

}
