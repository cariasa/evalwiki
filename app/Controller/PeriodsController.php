<?php

class PeriodsController extends AppController {
	public function beforeFilter() {
		if (!$this->Session->check('User.id')) {
			$this->redirect(array('controller' => 'users', 'action' => 'logIn'));
		}
	}

	public function index() {
		$this->redirect(array('action' => 'view'));
	}

	public function view() {

	}

	public function add() {
		$this->layout = 'normal';
		$this->set('title_for_layout', 'Agregar Periodo');
		$this->set('name', $this->Session->read('User.name'));

		if (!empty($this->request->data)) {
			if ($this->Period->save($this->request->data)) {
				$this->Session->setFlash('El periodo fue agregado exitosamente!', 'success-dismissable', array(), 'success-dismissable');
			} else {
				$this->Session->setFlash('Ha ocurrido un error.', 'failure-dismissable', array(), 'failure-dismissable');
			}
		}
	}

	public function edit() {

	}
}