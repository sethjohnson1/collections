<?php
App::uses('AppModel', 'Model');

class Treasure extends AppModel {

public $actsAs = array('Search.Searchable','Containable');

/* eventually this should be in the AppModel I think
//this function takes search terms from a specified field and groups them into an array based on quotes, negative, etc.
It returns conditions ready for the search plug-in to accept
*/
function sjPrepare($data,$field){
	$terms = explode(" ",$data);
	$flag=0;
	foreach ($terms as $key=>$term){
		//first check if they just put one word in quotes and trim it an go
		if (substr($term, 0,1)=='"' && substr($term, -1,1)=='"'){
			$temp=substr($term,0, -1);
			$terms[$key]=substr($temp, 1);
			break;
		}
		if ($flag==1) {
			//checks for the last quote then go about fixing it all up
			if (substr($term, -1,1)=='"'){ 
				$qt_term=$qt_term." ".substr($term,0, -1);
				$flag=0;
				//debug($key);
				$unsets[$key]=$key;
				$i=0;
				foreach ($unsets as $key=>$val) {
					if ($i==0){
						$terms[$key]=$qt_term;
					}
					else {
					 unset($terms[$key]);
					}
					$i++;	
				}
				}
			else {
			$qt_term=$qt_term." ".$term;
			$unsets[$key]=$key;
			}
		}
		//check for starting quotes
		if (substr($term, 0,1)=='"'){
			$qt_term=substr($term, 1);
			$flag=1;
			$unsets=array();
			$unsets[$key]=$key;
		}
	}
	//if all went as planned, $terms is now an array with quoted terms grouped together
	//debug($terms);
	$cond['AND']=array();
	foreach ($terms as $term){
		//now check if the first character is negative
		if (substr($term, 0,1)=='-'){
			$term=substr($term,1);
			if (substr($term, 0,1)=='%' || substr($term, -1,1)=='%'){
				array_push($cond['AND'],$field." NOT LIKE '".$term."'");
				break;
			}
			array_push($cond['AND'],$field." NOT REGEXP '([[[:blank:][:punct:]]|^)".$term."([[:blank:][:punct:]]|$)'");
			break;
		}
		if (substr($term, 0,1)=='%' || substr($term, -1,1)=='%'){
			//$term=substr($term,1);
			array_push($cond['AND'],$field." LIKE '".$term."'");
			break;
		}
		else {
			array_push($cond['AND'],$field." REGEXP '([[[:blank:][:punct:]]|^)".$term."([[:blank:][:punct:]]|$)'");
		}
	}
	return $cond;
}



public $filterArgs = array(
	//the hABTM
	'makers' => array('type' => 'subquery', 'method' => 'findByMaker', 'field' => 'Treasure.id'),
	'medvalues' => array('type' => 'subquery', 'method' => 'findByMedvalue', 'field' => 'Treasure.id'),
	'tags' => array('type' => 'subquery', 'method' => 'findByTag', 'field' => 'Treasure.id'),
	'accnum' => array('type' => 'query', 'method' => 'fAccnum'),
	'daterange' => array('type' => 'query', 'method' => 'fDaterange'),
	'dimensions' => array('type' => 'query', 'method' => 'fDimensions'),
	'synopsis' => array('type' => 'query', 'method' => 'fSynopsis'),
	'objtitle' => array('type' => 'query', 'method' => 'fObjtitle'),
	'creditline' => array('type' => 'query', 'method' => 'fCreditline'),
	'gloss' => array('type' => 'query', 'method' => 'fGloss'),
	'inscription' => array('type' => 'query', 'method' => 'fInscription'),
	'remarks' => array('type' => 'query', 'method' => 'fRemarks'),
	'commonname' => array('type' => 'query', 'method' => 'fCommonname'),
	'genus' => array('type' => 'query', 'method' => 'fGenus'),
	'searchall' => array('type' => 'query', 'method' => 'fSearchall'),
	'slug' => array('type' => 'like'),


	//this is a general purpose that simply looks at most of the fields
	//encode is false by default, but I turned it on for experimenting
	//now that we have a special function we might want to do that instead
	'searchall'=>array('type' => 'like','encode'=>false,'connectorAnd' => ' ', 'connectorOr' => ',','field'=>array(
		//these are all disabled for testing (makes array smaller and easier to figure out)
		'Treasure.accnum',
		'Treasure.objtitle',
		'Treasure.synopsis',
		'Treasure.gloss',
		'Treasure.daterange',
		'Treasure.creditline',
		'Treasure.inscription',
		'Treasure.dimensions',
		'Treasure.genus',
		'Treasure.commonname'
		//'Treasure.slug'
		)
	), 
	
	'bbm'=>array('type'=>'query','method'=>'fBBM'),
	'cfm'=>array('type'=>'query','method'=>'fCFM'),
	'dmnh'=>array('type'=>'query','method'=>'fDMNH'),
	'pim'=>array('type'=>'query','method'=>'fPIM'),
	'wg'=>array('type'=>'query','method'=>'fWG'),
	'loc'=>array('type'=>'query','method'=>'fLocation'),
	'd'=>array('type'=>'query','method'=>'fDisplay'),
  );

 //the functions using REGEX instead of LIKE search for whole-word matches only
public function fAccnum($data = array()){
	return $this->sjPrepare($data['accnum'],'Treasure.accnum');
}

public function fDaterange($data = array()){
	return $this->sjPrepare($data['daterange'],'Treasure.daterange');
}

public function fDimensions($data = array()){
	return $this->sjPrepare($data['dimensions'],'Treasure.dimensions');
}

public function fSynopsis($data = array()){
	return $this->sjPrepare($data['synopsis'],'Treasure.synopsis');
}

public function fObjtitle($data = array()){
	return $this->sjPrepare($data['objtitle'],'Treasure.objtitle');
}

public function fCreditline($data = array()){
	return $this->sjPrepare($data['creditline'],'Treasure.creditline');
}

public function fGloss($data = array()){
	return $this->sjPrepare($data['gloss'],'Treasure.gloss');
}

public function fInscription($data = array()){
	return $this->sjPrepare($data['inscription'],'Treasure.inscription');
}

public function fRemarks($data = array()){
	return $this->sjPrepare($data['remarks'],'Treasure.remarks');
}

public function fCommonname($data = array()){
	return $this->sjPrepare($data['commonname'],'Treasure.commonname');
}

public function fGenus($data = array()){
	return $this->sjPrepare($data['genus'],'Treasure.genus');
}

  
public function fLocation($data = array()){
	$cond = array('AND' => array('AND'=>( array("Location.name LIKE '".$data['loc']."%'"))));
	return $cond;
}


public function fDisplay($data = array()){
	if ($data['d'] == 1){
		$cond = array('AND' => array('AND'=>( array("Location.name is not null"))));
    return $cond;
	}
}
  
public function fBBM($data = array()){
	if ($data['bbm'] == 1){
		$cond = array('AND' => array('OR'=>( array("Treasure.collection LIKE 'bbm'"))));
    return $cond;
	}
}

public function fCFM($data = array()){
	if ($data['cfm'] == 1){
		$cond = array('AND' =>array('OR'=>( array("Treasure.collection LIKE 'cfm'"))));
    return $cond;
	}
}

public function fDMNH($data = array()){
	if ($data['dmnh'] == 1){
		$cond = array('AND' =>array('OR'=>( array("Treasure.collection LIKE 'dmnh'"))));
    return $cond;
	}
}

public function fPIM($data = array()){
	if ($data['pim'] == 1){
		$cond = array('AND' =>array('OR'=>( array("Treasure.collection LIKE 'pim'"))));
    return $cond;
	}
}

public function fWG($data = array()){
	if ($data['wg'] == 1){
		$cond = array('AND' =>array('OR'=>( array("Treasure.collection LIKE 'wg'"))));
    return $cond;
	}
}


public function findByMaker($data = array()) {
    $this->MakersTreasure->Behaviors->attach('Containable', array('autoFields' => false));
    $this->MakersTreasure->Behaviors->attach('Search.Searchable');
        $query = $this->MakersTreasure->getQuery('all', array(
			//there are bads special characters, so do not use name (not to mention this specific purpose is not a real Search, but locator)
		    //'conditions' => array("Maker.name LIKE '%" . $data['makers'] ."%'"),
            'conditions' => array('Maker.id'=> $data['makers']),
            'fields' => array('treasure_id'),
            'contain' => array('Maker'),
        ));
        return $query;
    }

	public function findByMedvalue($data = array()) {
    $this->TreasuresMedvalue->Behaviors->attach('Containable', array('autoFields' => false));
    $this->TreasuresMedvalue->Behaviors->attach('Search.Searchable');
        $query = $this->TreasuresMedvalue->getQuery('all', array(
            //'conditions' => array("Medvalue.name LIKE '%" . $data['medvalues'] ."%'"),
            'conditions' => array('Medvalue.id'=>$data['medvalues']),
            'fields' => array('treasure_id'),
            'contain' => array('Medvalue'),
        ));
        return $query;
    }
	
	public function findByTag($data = array()) {
    $this->TagsTreasure->Behaviors->attach('Containable', array('autoFields' => false));
    $this->TagsTreasure->Behaviors->attach('Search.Searchable');
        $query = $this->TagsTreasure->getQuery('all', array(
			//'conditions' => array("Tag.name LIKE '%" . $data['tags'] ."%'"),
			'conditions' => array("Tag.name REGEXP '([[[:blank:][:punct:]]|^)".$data['tags']."([[:blank:][:punct:]]|$)'"),
            'fields' => array('treasure_id'),
            'contain' => array('Tag'),
        ));
        return $query;
    }
	
	


/*

//the original working FilterArgs
public $filterArgs = array(

	//this is a general purpose that simply looks at most of the fields
	//encode is false by default, but I turned it on for experimenting
	'searchall'=>array('type' => 'like','encode'=>false,'connectorAnd' => ' ', 'connectorOr' => ',','field'=>array(
	'Treasure.accnum',
	'Treasure.objtitle',
	'Treasure.synopsis',
	'Treasure.gloss',
	'Treasure.daterange',
	'Treasure.creditline',
	'Treasure.inscription',
	'Treasure.dimensions',
	'Treasure.slug'
	)),
	
	//if these are here, the plugin will take care of checking the boxes
	'bbm'=>array('empty'=>true),
	'cfm'=>array(),
	'dmnh'=>array(),
	'pim'=>array(),
	'wg'=>array()


*/

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
		/*'Collection' => array(
			'className' => 'Collection',
			'foreignKey' => 'collection_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		*/
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'location_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Image' => array(
			'className' => 'Image',
			'foreignKey' => 'treasure_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
			'Relation' => array(
			'className' => 'Relation',
			'foreignKey' => 'treasure_id',
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


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Maker' => array(
			'className' => 'Maker',
			'joinTable' => 'makers_treasures',
			'foreignKey' => 'treasure_id',
			'associationForeignKey' => 'maker_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'with' => 'MakersTreasure'
		),
		'Medvalue' => array(
			'className' => 'Medvalue',
			'joinTable' => 'treasures_medvalues',
			'foreignKey' => 'treasure_id',
			'associationForeignKey' => 'medvalue_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'with'=>'TreasuresMedvalue'
		),
		
		'Usergal' => array(
			'className' => 'Usergal',
			'joinTable' => 'treasures_usergals',
			'foreignKey' => 'treasure_id',
			'associationForeignKey' => 'usergal_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			
		)
		,
		
		'Tag' => array(
			'className' => 'Tag',
			'joinTable' => 'tags_treasures',
			'foreignKey' => 'treasure_id',
			'associationForeignKey' => 'tag_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'with'=>'TagsTreasure'
		)
		
		
	);

}
