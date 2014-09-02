<?php
App::uses('AppController', 'Controller');

class MakersController extends AppController {
	public $components = array('Paginator','Search.Prg','RequestHandler');
	
	public function index() {
		$this->Prg->commonProcess();
		$this->Maker->recursive = -1;
		$aquery=array();
		$limit=25;
		$sortord=array('Maker.num'=>'desc');
		if (isset($this->request->query['name']) || isset($this->request->query['slug'])){
			foreach ($this->request->query as $key => $value){
				if (
					$key == 'name' || 
					$key == 'slug'
					)
				{
					$aquery['Maker.'.$key.' LIKE '] ='%'.$value . '%';
				}
			}
			$makers=$this->paginate = array('conditions' => $aquery,'order'=>$sortord,'limit'=>$limit);
			
			//redirect to the proper page if not empty, cakePHP pagination takes care of the logic if the url has page: in it
			//$this->set('_serialize', array('makers'));
			//$this->set('makers',$makers);
			return true;
		}
		else {
			if (isset($this->params['named']['n'])&&$this->params['named']['n']<=100){
				$limit = $this->params['named']['n'];
			}
		    $this->paginate = array('conditions' => $this->Maker->parseCriteria($this->Prg->parsedParams()),'order'=>$sortord,'limit'=>$limit);
			$makers=$this->paginate();		
		}
		if (!empty($this->params['named']['pXv_9g'])&&$this->params['named']['pXv_9g']<=$this->params['paging']['Maker']['pageCount']) {  
			$nurl = str_replace("/pXv_9g:","/page:",$this->params['url']);
			$this->redirect($nurl);
		}		
		$this->set('makers', $makers);
		$this->set('limit', $limit);
		$this->set('_serialize', array('makers'));
	}
}
