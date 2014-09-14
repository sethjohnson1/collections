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
		$jids=explode(" ",$this->Cookie->read('vgal'));
		//debug($this->Cookie->read('rememberMe'));
		$editflag=$this->Cookie->read('editflag');
		if (!empty($editflag))
		{
				$this->set('edit',1);
		}	
		$this->set('Vgals',$jids);
		$this->set('editflag',$editflag);
		//bitly component giving every view a shorturl to refrence.
		//I am shortening the final bitly url by 1 character from the end of the string because it is returning a line break and breaks twitters script.
		//$this->set('shorturl',substr($this->UrlShortener->get_bitly_short_url('http://collections.centerofthewest.org'.$this->here.''),0,-1));	
		$this->set('FeaturedImage','http://collections.centerofthewest.org/img/featured.jpg');

		//$this->set('BTshorturl',substr($this->UrlShortener->get_bitly_short_url('http://collections.centerofthewest.org'.$this->here.'?utm_source=bitly&utm_campaign=onlinecollections'),0,-1));							
		
		//$this->RememberMe->restoreLoginFromCookie();
		}
		
}