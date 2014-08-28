<?php
App::uses('Treasure', 'Model');

/**
 * Treasure Test Case
 *
 */
class TreasureTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.treasure',
		'app.collection',
		'app.location',
		'app.image',
		'app.artist',
		'app.artists_treasure',
		'app.medvalue',
		'app.treasures_medvalue',
		'app.usergal',
		'app.treasures_usergal'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Treasure = ClassRegistry::init('Treasure');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Treasure);

		parent::tearDown();
	}

}
