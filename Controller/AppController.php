<?php
App::uses('Controller', 'Controller');
class AppController extends Controller {

	public $components = array('Users.RememberMe','DebugKit.Toolbar','Session','Cookie','UrlShortener','Auth');
	public $helpers = array(
	//'Chosen.Chosen',
	'Js');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
	//	$this->Security->blackHoleCallback = 'blackhole';
	/* begin the Cookie stuff for the overlay, maybe it should reside on its own function 
		Do not want to use a single array in one cookie because expiration dates need to differ
	*/
		//make sure the overlay hasn't been displayed
		//we'll probably use JS to write this cookie when the time comes
		if (is_null($this->Cookie->read('overlay_displayed'))){
			//counter
			$count=$this->Cookie->read('page_counter');
			$count++;
			
			if ($count > 8){
				//ask LLoyd what variable would be useful, or just some flag?
				//also write to DB?
				//debug('9+ pageviews!');
				//$this->Cookie->write('show_it',1,false, '12 months');
			}
			else $this->Cookie->write('page_counter',$count, false, '5 days');
			
			
			//timer
			$timer=$this->Cookie->read('page_timer');
			if (!empty($timer)){
				$minutes=(time()-$timer)/60;
				if ($minutes > 10){
					//$this->Cookie->write('show_it',1,false, '12 months');
				}
			}
			else {
				$this->Cookie->write('page_timer',time(),false,'12 hours');
			}
		}
		
	/*** END overlay stuff */
		
		$jids=explode(" ",$this->Cookie->read('vgal'));
		//debug($this->Cookie->read('rememberMe'));
		$editflag=$this->Cookie->read('editflag');
		if (!empty($editflag))
		{
			$this->set('edit',1);
		}	
		$this->set('Vgals',$jids);
		$this->set('editflag',$editflag);
		
		$this->set('TWshorturl',$this->UrlShortener->get_bitly_short_url('http://collections.centerofthewest.org'.$this->here.'?utm_source=twitter&utm_campaign=onlinecollections'));	
		
		
		//bitly component giving every view a shorturl to refrence.
		//I am shortening the final bitly url by 1 character from the end of the string because it is returning a line break and breaks twitters script.
		//$this->set('shorturl',substr($this->UrlShortener->get_bitly_short_url('http://collections.centerofthewest.org'.$this->here.''),0,-1));	
		$this->set('FeaturedImage','http://collections.centerofthewest.org/img/featured.jpg');

		//$this->set('BTshorturl',substr($this->UrlShortener->get_bitly_short_url('http://collections.centerofthewest.org'.$this->here.'?utm_source=bitly&utm_campaign=onlinecollections'),0,-1));							
		
		//$this->RememberMe->restoreLoginFromCookie();
		
		//$this->set('loginlink',Router::url(array()));
		
		//set some useful colors
		
		$color=array(
			'brown'=>'#6e3219',
			'blue'=>'#004250',
			'green'=>'#035642',
			'red'=>'#981e32',
			'orange'=>'#bd4f19',
			'purple'=>'#532e60',
			'yellow'=>'#c59217',
			'tan'=>'#aa9c8f'
		);
		
		
		//users plugin uses this to redirect
		if ($this->params['controller']=='treasures' || $this->params['controller']=='usergals') $this->Session->write('location','http://'.$_SERVER['HTTP_HOST'].$this->here);
		
		$this->set(compact('color'));
		
		}

public function blackhole($type) {
    debug($type);
}
		
}