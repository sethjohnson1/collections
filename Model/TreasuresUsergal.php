<?php
App::uses('AppModel', 'Model');

class TreasuresUsergal extends AppModel {
public $actsAs = array('Containable');
		public function beforeSave($options = array()) {
		
		//I ccan't get the badword check working on this.. Need to revisit if it becomes a problem
		//for now, just doing comments on Usergal model, and therefore cannot beforeSave
		//debug($this->data['TreasuresUsergal']);
	  //  $this->bindModel(array('hasMany' => array('Badword' => array())));
	
	//	$badwords=$this->Badword->find('list',array('fields'=>'Badword.word'));
		//comments has to be a loop
		/*foreach ($this->data['TreasuresUsergal']['comments'] as $key=>$cmt){
			$text=$this->data['TreasuresUsergal']['comments'][$key];
			foreach ($badwords as $word){
				$pattern = "/(^|\\s)" . preg_quote($word) . "($|\\s)/i";
				//$replace = " " . str_repeat('*', strlen($word)) . " ";
				$text = preg_replace($pattern, ' ', $text);
				//debug($pattern);
			}
			$text=strip_tags($text);
			debug($text);
			debug($this->data['TreasuresUsergal']['comments'][$key]);
			$this->data['TreasuresUsergal']['comments'][$key]=$text;
		}
		*/
		
		return true;
		}



	public $belongsTo = array(
		'Treasure' => array(
			'className' => 'Treasure',
			'foreignKey' => 'treasure_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Usergal' => array(
			'className' => 'Usergal',
			'foreignKey' => 'usergal_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
