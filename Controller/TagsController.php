<?php
App::uses('AppController', 'Controller');

class TagsController extends AppController {

	public $components = array('Paginator','Search.Prg','RequestHandler');
	
	public function index() {
		$this->Tag->recursive = -1;
		$this->Tag->Treasure->recursive = -1;
		$this->paginate = array('conditions' => $this->Tag->parseCriteria($this->Prg->parsedParams()),'limit'=>20);

		$this->set('tags', $this->paginate());
		$this->Paginator->settings = array('limit'=>2);		
		debug($this->Paginator->paginate('Treasure'));
	}
	

}
