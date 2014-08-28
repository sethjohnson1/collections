<?php
App::uses('AppModel', 'Model');

class MakersTreasure extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Maker' => array(
			'className' => 'Maker',
			'foreignKey' => 'maker_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Treasure' => array(
			'className' => 'Treasure',
			'foreignKey' => 'treasure_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
