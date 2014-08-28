<?php
App::uses('AppModel', 'Model');
/**
 * TreasuresMedvalue Model
 *
 * @property Treasure $Treasure
 * @property Medvalue $Medvalue
 */
class TreasuresMedvalue extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Treasure' => array(
			'className' => 'Treasure',
			'foreignKey' => 'treasure_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Medvalue' => array(
			'className' => 'Medvalue',
			'foreignKey' => 'medvalue_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
