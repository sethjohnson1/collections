<?php
App::uses('AppController', 'Controller');

class MedvaluesController extends AppController {
	public $components = array('Paginator','RequestHandler',
		'Search.Prg'=>array(
			//newer version of search plugin defaults to querystring, we have lots of work to do before we're ready for that...
			'commonProcess'=>array('keepPassed'=>false,'paramType'=>'named'),
			'presentForm'=>array('paramType'=>'named')
		)
	);

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
			return true;
		}
		else {
			if (isset($this->params['named']['n'])&&$this->params['named']['n']<=100){
				$limit = $this->params['named']['n'];
			}	
			$this->paginate = array('conditions' => $this->Medvalue->parseCriteria($this->Prg->parsedParams()),'order'=>$sortord,'limit'=>$limit);
			$medvalues=$this->paginate();		
		}
		if (!empty($this->params['named']['pXv_9gg'])) {
			$parms=$this->params['named'];
			unset($parms['url']);
			$parms['page']=$parms['pXv_9gg'];
			unset($parms['pXv_9gg']);
			$parms['action']='index';
			$this->redirect($parms);
		}
		$this->set('medvalues', $medvalues);
		$this->set('limit', $limit);
		$this->set('_serialize', array('medvalues'));	
	}
}
