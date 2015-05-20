<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail','Network/Email');

class UsergalsController extends AppController {

public $components = array('Auth'=>array('loginRedirect'=>''),'Paginator','Search.Prg'=>array('commonProcess'=>array('keepPassed'=>false)),'RequestHandler','Cookie'
);
	public $paginate = array(
       // 'Treasure2' => array ()
    );
	
	public function beforeFilter() {
		parent::beforeFilter();
		//five years of pure awesome
		//$this->Cookie->time = 157680000000;
		$this->Auth->allow();
		$this->Auth->deny('mine');

		//isAdmin isn't always set in CommentsPlugin when it should be, this has fixed it so far
		$isAdmin = (bool)$this->Auth->user('is_admin');
		$this->set('isAdmin',$isAdmin);
		
		/* deal with the strange pagination glitch, without this a Not Found exception this thrown
		there is little documentation on this, but the basic consensus is the manual JOINS with Pagination
		invoke demons. For the rest of the code, see the $options set in the view function.
		
		UPDATE: but this breaks pagination on the index as well....
		*/
		if (isset($this->params['named']['page']) && $this->params['action']=='view'){
			$newurl=$this->params['named'];
			$pg=$newurl['page'];
			unset($newurl['page']);
			$newurl['p']=$pg;
			$this->redirect(array('action' => 'view/'.$this->params['pass'][0])+$newurl);
		}
		
	}



//for logged in users to see all of their vgals and comments
	public function mine() {
		/* writes editflag -revalidate User Auth otherwise anyone could edit anything with this..
		but this seems better than passing the editcode around in plain text.  */
		if (!empty($this->params['named']['ed'])){
		$cont=array('Treasure'=>array('fields'=>array('Treasure.id')));
		$val=$this->Usergal->find('first',array('conditions'=>array('Usergal.id'=>$this->params['named']['ed']),'contain'=>$cont));
			
		//validate Auth user - otherwise params could be tampered with
			if (!empty($val['Usergal']['email'])&&($val['Usergal']['email']==$this->Auth->user('email'))){
				
					$forcook=array($val['Usergal']['id']=>$val['Usergal']['editcode']);
					$trval=array();
					foreach ($val['Treasure'] as $tr){
						array_push($trval, $tr['id']);
					
					}
					$trval=implode(" ",$trval);
					$this->Cookie->write('editflag',$forcook);
					
					//no, the write will not work! Need to use JS to write plainText such as on Load function
						$scr = '<script type="text/javascript">dropCookie("vgal");setCookie("'.$trval.'");
							<!--
							window.location = "../treasures/pack/"
							//-->
							</script>';
						$this->Cookie->write('cgal',$scr);
						//then redirect to Load page, which will call the JS
					$this->redirect(array('controller'=>'usergals','action'=>'load'));
			
			}
		}
		
		$this->Usergal->recursive=-1;
		$usergals=$this->Usergal->findAllByEmail($this->Auth->user('email'));
		$this->set('usergals',$usergals);

		
		//here is a construction of a Tree manually for Paginator, the order is important 
		$options['conditions']=array('Comment.user_id'=>$this->Auth->user('id'));
		$options['order']=array('Comment.lft' => 'asc');
		$options['limit']=10;
		$options['contain']=false;

	}
	
	public function index() {
		$this->Prg->commonProcess();
		$this->Usergal->recursive = -1;
		$search=$this->Usergal->parseCriteria($this->Prg->parsedParams());
		$listed['AND']=array('Usergal.listed'=>1);
		$pwr=array_merge($search,$listed);
		
		//sj - added querystring check so we can only return featured
		if (isset($this->request->query['f'])){
			$pwr['AND']['Usergal.featured']=1;	
		}
		
		$this->Paginator->settings['conditions'] = $pwr;
		$this->Paginator->settings['order'] = array('Usergal.created'=>'desc');
		$this->Paginator->settings['limit'] = 10;
		$usergals=$this->Paginator->paginate();
		//clean out personal info and make count
		$x=0;
		foreach ($usergals as $val=>$key){
			unset($usergals[$x]['Usergal']['email']);
			unset($usergals[$x]['Usergal']['editcode']);
			$usergals[$x]['Usergal']['count']=$this->Usergal->TreasuresUsergal->find('count',array('conditions'=>array('TreasuresUsergal.usergal_id'=>$usergals[$x]['Usergal']['id'])));
			$x++;
			
		}
		$this->set(compact('usergals'));	

		/* 
		//calling this on our homepage made it crash a bunch, not sure why but we don't need it anyway
		$usergalclean = $this->Paginator->paginate();
		//debug($usergalclean[0]);
		$x=0;
		foreach ($usergalclean as $val=>$key){
		//debug($val);
			unset($usergalclean[$x]['Usergal']['email']);
			unset($usergalclean[$x]['Usergal']['editcode']);
			$x++;
		}

		$this->set('usergalclean',$usergalclean);
		$this->set('_serialize',array('usergalclean'));
		*/
	}
	
		//loads a usergal into cookie for them, even if not on the web
	public function load() 
	{
		//The sole purpose is to write the CakeCookie w/ JS so its in plain text, you could set this cookie anywhere (see 'mine' function, for example) and then redirect here
		$this->set('scr',$this->Cookie->read('cgal'));
		$this->Cookie->delete('cgal');

		$this->Components->load('Security');
		//AYAH stuff
		/*
		require_once("ayah.php");
		$ayah = new AYAH();
		$this->set('ayah',$ayah->getPublisherHTML());
		*/
		$txt=null;
		if ($this->request->is('post')) 
		{
			if(!empty($this->data['Load']['email']))
			{
				$this->Usergal->recursive = -1;
				$cond = array('Usergal.email'=>$this->data['Load']['email']);
				$gals=$this->Usergal->find('all',array('conditions'=>$cond,'fields'=>array('Usergal.id','Usergal.editcode','Usergal.name')));
				
				if(!empty($gals))
				{
					
					foreach ($gals as $gal)
					{
						$txt=$txt."\n".'Name: '.$gal['Usergal']['name']."\n".'Code: '.$gal['Usergal']['id'].'-'.$gal['Usergal']['editcode']."\n";
					}
					$Email = new CakeEmail();
					$Email->from(array('forms@centerofthewest.org' => 'Center of the West'));
					$Email->to($this->data['Load']['email']);
					$Email->subject('Here are your Edit Codes');
					$Email->send('We found the following Virtual Exhibits associated with this e-mail:'."\n\n\n".$txt."\n\n\n".
						 'You can edit your Virtual Exhibits at http://collections.centerofthewest.org/usergals/load'."\n".
						 'or create an account to easily access all your Virtual Galleries and comments. Registration is fast and free.'
						);
					$this->Session->setFlash(__('Your edit codes have been e-mailed.'));
					return $this->redirect(array('action' => 'load'));
				}
				else 
				{
					$this->Session->setFlash(__("No virtual galleries seem to be associated with that e-mail."));
					return $this->redirect(array('action' => 'load'));
				}
			}
			$editcode=substr(strstr($this->request->data['Load']['editcode'],'-'),1);
			$id=strstr($this->request->data['Load']['editcode'],'-',true);
			$cond = array('Usergal.editcode'=>$editcode,'Usergal.id'=>$id);
			$data=$this->Usergal->find('first',array('conditions'=>$cond));
		
			if(!empty($data))
			{
				$forcook[$id]=$editcode;
				$this->Cookie->write('editflag',$forcook);
				$jscook='';
				foreach($data['Treasure'] as $val) $jscook=$jscook.' '.$val['id'];
					$jscook=trim($jscook);

				//write a little JS to make the cookie with JS and redirect them
				$scr = '<script type="text/javascript">dropCookie("vgal");setCookie("'.$jscook.'");
				<!--
				window.location = "../treasures/pack/"
				//-->
				</script>';
				$this->set('scr',$scr);
			}
			//nothing found
			else
			{
				$this->Session->setFlash(__('No matches found.'));
				return $this->redirect(array('action' => 'load'));
			}
		}
	}
	
	public function view($id = null) {
		$this->set('TWshorturl',substr($this->UrlShortener->get_bitly_short_url('http://collections.centerofthewest.org'.$this->here.'?utm_source=twitterk&utm_campaign=onlinecollections'),0,-1));					
		$this->loadModel('Treasure');
		$this->Session->delete('scond');
		$this->Treasure->recursive = 2;
		$this->Usergal->recursive = -1;
		$cquery=array();
		$limit=100;
		
		if (!$this->Usergal->exists($id)) {
			throw new NotFoundException(__('Invalid usergal'));
		}
		
		$options = array('conditions' => array('Usergal.' . $this->Usergal->primaryKey => $id));
		$usergal=$this->Usergal->find('first', $options);
		//make flag if 
		$edt=$this->Cookie->read('Treasure.edit');
		$editcode=substr(strstr($edt,'-'),1);
		$gid=strstr($edt,'-',true);

		if($gid==$usergal['Usergal']['id']&&$editcode==$usergal['Usergal']['editcode']){
		$this->set('edit',1);
		}
		$this->Session->write('scond',$cquery);
		//this causes problems, gateway timeout!
		
		$this->loadModel('TreasuresUsergal');
		$this->TreasuresUsergal->recursive = 1;
		//disabled, this can be accomplished with contain and recursion
		
		$options['joins'] = array(
					array(
					'table' => 'images',
					'alias' => 'Image',
					'type' => 'INNER',
					'conditions' => array("Treasure.id = Image.treasure_id","Image.sortorder = 1"),
					)
				);
		
		
		$options['conditions']=array('TreasuresUsergal.usergal_id'=>$id);
		$options['fields']=array('Treasure.*','TreasuresUsergal.*','Image.*');
		//$options['contain']=array('Treasure','Image');
		$options['order']=array('TreasuresUsergal.ord'=>'asc');
		$options['limit']=$limit;
		
		//this is the other part of the pagination fix that was described more in beforeFilter.
		if (isset($this->params['named']['p'])) $options['page']=$this->params['named']['p'];
		$this->Paginator->settings = $options;
		$treasures=$this->Paginator->paginate('TreasuresUsergal');
		$this->set('treasures',$treasures);
		
		//now make API variable without sensitive info
		unset($usergal['Usergal']['editcode']);
		unset($usergal['Usergal']['email']);
		unset($usergal['Usergal']['ip']);
		$this->set('usergal', $usergal);
		$apivar['Usergal']=$usergal;
		$apivar['Items']=$treasures;
		$this->set('apivar',$apivar);
		$this->set('_serialize',array('apivar'));
		
		//lloyd SEO stuff
		$this->set('TheTitle',$usergal['Usergal']['name'].'- Buffalo Bill Online Collections Virtual Exhibits');
		if(!empty($usergal['Usergal']['gloss']))
			$this->set('TheDescription',$usergal['Usergal']['gloss']);
		if(!empty($usergal['Usergal']['img']))
			$this->set('FeaturedImage','http://collections.centerofthewest.org/zoomify/1/'.$usergal['Usergal']['img'].'/TileGroup0/0-0-0.jpg');

	//flag as inappropriate starts
	if ($this->request->is(array('post', 'put'))) {
		if($usergal['Usergal']['flagged']!=1){
			$this->Usergal->id=$usergal['Usergal']['id'];
			$data = array('flagged'=> 1);
			if ($this->Usergal->save($data,array('validate'=>false,'callbacks'=>false))) {
				$Email = new CakeEmail();
				$Email->from(array('forms@centerofthewest.org' => 'Center of the West'));
				$Email->to('web@centerofthewest.org');
				$Email->subject('Virtual gallery has been flagged');
				$Email->send('This has been flagged inappropriate http://collections.centerofthewest.org/usergals/view/'.
				$usergal['Usergal']['id']);
				$this->Session->setFlash(__('Thank you for letting us know, we will review ASAP.'));
			}
			else{
			//debug($this->Usergal->validationErrors);
			}
		}
		else {
			$this->Session->setFlash(__('This item has already been flagged and is awaiting review. Thank you.'));
		}
	}
	}

}
