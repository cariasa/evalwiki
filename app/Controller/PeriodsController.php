<?php

class PeriodsController extends AppController {
	public function beforeFilter() {
		if (!$this->Session->check('User.id')) {
			$this->redirect(array('controller' => 'users', 'action' => 'logIn'));
		}
	}

	public function beforeRender() {
		$this->layout = 'normal';
		$this->set('title_for_layout', 'Periodo');
		$this->set('name', $this->Session->read('User.name'));
	}

	public function index() {
		$this->redirect(array('action' => 'view'));
	}

	public function view() {
		$periods = $this->Period->find('all', array('fields' => array('Period.id', 'Period.semester', 'Period.period', 'Period.year')));
		if (count($periods) == 0) {
			$this->Session->setFlash('No hay periodos.', 'failure', array(), 'failure');
			$this->set('periods', null);
		} else  {
			$this->set('periods', $periods);
		}
	}

	public function add() {
		if (!empty($this->request->data)) {
			if ($this->Period->save($this->request->data)) {
				$this->Session->setFlash('El periodo fue agregado exitosamente!', 'success-dismissable', array(), 'success-dismissable');
			} else {
				$this->Session->setFlash('Ha ocurrido un error.', 'failure-dismissable', array(), 'failure-dismissable');
			}
		}
	}

	public function edit() {
		if ($this->request->named) {
			$period = $this->Period->find('first', array('conditions' => array('Period.id' => $this->request->named['id'])));
			$this->set('period', $period);
		} elseif ($this->request->data) {
			$this->Period->read(null, $this->request->data['Period']['id']);
			$this->Period->set($this->request->data['Period']);
			if ($this->Period->save()) {
				$this->Session->setFlash('El periodo se ha actualizado exitosamente!', 'success-dismissable', array(), 'success-dismissable');
				$this->redirect(array('action' => 'view'));
			} else {
				$this->Session->setFlash('Ha ocurrido un error.', 'failure-dismissable', array(), 'failure-dismissable');
			}
		} else {
			$this->redirect(array('action' => 'view'));
		}
	}
}