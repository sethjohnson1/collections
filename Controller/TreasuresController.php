<?php
App::uses('AppController', 'Controller');

class TreasuresController extends AppController {
	public $components = array('Auth'=>array('loginRedirect'=>''),'Paginator','Search.Prg'=>array(
			//newer version of search plugin defaults to querystring, we have lots of work to do before we're ready for that...
			/* NOTE!!  sj modified plugin to accept additional option "anchor" for the anchor tag at the end, you can see that mod around line 424 of PrgComponent
			*/
			'commonProcess'=>array('keepPassed'=>false,'paramType'=>'named','anchor'=>'search-results'),
			'presentForm'=>array('paramType'=>'named')
		),
		'RequestHandler','Cookie','Comment'
		/*'Comments.Comments'=>array(
			'userModelClass'=>'Users.User'
			//although the above is not ignored, it seems like other options I pass here are ignored (like viewVariable), so I use beforeFilter)
		)*/
	);
	//Regular ol' $this->paginate() ceases to function when this is declared, but you can paginate any Model here (or other ways)
	public $paginate = array(
		'Maker' => array (),
		'Treasure'=>array()
	);

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
		//this needs to be a single item with ID (I think)
		//by default it will use the model name (i.e. kid, treasure, artwork)
		//$this->Comments->viewVariable='treasure';
		//if you look at manual, you will see there are several useful component settings		
		//isAdmin isn't always set in CommentsPlugin when it should be, this has fixed it so far
		$isAdmin = (bool)$this->Auth->user('is_admin');
		$this->set('isAdmin',$isAdmin);
		$this->set('TWshorturl',substr($this->UrlShortener->get_bitly_short_url('http://collections.centerofthewest.org'.$this->here.'?utm_source=twitterk&utm_campaign=onlinecollections'),0,-1));					
	}
	
	/*
	//this is straight from Comments plugin docs, could probably be done other ways - but it works
	public function callback_commentsInitType() {
		//Initializes the view type for comments widget
		return 'tree'; // threaded, tree and flat supported
	}
	
	public function callback_commentsAdd($modelId, $commentId, $displayType, $data = array()) {
		if (!empty($this->request->data)) {
		  // this means something has gone very wrong
		}
		return $this->Comments->callback_add($modelId, $commentId, $displayType, $data);
	}
	
	*/

	
	public function advancedsearch(){
		$this->Prg->commonProcess();
		$search = $this->Treasure->parseCriteria($this->Prg->parsedParams());
		$prm=$this->params['named'];
		unset($prm['searchall']);
		unset($prm['page']);
		//the flag is a hidden value to let us know whether to redirect or not
		if (!empty($prm['rdflag'])&&$prm['rdflag']==1){
			unset($prm['rdflag']);
			$prm['action']='index';
			return $this->redirect($prm);
		}
	}

	public function index() {	
		//debug(Configure::read('bitlyAPIkey'));
		$this->Prg->commonProcess();
		$this->Treasure->recursive = 0;
		//delete the session variable if it's around
		$this->Session->delete('scond');
		$this->Session->delete('backto');
		$var=$this->params['named'];
		$var['action']='index';
		$this->Session->write('backto',$var);	
		
		//first see if we need to redirect to another page. This was being done after the find before, which was causing two finds per page change
		//the tradeoff is that we cannot count the page and therefore they can go to a page that doesn't exist. Perhaps HTML5 validation can fix this?
		if (!empty($this->params['named']['pXv_9gg'])) {
			$parms=$this->params['named'];
			unset($parms['url']);
			$parms['page']=$parms['pXv_9gg'];
			unset($parms['pXv_9gg']);
			$parms['action']='index';
			$this->redirect($parms);
		}
		
		
		//for "Find by Accnum" - could be done other ways but this works
		if (!empty($this->params['named']['o'])) {  
			//the o param is the slug, see JSON call for more info
			//the view logic can take care of any error handling
			$this->redirect(array('action' => 'view', $this->params['named']['o']));
		}
		
		//the autocomplete uses this!
		if (isset($this->request->query['q'])){
			//disable this for testing, could be AND statement now I suppose
			if ($this->request->is('ajax')) {
				$results = $this->Treasure->find('all', array(
					//include any fields you need in the JSON call, i.e. the img is for an experiment with select2
					'fields' => array('Treasure.slug','Treasure.accnum','Treasure.img'),
					//remove the leading '%' if you want to restrict the matches more
					'conditions' => array('Treasure.accnum LIKE ' => '%'.$this->request->query['q'] . '%'),
					'order' => array('Treasure.accnum'),
					'limit'=>20
				));
				$this->set('results', $results);
				$this->set('_serialize', array('results'));
				return true;
			}
			else {
				return $this->redirect(array('action' => 'index'));
			}
		}
		$aquery=array();
		$locquery=array();
		//checking queries (i.e.?synopsis=red&creditline=gift) - mostly for API
		//this entire line of thinking is replaced, and this should be removed soon
		foreach ($this->request->query as $tbl => $value){
			if (
				$tbl == 'accnum' || 
				$tbl == 'objtitle' ||
				$tbl == 'daterange' ||
				$tbl == 'dimensions' ||
				$tbl == 'synopsis' ||
				$tbl == 'creditline' ||
				$tbl == 'gloss' ||
				$tbl == 'inscription' ||
				$tbl == 'slug'
				)
			{	
				$aquery['Treasure.'.$tbl.' LIKE '] ='%'.$value . '%';
			}
		}
		
		$search = $this->Treasure->parseCriteria($this->Prg->parsedParams());

		//now merge the results of the search with the query terms
		//then, URLs like this will work index/searchall:beaded?creditline=gift&synopsis=green
		$mega = array_merge($search,$aquery);
		
		//special conditions for querystring limits
		if (!empty($this->request->query['n'])) $limit = $this->request->query['n'];
		else $limit=25;
		$sortord=array('Treasure.homeflag'=>'desc','Treasure.img'=>'desc','Treasure.id'=>'asc');
		$contain=array('Maker');
		
		//this is useful for finding missing images after a new records are added
		//$sortord=array('Treasure.img'=>'asc');
			
		//set the limit
		if (isset($this->params['named']['n'])&&$this->params['named']['n']<=100){
			$limit = $this->params['named']['n'];
		}	
		$this->Paginator->settings = array('conditions' => $mega,'order'=>$sortord,'limit'=>$limit,'contain'=>$contain);
		$treasures=$this->paginate('Treasure');
		
		//now do session variable for the proper neighbor values on the view
		//don't bother with sort, ir gets ignored by neighbors
		$this->Session->write('scond',$mega);	
		//for the featured galleries	
		$usergals=$this->Treasure->Usergal->find('all',array('limit'=>25,'conditions'=>array('Usergal.featured'=>true),'contain'=>false));
		$x=0;
		//remove personal information from the Usergal data
		foreach ($usergals as $val=>$key){
			unset($usergals[$x]['Usergal']['email']);
			unset($usergals[$x]['Usergal']['editcode']);
			$x++;
		}
		$this->set('usergals',$usergals);
		$this->set('treasures', $treasures);
		$this->set('limit',$limit);
		$this->set('_serialize', array('treasures'));
		
		/* BREADCRUMBS
		makes a nice array which can then be "cascaded" through in the view
		*/
		$breadcrumb=array();
		$pm=$this->params['named'];
		$mk=$this->Cookie->read('maker');
		$md=$this->Cookie->read('medval');
		//the collections are the trickiest one, dump into array then count them
		$cols=array();
		if (!empty($pm['bbm'])) $cols['bbm']='Buffalo Bill';
		if (!empty($pm['pim'])) $cols['pim']='Plains Indian';
		if (!empty($pm['cfm'])) $cols['cfm']='Firearms';
		if (!empty($pm['dmnh'])) $cols['dmnh']='Natural History';
		if (!empty($pm['wg'])) $cols['wg']='Western Art';
		
		if (count($cols)==1) $breadcrumb[0]=implode($cols);
		else if (count($cols)==5||count($cols)==0) $breadcrumb[0]='All 5 Museums';
		else $breadcrumb[0]=count($cols).' Museums';
		
		if (!empty($pm['d'])&&($pm['d']==1)) $breadcrumb[1] = 'On Display or Loan';
		if (!empty($pm['loc'])) $breadcrumb[1]= 'Location:'.$pm['loc'];
		
		if(!empty($mk) && !empty($pm['makers'])) $breadcrumb[2]=''.$mk;
		if(!empty($md) && !empty($pm['medvalues'])) $breadcrumb[3]=''.$md;
		if(!empty($pm['tags'])) $breadcrumb[3]='Tag: '.$pm['tags'];
		
		if(!empty($pm['searchall'])) $breadcrumb[4]=$pm['searchall'];
		if(array_key_exists('synopsis',$pm)) $breadcrumb[5]='Advanced Search';

		$this->set('breadcrumb',$breadcrumb);
		//$this->render('index','mobile');
		//end breadcrumbs
	}
	
	public function view($slug = null) {
		//use sessions vars to give conditions to prev and next buttons, and also Return to Search results
		$this->set('backto',$this->Session->read('backto'));
		$mega=$this->Session->read('scond');
		
		//this handy line will set a redirect back here if the user logins in (so include this any page someone might login)
		$this->Session->write('Auth.redirect', $this->here);
	
		//items can be viewed by slug or by id or argusid (a) (for mobile web share QR code thing) with a passed query
		if (is_null($slug)==false || !empty($this->request->query['id']) || !empty($this->request->query['a'])){
			//check if using id query
			if (!empty($this->request->query['id'])){
				$treasure = $this->Treasure->findById($this->request->query['id']);
			}
			else {
				if (!empty($this->request->query['a'])){
					//remove first and last character, the QR codes have curly braces in them which are no longer there
					$a=substr(substr($this->request->query['a'],0,-1),1);
					$treasure = $this->Treasure->findById($a);
				}
				else{
					$treasure = $this->Treasure->findBySlug($slug);
				}
			}
			$neighbors = $this->Treasure->find('neighbors', array('field'=>'slug','value'=>$slug,'conditions'=>$mega,'recursive'=>0));
			$this->set('neighbors',$neighbors);
			if (empty($treasure)){	
				$cnt=$this->Treasure->find('count',array('conditions'=>array('Treasure.slug LIKE'=>'%'.$slug.'%')));
				//even though invalid slug, there is only one item like it, so give it to them
				//maybe this is a bad idea for performance - sort of a pointless feature anyway
				if ($cnt == 1){
					$treasure=$this->Treasure->find('first',array('conditions'=>array('Treasure.slug LIKE'=>'%'.$slug.'%')));
					$this->redirect(array('action' => 'view', $treasure['Treasure']['slug']));
				}
				else{
					if ($cnt > 1){$searchvar='slug:'; $flash='Found more than one item like '.$slug;}
					if ($cnt < 1){$searchvar='searchall:'; $flash='Invalid item, tried searching for '.$slug;}
					$this->Session->setFlash($flash, 'flash_warning');
					//return $this->redirect(array('action' => 'index',$searchvar.$slug));	
				}
			}
		}
		else{
			//this means there was no slug OR ?id query
			$this->redirect(array('action' => 'index') + $this->request->params['named']);	
		}
		
		//don't publish editcodes and email addresses, unset them
		$i=0;
		foreach ($treasure['Usergal'] as $val){
			unset($treasure['Usergal'][$i]['email']);
			unset($treasure['Usergal'][$i]['editcode']);
			$i++;
		}
		//sj- begin comments stuff
		$user=$this->Auth->user();
		if (isset($user)) $this->set('user',$user);
		else {
			$user['id']=null;
			$user['provider']=null;
		}
		//use Comment component to load up view variables
		$comments=$this->Comment->getComments($treasure['Treasure']['id'],'Treasure',$user['id']);

		//$usercomment=$this->Comment->userComment($treasure['Treasure']['id'],'Treasure',$user['id']);
		$fk=$treasure['Treasure']['id'];
		$model='Treasure';
		$this->set(compact('treasure','comments','slug','user','fk','model'));
		$this->set('_serialize', array('treasure'));
		
		//used as a flag for the Colorbox ajax calls
		if ($this->request->is('ajax')){
			//grab comments so they can be displayed
			foreach ($treasure['Usergal'] as $val){
				if ($val['id']==$this->request->query['vgal'][0]) $ajax=$val;
			}
			$this->set('ajax',$ajax);
		}
		
		//begin Lloyd SEO stuff
		if(!empty($treasure['Treasure']['objtitle']))
			$this->set('TheTitle',$treasure['Treasure']['objtitle'].' - Buffalo Bill Online Collections Search');
		else 
			$this->set('TheTitle',$treasure['Treasure']['accnum'].' - Buffalo Bill Online Collections Search');		
		if(!empty($treasure['Treasure']['gloss']))	
			$this->set('TheDescription',substr($treasure['Treasure']['gloss'],0,118).' - Buffalo Bill Online Collections');
		else
			$this->set('TheDescription',substr($treasure['Treasure']['synopsis'],0,118).' - Buffalo Bill Online Collections');
		if(!empty($treasure['Treasure']['img']))
			$this->set('FeaturedImage','http://collections.centerofthewest.org/zoomify/1/'.str_replace(' ','_',$treasure['Treasure']['img']).'/TileGroup0/0-0-0.jpg');
	}
	
	//these functions are for the CFM study gallery kiosks (that get used TONS!!)
	public function cfmsg() {
		$this->layout='kiosk';		
		$this->Prg->commonProcess();
		$this->Treasure->recursive = 0;
		$this->Session->delete('scond');
		
		$this->Session->delete('backto');
		$var=$this->params['named'];
		$var['action']='cfmsg';
		$this->Session->write('backto',$var);	
		
		$bquery['Treasure.location LIKE']='cfm.sg%';
		$search = $this->Treasure->parseCriteria($this->Prg->parsedParams());	
		$mega = array_merge($search,$bquery);	
		$sortord=array('Treasure.homeflag'=>'desc','Treasure.img'=>'desc');
		$this->Paginator->settings = array('conditions' => $mega,'order'=>$sortord,'limit'=>'24');
		$treasures=$this->paginate('Treasure');
		$this->Session->write('scond',$mega);
		$this->set('treasures', $treasures);
	}
	
	public function cfmview($slug = null) {
		$this->layout='kiosk';		
		//use sessions vars to give conditions to prev and next buttons, and also Return to Search results
		$this->set('backto',$this->Session->read('backto'));
		$mega=$this->Session->read('scond');
		//this handy line will set a redirect back here if the user logins in (so include this any page someone might login)
		$this->Session->write('Auth.redirect', $this->here);
		if (is_null($slug)==false){
			$treasure = $this->Treasure->findBySlug($slug);
			$neighbors = $this->Treasure->find('neighbors', array('field'=>'slug','value'=>$slug,'conditions'=>$mega,'recursive'=>0));
			$this->set('neighbors',$neighbors);
			if (empty($treasure)){	
				$cnt=$this->Treasure->find('count',array('conditions'=>array('Treasure.slug LIKE'=>'%'.$slug.'%')));
				//even though invalid slug, there is only one item like it, so give it to them
				//might be a faster way to do this...
				if ($cnt == 1){
					$treasure=$this->Treasure->find('first',array('conditions'=>array('Treasure.slug LIKE'=>'%'.$slug.'%')));
					$this->redirect(array('action' => 'view', $treasure['Treasure']['slug']));
				}
				else{
					if ($cnt > 1){$searchvar='slug:'; $flash='Found more than one item like '.$slug;}
					if ($cnt < 1){$searchvar='searchall:'; $flash='Invalid item, tried searching for '.$slug;}
					$this->Session->setFlash($flash, 'flash_danger');
					return $this->redirect(array('action' => 'index',$searchvar.$slug));	
				}
			}
		}
		else{
			//no passed params 
			$this->redirect(array('action' => 'index') + $this->request->params['named']);	
		}
		
		//don't publish editcodes and email addresses, unset them
		$i=0;
		foreach ($treasure['Usergal'] as $val){
			unset($treasure['Usergal'][$i]['email']);
			unset($treasure['Usergal'][$i]['editcode']);
			$i++;
		}
				
		$this->set('treasure', $treasure);

		if(!empty($treasure['Treasure']['objtitle']))
			$this->set('TheTitle',$treasure['Treasure']['objtitle'].' - Buffalo Bill Online Collections Search');
		else 
			$this->set('TheTitle',$treasure['Treasure']['accnum'].' - Buffalo Bill Online Collections Search');
		
		if(!empty($treasure['Treasure']['gloss']))	
			$this->set('TheDescription',substr($treasure['Treasure']['gloss'],0,118).' - Buffalo Bill Online Collections');
		else
			$this->set('TheDescription',substr($treasure['Treasure']['synopsis'],0,118).' - Buffalo Bill Online Collections');
			
		$this->set('FeaturedImage','http://collections.centerofthewest.org/zoomify/1/'.str_replace(' ','_',$treasure['Treasure']['img']).'/TileGroup0/0-0-0.jpg');			
	}

	//"My Exhibit" - possibly not the right MVC conventions or proper Controller, but it was made rapidly
	public function pack() {
		$this->Components->load('Security');
		//if the pack is empty redirect them, this only triggers when
		$variable=$this->Cookie->read('vgal');
		if (empty($variable)){
			$this->Session->setFlash('Your virtual gallery is empty, add some items to get started.','flash_warning');
			$this->redirect(array('controller'=>'treasures','action' => 'index'));
		}
	
		$this->loadModel('Usergal');
		$this->loadModel('TreasuresUsergal');
		$cquery=array();
		//AYAH stuff
		//require_once("ayah.php");
		//$ayah = new AYAH();
		//$this->set('ayah',$ayah->getPublisherHTML());
		$editcook=$this->Cookie->read('editflag');
		$jids=explode(" ",$this->Cookie->read('vgal'));
		//assign a key=>value matching pair from JS cookie 'vgal'
		$njids=array();
		foreach ($jids as $k=>$v) $njids[$v]=$v;
		$trcook=$njids;	
		unset($njids['']);

		//first do the crafty left Join to sort by proper order if editing
		if (!empty($editcook)){
			$id=key($editcook);
			$id=intval($id);
			$this->loadModel('TreasuresUsergal');
			$this->TreasuresUsergal->recursive = 1;
			
			$options['conditions']=array('TreasuresUsergal.usergal_id'=>$id);
			$options['contain']=array('Treasure');
			$options['order']=array('TreasuresUsergal.ord'=>'asc');
			$options['limit']=100;
			$this->Paginator->settings = $options;
			$savedtreasures=$this->Paginator->paginate('TreasuresUsergal');
			
			
			//remove saved treasures from the cookie, otherwise they display twice (as they are both in Cookie and DB)
			foreach ($savedtreasures as $k=>$v) unset($trcook[$v['Treasure']['id']]);
		}
		//find the treasures in the cookie but not already saved so we can add to bottom
		$this->Treasure->recursive = 0;
		$limit = 100;
		$sortord=array('Treasure.slug'=>'asc');
		if (isset($this->params['named']['n'])&&$this->params['named']['n']<=100) $limit = $this->params['named']['n'];
		//begin the cquery
		$temp_array = &$cquery;
		foreach ($trcook as $key=>$item){
			$temp_array = &$temp_array['OR'];
			$temp_array['Treasure.id LIKE '] =$key;
		}
		
		if (!empty($editcook)){
			$id=key($editcook);
			$id=intval($id);
		}
		
		//if $cquery is empty then skip this part or you'll find everything
		if(!empty($cquery)){
			$this->Paginator->settings = array('conditions' => $cquery,'order'=>$sortord,'limit'=>$limit);
			$treasures=$this->paginate('Treasure');
		}
		if (!empty($savedtreasures)){
			if (!empty($treasures)){
				foreach ($treasures as $k=>$v) array_push($savedtreasures,$v);
			}
			$treasures=$savedtreasures;
		}
		if (empty($treasures)){
			//something went wrong, because either the COOKIE or the DATA should've had something
		}
		$user=$this->Auth->user();
		$this->set(compact('treasures','limit','user'));
		
		//now the post stuff
		if ($this->request->is('post','put','ajax')) {
			$jids=explode(" ",$this->Cookie->read('vgal'));
			$njids=array();
			foreach ($jids as $k=>$v){
			$njids[$v]=$v;
			}
			$trcook=$njids;
			
			if(!empty($editcook)){
				$this->Usergal->save($this->request->data);
				$lastid=$id;
			}
			else {
				$this->Usergal->create();
				//set user_id, rather crude - but I think the above $editcook save will prevent zaniness
				if (isset($user['id'])){
					$this->request->data['Usergal']['user_id']=$user['id'];
				}
				else {
					$this->request->data['Usergal']['user_id']=$this->request->data['Usergal']['email'];
				}
				$usergal['Usergal']=$this->request->data['Usergal'];
				//need to fix this right here left off
				if ($this->Usergal->save($usergal)) {
					$lastid = $this->Usergal->getInsertID();
				}
				else {
					//debug('bad');
					debug($this->User->invalidFields());
					$this->Session->setFlash('The gallery could not be saved. Please try again.','flash_danger');
				}
			}
			$this->TreasuresUsergal->deleteAll(array('usergal_id'=>$lastid), $cascade=false);
			foreach ($treasures as $key => $value) {
				//make sure cookie contains the id - otherwise it was removed
				if (array_key_exists($value['Treasure']['id'],$trcook)){
					$sortord=$this->request->data['Usergal']['sortord'][$value['Treasure']['id']];
					$comments=$this->request->data['Usergal']['comments'][$value['Treasure']['id']];
					$treasuredata = array(
						'TreasuresUsergal' => array(
						'usergal_id'=> $lastid,'treasure_id'=>$value['Treasure']['id'],
						//no longer needed as we use argusid as id 'argusid'=>$value['Treasure']['oldid'],
						'comments'=>$comments,'ord'=>$sortord)
					);
					$this->TreasuresUsergal->create();
					$this->TreasuresUsergal->save($treasuredata);
				}
			}	
			if (!empty($editcook)) $note='updated';
			else {
				//write the edit cookie for them
				$note='created';
				$this->Usergal->recursive=0;
				$forcook=$this->Usergal->find('list',array('conditions'=>array('Usergal.id'=>$lastid),'fields'=>array('Usergal.editcode')));
				$newcook[key($forcook)]=$forcook[key($forcook)];
				$this->Cookie->write('editflag',$newcook);
			}
				$this->Session->setFlash('Your Virtual Exhibit has been '.$note.'. Share it with your friends and check back for comments.','flash_success');
				$this->redirect(array('controller'=>'usergals','action' => 'view',$lastid));
		}
		else {
			if (!empty($editcook)){
				//this part fills in fields for edits
				$this->Usergal->recursive=0;
				$this->TreasuresUsergal->recursive=-1;
				$ugal=$this->Usergal->findById($id);
				$this->request->data=$ugal;
				
				$rel=$this->TreasuresUsergal->findAllByUsergal_id($ugal['Usergal']['id']);
				foreach ($rel as $val){
					$this->request->data['Usergal']['comments'][$val['TreasuresUsergal']['treasure_id']]=$val['TreasuresUsergal']['comments'];
				}
			}
		}
	}
	
	//just deletes now, could be merged with other controller but why bother right now
	public function dopack() {
		$this->autoRender=false;
		$yum=$this->Cookie->read('Treasure');
		$this->Treasure->recursive = 0;
		if (!empty($this->request->query['c'])){
			$this->Cookie->delete('editflag');
			$this->Cookie->delete('vgal');
			$this->Session->setFlash('Exhibit emptied', 'flash_success');
			return $this->redirect(array('action'=>'index','controller'=>'treasures'));
		}
		if (!empty($this->params['named']['d'])&&$this->Cookie->read('editflag')){
			$edit=$this->Cookie->read('editflag');
			$this->loadModel('Usergal');
			$id=key($edit);
			//check the code contents, otherwise anyone can delete anything if they edit their cookie
			$cond=array('Usergal.id'=>$id,'Usergal.editcode'=>$edit[$id]);
			$fld=array('Usergal.id','Usergal.editcode');
			$gotone=$this->Usergal->find('first',array('conditions'=>$cond,'fields'=>$fld,'contain'=>false));
			$this->loadModel('TreasuresUsergal');
			$this->TreasuresUsergal->deleteAll(array('usergal_id'=>$id), $cascade=false);
			$this->Usergal->id=$id;
			$this->Usergal->delete();
			$this->Cookie->delete('editflag');
			$this->Cookie->delete('vgal');
			$this->Session->setFlash('Exhibit deleted', 'flash_danger');
		}
		//send back from whence they came
		return $this->redirect($this->referer());
	}
	
	public function google_search_page(){
		//$this->layout=false;
	}
	
	public function about() {
	if (isset($this->request->query['src'])) $this->request->data['message']="ERROR REPORT \n".$this->request->query['error']."\n".$this->request->query['src'];

		if ($this->request->is('post')) {
			//send an e-mail reads addresses from private config file
			$Email = new CakeEmail();
			$Email->from('forms@centerofthewest.org')
				->to('web@centerofthewest.org')
				->subject('Online Collections Feedback')
				->send(
				"From: ".$this->request->data['Feedback']['email']."\n\n\n".
				$this->request->data['Feedback']['message']
				);
			//$this->render(false);
			$this->Session->setFlash('Your message was sent! Thank you.','flash_success');
			
			if ($this->Session->read('location')) $this->redirect($this->Session->read('location'));
			else $this->redirect('/');
		}
		$this->set('TheTitle','Offer Feedback');
	}
}