<?php

class TeachersController extends AppController {

	public function beforeFilter() {
		if (!$this->Session->check('User.id')) {
			$this->redirect(array('controller' => 'users', 'action' => 'logIn'));
		}
	}

	public function beforeRender() {
		$this->layout = 'normal';
		$this->set('title_for_layout', 'Agregar profesor');
		$this->set('name', $this->Session->read('User.name'));
	}

	public function index() {
		$this->redirect(array('action' => 'view'));
	}

	public function add() {
		if (!empty($this->request->data)) {
			//Guardar el registro de profesor
			if ($this->Teacher->save($this->request->data)) {
				$this->Session->setFlash('El usuario fue añadido exitosamente!', 'success-dismissable', array(), 'success-dismissable');
			} else {
				$this->Session->setFlash('Ha ocurrido un error.', 'failure-dismissable', array(), 'failure-dismissable');
			}
		}

		$this->loadModel('User');
		$fields = array('User.user_id', 'User.user_name');
		$teachers_ids = array_values($this->Teacher->find('list'));
		$conditions = array('NOT' => array('User.user_id' => $teachers_ids));
		$order = 'User.user_name';
		$users_isnt_teachers = $this->User->find('list', array('fields' => $fields, 'conditions' => $conditions, 'order' => $order));
				
		$this->set('users', $users_isnt_teachers);

	}

	public function view() {
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