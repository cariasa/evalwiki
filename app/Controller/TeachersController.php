<?php

class TeachersController extends AppController {

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
		$this->set('title_for_layout', 'Agregar profesor');
		$saved = null;
		if (!empty($this->request->data)) {
			//Guardar el registro de profesor
			if ($this->Teacher->save($this->request->data)) {
				$this->Session->setFlash('El usuario fue añadido exitosamente!');
				$saved = true;
			} else {
				$this->Session->setFlash('Ha ocurrido un error.');
				$saved = false;
			}
		}

		$this->set('saved', $saved);

		$this->loadModel('User');
		$fields = array('User.user_id', 'User.user_name');
		$teachers_ids = array_values($this->Teacher->find('list'));
		$conditions = array('NOT' => array('User.user_id' => $teachers_ids));
		$order = 'User.user_name';
		$users_isnt_teachers = $this->User->find('list', array('fields' => $fields, 'conditions' => $conditions, 'order' => $order));
		$users = array();
		
		$this->set('users', $users_isnt_teachers);

	}

	public function view() {
		$this->layout = 'normal';
	}

	public function delete() {

	}
}