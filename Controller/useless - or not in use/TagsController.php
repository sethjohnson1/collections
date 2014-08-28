<?php
App::uses('AppController', 'Controller');

class TagsController extends AppController {

	public $components = array('Paginator','Search.Prg','RequestHandler');
	
	public $paginate = array(
	'Treasure'=>array('fields'=>array('Treasure.synopsis','Treasure.accnum'),'recursive'=>-1, 'limit'=>20)
	);

	public function index() {
		$this->Prg->commonProcess();
		$this->Tag->recursive = 0;
		$this->paginate = array('conditions' => $this->Tag->parseCriteria($this->Prg->parsedParams()));
		$this->set('tags', $this->paginate());
	}
	
	//this view has performance / memory issues and probably doesn't need to be used. Check out taggy instead - it manages to paginate in some way that I've forgotten
	public function view($id = null) {
		if (!$this->Tag->exists($id)) {
			throw new NotFoundException(__('Invalid tag'));
		}
		$this->Tag->recursive = 1;
		$options = array('conditions' => array('Tag.' . $this->Tag->primaryKey => $id));
		$this->set('tag', $this->Tag->find('first', $options));
	}

	
	public function taggy($id = null) {
		$this->loadModel('Treasure');
		$cquery=array();
		$cquery=array();
		$xquery=array();
		//$tags=$this->Tag->find('list',array('limit'=>500));
		
		//deal with remove queries first
		if (array_key_exists('remove',$this->request->query)){
		
		$gomer=str_replace("tags/taggy/",'',$this->request->query['url']);
		$gomer=str_replace($this->request->query['remove'],'',$gomer);
		//$gomer=str_replace();
			
		//debug($this->request->query['url']);
		//debug($gomer);
		
		$this->redirect(array('action' => 'taggy',$gomer));
		}
		
		
		$temp_array = &$cquery;
		foreach ($this->params['pass'] as $item){
			$temp_array = &$temp_array['and'];
			$temp_array['Treasure.synopsis LIKE'] ='% '.$item.' %';
		}
		unset($temp_array);	
		
		$temp_array = &$tquery;
		foreach ($this->params['pass'] as $item){
			$temp_array = &$temp_array['and'];
			$temp_array['Tag.name LIKE '] ='% '.$item.' %';
		}
		unset($temp_array);	
		
		$temp_array = &$xquery;
		foreach ($this->params['pass'] as $item){
			$temp_array = &$temp_array['and'];
			$temp_array['Tag.name NOT LIKE '] ='% '.$item.' %';
		}
		unset($temp_array);	
		
		//$treasures=$this->Treasure->find('list',array('conditions'=>$cquery,'recursive'=>0,'limit'=>50,'fields'=>'Treasure.synopsis'));
		$trcnt=$this->Treasure->find('count',array('conditions'=>$cquery,'recursive'=>0,'fields'=>'Treasure.synopsis'));
		$this->Paginator->settings=array('conditions'=>$cquery,'recursive'=>0);
		$treasures=$this->Paginator->paginate('Treasure');
		//$treasures=$this->paginate();
		//debug($xquery);
		$tags=$this->Tag->find('list',array('fields'=>array('Tag.name'),'conditions'=>$xquery,'limit'=>2000));

/*		//Containable behavior example below
		//this is a useful exercise that didn't fit for this usage
		$cnt = $this->Tag->find('all',
		array(
        'contain' => array(
            'Treasure' => array(
               'conditions' => array(
                    $cquery
					
                ),
				'limit'=>10
            )
        ),
        'conditions' => array(
           // array('Tag.name LIKE'=>'red')
        ),
		'limit'=>1
		)
		);
		$cnt=$cnt[0]['Treasure'];
		//$cnt=$this->Tag->Treasure->find('all',array('limit'=>3));
*/	

		//debug($cnt2);
		$this->set('tags', $tags);
		$this->set('stags', $this->params['pass']);
		$this->set('treasures', $treasures);
		$this->set('trcnt',$trcnt);
		$this->set('url', $this->request->query);
		$this->set('_serialize', array('tags'));
	}
	
		public function find() {
		$this->Tag->recursive = 0;
		$this->autoRender = false;
		
		if ($this->request->is('ajax')) {
			$this->autoRender = false;
			$results = $this->Tag->find('list', array(
			'fields' => array('Tag.name'),
			//remove the leading '%' if you want to restrict the matches more
			'conditions' => array('Tag.name LIKE ' => $this->request->query['q'] . '%'),
			'order' => array('Tag.name')
			));
		
			/** Manually build JSON view for autocomplete */
			echo '[';
			$lastflag = count($results);
			$i=0;
			foreach ($results as $key => $value){
				$i++;
				$a =array(
				'value'=>$key,
				'text'=>$value);
				if ($lastflag == $i){
					echo '{"value" : "'.$key.'","text" : "'.$value.'"}';
				}
				else{
					echo '{"value" : "'.$key.'","text" : "'.$value.'"},';
				}
			} 
			echo ']';
	
	
		}
 
		else {
		//if not ajax, send back to homepage with query
		if (array_key_exists('q',$this->request->query)==false){
			$this->request->query['q']='NA.204.1';
		}
		$this->redirect(array('action' => 'index','accnum:'.$this->request->query['q']));
		}		
	}
//the start of the api thing...
//THIS IS OUTDATED AND SHOULD BE REMOVED BEFORE PRODUCTION
	public function api($slug=null) {
		$this->Prg->commonProcess();
		$this->Tag->recursive = 1;
		$tags = array();      
		//we might neve restrict this view for ajax requests only, especially if we never use an API key - why bother?
		// if ($this->request->is('ajax')) {
		
		
		if (is_null($slug)==false){
			/** This is the logic if the URL was accessed by slug**/
			
			if($slug=='random'){
				$tags=$this->Tag->find('first', array('order'=>'RAND()'));
				$cnt='random';
			}
			
			if($slug=='taggy'){
				
				$tags=$this->Tag->find('list',array('limit'=>500));
				$this->set('url', $this->request->query);
				
				debug($this->params['pass']);
				
				$cnt='all';
			}
			
			else {
			$this->Tag->hasAndBelongsToMany['Treasure']['limit']=3;
			$tags = $this->Tag->findByName($slug);
			$this->set('tags', $tags);
			$cnt=1;
			}
			if (empty($tags)){
				throw new NotFoundException(__('treasure id not found'));
			}
		}
		
		else {
		
			/** This is the logic if there is no slug **/
			/* Count the results and decide what to do */
			//first make an array from the request->query
			$aquery=array();
			$bquery=array();
			$cquery=array();
			foreach ($this->request->query as $key => $value){
				if (
					$key == 'name' 
					)
				{
					
				$aquery['Tag.'.$key.' LIKE '] ='%'.$value . '%';
				}
			}
			 //now make an array from the args
			foreach ($this->params['named'] as $tbl => $col){
				if (
					$tbl == 'name'
					)
				{
				
				 //** Lovely nested loop that recursively assigns the values
				 
					if (is_array($col)){
						$temp_array = &$cquery;
						foreach ($col as $item){
						
						$temp_array = &$temp_array['and'];
						// $temp_array now equals null, 
						// and it's references to parent array item with key and
						$temp_array['Tag.'.$tbl.' LIKE '] ='%'.$item.'%';
						}
					}
					else {
						//just do it the normal way
						$bquery['AND']['Tag.'.$tbl.' LIKE '] ='%'.$col . '%';
					}						
					}
			}			
			
			//so if you're with me so far, we are now making one big set of conditions		
			$mega = array_merge($aquery, $bquery, $cquery);
			$cnt=$this->Tag->Treasure->find('count', array('conditions' => $mega));
			
			//debug($this->params['named']['synopsis']);
			debug($mega);
			
			if($cnt == 1){
				$tags=$this->Tag->find('first', array('conditions' => $mega));
			}
			
			if($cnt > 1){
				$this->Tag->recursive = 0;
				$tags= $this->Tag->find('all', array('conditions' => $mega,'limit'=>25));
			}
			
			if($cnt < 1 || empty($mega) ){
				throw new NotFoundException(__('no matches found'));
			}
		}
		
		//debug($tags);
		//just searlize any results, although we could make separate views, we'd rather not
		$this->set('tags', $tags);
		$this->set('cnt',$cnt);
		$this->set('_serialize', array('tags'));

}

	

}
