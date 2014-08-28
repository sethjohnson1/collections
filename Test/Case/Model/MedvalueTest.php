<?php
App::uses('Medvalue', 'Model');

/**
 * Medvalue Test Case
 *
 */
class MedvalueTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.medvalue',
		'app.treasure',
		'app.treasures_medvalue'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Medvalue = ClassRegistry::init('Medvalue');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Medvalue);

		parent::tearDown();
	}

}
