<?php
App::uses('ArtistsTreasure', 'Model');

/**
 * ArtistsTreasure Test Case
 *
 */
class ArtistsTreasureTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.artists_treasure',
		'app.artist',
		'app.treasure'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ArtistsTreasure = ClassRegistry::init('ArtistsTreasure');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ArtistsTreasure);

		parent::tearDown();
	}

}
