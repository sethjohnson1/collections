<?php
App::uses('Usergal', 'Model');

/**
 * Usergal Test Case
 *
 */
class UsergalTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.usergal',
		'app.treasure',
		'app.collection',
		'app.location',
		'app.image',
		'app.artist',
		'app.artists_treasure',
		'app.medvalue',
		'app.treasures_medvalue',
		'app.treasures_usergal'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Usergal = ClassRegistry::init('Usergal');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Usergal);

		parent::tearDown();
	}

}
