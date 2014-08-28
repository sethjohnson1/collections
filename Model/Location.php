<?php
App::uses('AppModel', 'Model');
/**
 * Location Model
 *
 * @property Treasure $Treasure
 */
class Location extends AppModel {
	public $actsAs = array('Search.Searchable','Containable');
	public $filterArgs = array(
		'name'=>array('type' => 'like')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Treasure' => array(
			'className' => 'Treasure',
			'foreignKey' => 'location_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
