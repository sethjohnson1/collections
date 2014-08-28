<?php
App::uses('AppController', 'Controller');

class MedvaluesController extends AppController {
	public $components = array('Paginator','Search.Prg','RequestHandler');

		public function index() {
		$this->Prg->commonProcess();
		$this->Medvalue->recursive = -1;
		$aquery=array();
		$limit=25;
		$sortord=array('Medvalue.num'=>'desc');
		if (isset($this->request->query['name']) || isset($this->request->query['slug'])){
			foreach ($this->request->query as $key => $value){
				if (
					$key == 'name' || 
					$key == 'slug'
					)
				{
				$aquery['Medvalue.'.$key.' LIKE '] ='%'.$value . '%';
				}
			}
			$medvalues=$this->paginate = array('conditions' => $aquery,'order'=>$sortord,'limit'=>$limit);
			//$this->set('_serialize', array('medvalues'));
			//$this->set('medvalues',$medvalues);
			return true;
			}
		else {
		
			if (isset($this->params['named']['n'])&&$this->params['named']['n']<=100){
				$limit = $this->params['named']['n'];
			}	
		
		     $this->paginate = array('conditions' => $this->Medvalue->parseCriteria($this->Prg->parsedParams()),'order'=>$sortord,
			 'limit'=>$limit);
			//$this->Paginator->settings['conditions'] = $this->Medvalue->parseCriteria($this->Prg->parsedParams());
			$medvalues=$this->paginate();		
		}
		if (!empty($this->params['named']['pXv_9g'])&&$this->params['named']['pXv_9g']<=$this->params['paging']['Medvalue']['pageCount']) {  
				$nurl = str_replace("/pXv_9g:","/page:",$this->params['url']);
				$this->redirect($nurl);
		}		
		
		$this->set('medvalues', $medvalues);
		$this->set('limit', $limit);
		$this->set('_serialize', array('medvalues'));	}
}
