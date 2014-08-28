<?php
App::uses('AppController', 'Controller');

class MobileController extends AppController {

	public $components = array('Paginator');


	public function index() {
		$this->layout='mobile';
		/* all done via Ajax and native API at the moment
		$this->loadModel('Treasure');
		$this->Treasure->recursive = 0;
		$limit=20;
		$sortord=array('Treasure.homeflag'=>'desc');
		$mega=array('Treasure.synopsis LIKE'=>'%red%');
		$this->Paginator->settings = array('conditions' => $mega,'order'=>$sortord,'limit'=>$limit);
		$this->set('treasures', $this->Paginator->paginate('Treasure'));
		*/
	}
	
	public function dialog(){
		$this->layout='mobile';
	}
	
	public function view($slug=null){
		if (is_null($slug)==false){
			$this->loadModel('Treasure');
			$this->layout='mobile';
			$treasure = $this->Treasure->findBySlug($slug);
			$this->set('t',$treasure);
		}
		else {
			$this->Session->setFlash(__('Sorry, that object was not found'));
			return $this->redirect(array('action' => 'index'));
		}
	}

/* baked functions for reference	
	public function view($id = null) {
		if (!$this->TreasuresUsergal->exists($id)) {
			throw new NotFoundException(__('Invalid treasures usergal'));
		}
		$options = array('conditions' => array('TreasuresUsergal.' . $this->TreasuresUsergal->primaryKey => $id));
		$this->set('treasuresUsergal', $this->TreasuresUsergal->find('first', $options));
	}
	

	public function add() {
		if ($this->request->is('post')) {
			$this->TreasuresUsergal->create();
			if ($this->TreasuresUsergal->save($this->request->data)) {
				$this->Session->setFlash(__('The treasures usergal has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The treasures usergal could not be saved. Please, try again.'));
			}
		}
	}

	public function edit($id = null) {
		if (!$this->TreasuresUsergal->exists($id)) {
			throw new NotFoundException(__('Invalid treasures usergal'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->TreasuresUsergal->save($this->request->data)) {
				$this->Session->setFlash(__('The treasures usergal has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The treasures usergal could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('TreasuresUsergal.' . $this->TreasuresUsergal->primaryKey => $id));
			$this->request->data = $this->TreasuresUsergal->find('first', $options);
		}
	}

	public function delete($id = null) {
		$this->TreasuresUsergal->id = $id;
		if (!$this->TreasuresUsergal->exists()) {
			throw new NotFoundException(__('Invalid treasures usergal'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->TreasuresUsergal->delete()) {
			$this->Session->setFlash(__('The treasures usergal has been deleted.'));
		} else {
			$this->Session->setFlash(__('The treasures usergal could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	*/
	}
