<?php
App::uses('Artist', 'Model');

/**
 * Artist Test Case
 *
 */
class ArtistTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.artist',
		'app.treasure',
		'app.collection',
		'app.location',
		'app.image',
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
		$this->Artist = ClassRegistry::init('Artist');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Artist);

		parent::tearDown();
	}

}
