<?php
App::uses('AppModel', 'Model');
/**
 * Tag Model
 *
 * @property Treasure $Treasure
 */
class Tag extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	
	public $actsAs = array('Search.Searchable','Containable');
	public $filterArgs = array(
		'name'=>array('type' => 'like'),
		'tagcount'=>array('type' => 'like')
	);


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
	'Treasure' => array(
			'className' => 'Treasure',
			'joinTable' => 'tags_treasures',
			'foreignKey' => 'tag_id',
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
