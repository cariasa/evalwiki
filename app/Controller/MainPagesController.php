<?php

class MainPagesController extends AppController {
	public function beforeFilter() {
		if (!$this->Session->check('User.id')) {
			$this->redirect(array('controller' => 'users', 'action' => 'logIn'));
		}
	}

	public function index() {
		$this->redirect(array('action' => 'view'));
	}

	public function add() {
		$this->layout = 'normal';
		$this->set('title_for_layout', 'Agregar pagina');
		$this->set('name', $this->Session->read('User.name'));

		if (!empty($this->request->data)) {
			//Guardar el registro de la pagina
			if ($this->MainPage->save($this->request->data)) {
				$this->Session->setFlash('La pagina fue añadida exitosamente!', 'success-dismissable', array(), 'success-dismissable');
			} else {
				$this->Session->setFlash('Ha ocurrido un error.', 'failure-dismissable', array(), 'failure-dismissable');
			}
		}

		$mainpages_ids = array_values($this->MainPage->find('list'));
				
		$this->set('main_pages', $mainpages_ids);

	}

	public function view() {
		$this->layout = 'normal';

		$this->loadModel('User');
		$db = $this->User->getDataSource();
		$result = $db->fetchAll('SELECT user_id, user_name FROM user User JOIN teachers Teacher ON User.user_id = Teacher.id;');
		$this->set('teachers', $result);
	}

	public function delete() {
		if (!empty($this->request->named)) {
			if ($this->Teacher->delete($this->request->named['id'])) {
				$this->Session->setFlash('Eliminado con éxito!', 'success-dismissable', array(), 'success-dismissable');
			} else {
				$this->Session->setFlash('Ha ocurrido un error.', 'failure-dismissable', array(), 'failure-dismissable');
			}
		} else {
			$this->Session->setFlash('Ha ocurrido un error.', 'failure-dismissable', array(), 'failure-dismissable');
		}
		$this->redirect(array('action' => 'view'));
	}
}
