<?php
App::uses('Evokation', 'Model');

/**
 * Evokation Test Case
 *
 */
class EvokationTest extends CakeTestCase {

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
		'app.friends_user',
		'app.groups_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Evokation = ClassRegistry::init('Evokation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Evokation);

		parent::tearDown();
	}

}
