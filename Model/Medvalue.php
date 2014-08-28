<?php
App::uses('AppModel', 'Model');
/**
 * Medvalue Model
 *
 * @property Treasure $Treasure
 */
class Medvalue extends AppModel {
	public $actsAs = array('Search.Searchable','Containable');
	public $filterArgs= array(
	'name'=>array('type'=>'like'),
	'slug'=>array('type'=>'like')
	);

	public $hasAndBelongsToMany = array(
		'Treasure' => array(
			'className' => 'Treasure',
			'joinTable' => 'treasures_medvalues',
			'foreignKey' => 'medvalue_id',
			'associationForeignKey' => 'treasure_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
