<?php
App::uses('AppModel', 'Model');
/**
 * Image Model
 *
 * @property Treasure $Treasure
 */
class Relation extends AppModel {

	public $belongsTo = array(
		'Treasure' => array(
			'className' => 'Treasure',
			'foreignKey' => 'treasure_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
