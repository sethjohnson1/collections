<?php
App::uses('TreasuresMedvalue', 'Model');

/**
 * TreasuresMedvalue Test Case
 *
 */
class TreasuresMedvalueTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.treasures_medvalue',
		'app.treasure',
		'app.collection',
		'app.location',
		'app.image',
		'app.artist',
		'app.artists_treasure',
		'app.medvalue',
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
		$this->TreasuresMedvalue = ClassRegistry::init('TreasuresMedvalue');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TreasuresMedvalue);

		parent::tearDown();
	}

}
