<?php
App::uses('AppController', 'Controller');
/**
 * TreasuresUsergals Controller
 *
 * @property TreasuresUsergal $TreasuresUsergal
 * @property PaginatorComponent $Paginator
 */
class TreasuresUsergalsController extends AppController {

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
		$this->TreasuresUsergal->recursive = 0;
		$this->set('treasuresUsergals', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->TreasuresUsergal->exists($id)) {
			throw new NotFoundException(__('Invalid treasures usergal'));
		}
		$options = array('conditions' => array('TreasuresUsergal.' . $this->TreasuresUsergal->primaryKey => $id));
		$this->set('treasuresUsergal', $this->TreasuresUsergal->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
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

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
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

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
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
	}}
