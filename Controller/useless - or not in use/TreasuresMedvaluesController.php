<?php
App::uses('AppController', 'Controller');
/**
 * TreasuresMedvalues Controller
 *
 * @property TreasuresMedvalue $TreasuresMedvalue
 * @property PaginatorComponent $Paginator
 */
class TreasuresMedvaluesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->TreasuresMedvalue->recursive = 0;
		$this->set('treasuresMedvalues', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->TreasuresMedvalue->exists($id)) {
			throw new NotFoundException(__('Invalid treasures medvalue'));
		}
		$options = array('conditions' => array('TreasuresMedvalue.' . $this->TreasuresMedvalue->primaryKey => $id));
		$this->set('treasuresMedvalue', $this->TreasuresMedvalue->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TreasuresMedvalue->create();
			if ($this->TreasuresMedvalue->save($this->request->data)) {
				$this->Session->setFlash(__('The treasures medvalue has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The treasures medvalue could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->TreasuresMedvalue->exists($id)) {
			throw new NotFoundException(__('Invalid treasures medvalue'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->TreasuresMedvalue->save($this->request->data)) {
				$this->Session->setFlash(__('The treasures medvalue has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The treasures medvalue could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('TreasuresMedvalue.' . $this->TreasuresMedvalue->primaryKey => $id));
			$this->request->data = $this->TreasuresMedvalue->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->TreasuresMedvalue->id = $id;
		if (!$this->TreasuresMedvalue->exists()) {
			throw new NotFoundException(__('Invalid treasures medvalue'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->TreasuresMedvalue->delete()) {
			$this->Session->setFlash(__('The treasures medvalue has been deleted.'));
		} else {
			$this->Session->setFlash(__('The treasures medvalue could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
