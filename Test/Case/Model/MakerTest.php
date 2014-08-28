<?php
App::uses('Maker', 'Model');

/**
 * Maker Test Case
 *
 */
class MakerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.maker',
		'app.treasure',
		'app.collection',
		'app.location',
		'app.image',
		'app.artist',
		'app.artists_treasure',
		'app.medvalue',
		'app.treasures_medvalue',
		'app.usergal',
		'app.treasures_usergal',
		'app.tag',
		'app.tags_treasure',
		'app.makers_treasure'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Maker = ClassRegistry::init('Maker');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Maker);

		parent::tearDown();
	}

}
