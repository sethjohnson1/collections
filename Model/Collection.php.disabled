<?php
App::uses('AppModel', 'Model');
/**
 * Collection Model
 *
 * @property Treasure $Treasure
 */
class Collection extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Treasure' => array(
			'className' => 'Treasure',
			'foreignKey' => 'collection_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '20',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
			
		)
	);

}
