<?php
//remember only two per line
App::uses('AppModel', 'Model');
App::uses('CakeEmail','Network/Email');


class Usergal extends AppModel {
public $actsAs = array('Containable','Search.Searchable');
public $filterArgs = array(
	'searchall'=>array('type' => 'like','encode'=>false,'connectorAnd' => ' ', 'connectorOr' => ',','field'=>array('Usergal.name','Usergal.gloss','Usergal.creator'))
);
	public function beforeSave($options = array()) {
	    $this->bindModel(
        array('hasMany' => array('Badword' => array())));
	
		$badwords=$this->Badword->find('list',array('fields'=>'Badword.word'));
		//debug(get_defined_vars());
		
		//begin replacing known naughty words with empty spaces
		
		
		$text=$this->data['Usergal']['gloss'];
		foreach ($badwords as $word){
			$pattern = "/(^|\\s)" . preg_quote($word) . "($|\\s)/i";
			//$replace = " " . str_repeat('*', strlen($word)) . " ";
			$text = preg_replace($pattern, ' ', $text);
		}
		$text=strip_tags($text);
		$this->data['Usergal']['gloss']=$text;
		
		$text=$this->data['Usergal']['creator'];
		foreach ($badwords as $word){
			$pattern = "/(^|\\s)" . preg_quote($word) . "($|\\s)/i";
			$text = preg_replace($pattern, ' ', $text);
		}
		$text=strip_tags($text);
		$this->data['Usergal']['creator']=$text;

		
		$text=$this->data['Usergal']['name'];
		foreach ($badwords as $word){
			$pattern = "/(^|\\s)" . preg_quote($word) . "($|\\s)/i";
			$text = preg_replace($pattern, ' ', $text);
		}
		$text=strip_tags($text);
		$this->data['Usergal']['name']=$text;
		
		if(empty($this->data['Usergal']['editcode'])){
		$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
		$str = '';
		for ($i = 0; $i < 8; $i++) $str .= $characters[rand(0, strlen($characters) - 1)];
		$this->data['Usergal']['editcode']=$str;
		}
		$this->data['Usergal']['ip'] = $_SERVER["REMOTE_ADDR"]; 

		//this should be return TRUE, but false for testing
		return true;
			
		}
		
		
		public function afterSave($created, $options = array()) {
		
		if($created==true){
			App::import('Component','Cookie');
			$cond = array('Usergal.email'=>$this->data['Usergal']['email']);
			$gals=$this->find('all',array('conditions'=>$cond,'fields'=>array('Usergal.id','Usergal.editcode','Usergal.name'),'contain'=>false));
			$txt='';
			if(!empty($gals)){
				foreach ($gals as $gal){
					$txt=$txt."\n".'Name: '.$gal['Usergal']['name']."\n".'Code: '.$gal['Usergal']['id'].'-'.$gal['Usergal']['editcode']."\n";
				}
				$txt="\n\n As a reminder, here are the other Virtual galleries you've created:\n\n".$txt;
				
			}
			else $txt='';
			$Email = new CakeEmail();
			$Email->from(array('forms@centerofthewest.org' => 'Center of the West'));
			$Email->to($this->data['Usergal']['email']);
			$Email->subject('Thanks for curating a Virtual Exhibit');
			$Email->send('Your Virtual Exhibit is online and can be shared with this link http://collections.centerofthewest.org/usergals/view/'.
			$this->data['Usergal']['id'].
			"\n\n".
			'Here is your Edit Code:'."\n\n".
			$this->data['Usergal']['id'].
			'-'.$this->data['Usergal']['editcode']."\n\n\n".
			"Keep your edit code handy, you'll need it if you ever want to make changes to your Virtual Exhibit.\n".
			'Visit http://collections.centerofthewest.org/usergals/load/ to edit your exhibit.'.$txt
			);
			//$this->
			
			}
			
		}
		

	

	public $validate = array(
		
		'email' => array(
			'rule' => array('email'),
			'message' => 'Please enter a valid e-mail',
			'allowEmpty' => false,
			'required' => true,
		),

		/*'name'=>array(
			'rule'    => array('maxLength',401),
			'message' => 'Please enter your name',
			//'allowEmpty' => false,
			//'required' => true
		
    ),*/

			'creator'=>array(
			'rule'    => array('maxLength',401),
			'message' => '400 character max',
			'allowEmpty' => true,
			'required' => false
		
    ),
		
			'gloss'=>array(
			'rule'    => array('maxLength',4000),
			'message' => '4000 character max',
			'allowEmpty' => true,
			'required' => false
		
    ),
	);
	

	public $hasAndBelongsToMany = array(
		'Treasure' => array(
			'className' => 'Treasure',
			'joinTable' => 'treasures_usergals',
			'foreignKey' => 'usergal_id',
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
