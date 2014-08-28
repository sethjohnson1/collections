<?php
App::uses('TreasuresUsergal', 'Model');

/**
 * TreasuresUsergal Test Case
 *
 */
class TreasuresUsergalTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.treasures_usergal',
		'app.treasure',
		'app.collection',
		'app.location',
		'app.image',
		'app.artist',
		'app.artists_treasure',
		'app.medvalue',
		'app.treasures_medvalue',
		'app.usergal'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TreasuresUsergal = ClassRegistry::init('TreasuresUsergal');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TreasuresUsergal);

		parent::tearDown();
	}

}
