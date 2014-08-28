<?php
App::uses('AppModel', 'Model');
/**
 * Artist Model
 *
 * @property Treasure $Treasure
 */
class Artist extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	public $actsAs = array('Search.Searchable');
	public $filterArgs= array(
	'name'=>array('type'=>'like'),
	'slug'=>array('type'=>'like'),
	'find'=>array('type'=>'like','field'=>array('Artist.name','Artist.slug'))
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
			'joinTable' => 'artists_treasures',
			'foreignKey' => 'artist_id',
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
