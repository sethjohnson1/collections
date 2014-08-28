<?php
App::uses('AppController', 'Controller');

class RelationsController extends AppController {

	public $components = array('Paginator', 'Session');


	public function index() {
		$this->Relation->recursive = 0;
		$this->set('articles', $this->Paginator->paginate());
	}



	public function add() {
		if ($this->request->is('post')) {
			$this->Relation->create();
			//$this->request->data['TreasuresArticle']['argusid']='123';
			//first make sure it appears to be valid
			$treasure=$this->Relation->Treasure->find('first',array('conditions'=>array('Treasure.accnum'=>$this->request->data['Relation']['accnum']),'contain'=>false));
			if (isset($treasure['Treasure'])){
				$this->request->data['Relation']['argusid']=$treasure['Treasure']['oldid'];
				$this->request->data['Relation']['treasure_id']=$treasure['Treasure']['id'];
	
				if ($this->Relation->save($this->request->data)) {
					
					$this->Session->setFlash(__('The article has been saved.'));
					//return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The article could not be saved. Please, try again.'));
				}
			} else {
				$this->Session->setFlash(__('Accession number appears invalid'));
			}
		}
	}


	public function delete($id = null) {
		$this->Relation->id = $id;
		if (!$this->Relation->exists()) {
			throw new NotFoundException(__('Invalid article'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Relation->delete()) {
			$this->Session->setFlash(__('The article has been deleted.'));
		} else {
			$this->Session->setFlash(__('The article could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
