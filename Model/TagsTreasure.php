<?php
App::uses('AppModel', 'Model');
/**
 * TreasuresMedvalue Model
 *
 * @property Treasure $Treasure
 * @property Medvalue $Medvalue
 */
class TagsTreasure extends AppModel {


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
		'Tag' => array(
			'className' => 'Tag',
			'foreignKey' => 'tag_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}