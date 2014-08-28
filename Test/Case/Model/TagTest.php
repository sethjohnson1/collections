<?php
App::uses('Tag', 'Model');

/**
 * Tag Test Case
 *
 */
class TagTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tag',
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
		'app.tags_treasure'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tag = ClassRegistry::init('Tag');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tag);

		parent::tearDown();
	}

}
