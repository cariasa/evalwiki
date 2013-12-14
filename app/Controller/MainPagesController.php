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

		$this->loadModel('Page');
		$fields = array('Page.page_id', 'Page.page_title');
		$main_pages_ids = array_values($this->MainPage->find('list', array('fields'=> array('MainPage.page_id'))));
		$conditions = array('NOT' => array('Page.page_id' => $main_pages_ids));
		$order = 'Page.page_title';
		$pages_isnt_main_pages = $this->Page->find('list', array('fields' => $fields, 'conditions' => $conditions, 'order' => $order));
		
		$this->set('pages', $pages_isnt_main_pages);		

	}

	public function view() {
		$this->layout = 'normal';
		$this->set('name', $this->Session->read('User.name'));

		$this->loadModel('Page');
		$db = $this->Page->getDataSource();
		$result = $db->fetchAll('SELECT Page.page_id, MainPage.course_name FROM page Page JOIN main_pages MainPage ON Page.page_id = MainPage.page_id;');
		$this->set('main_pages', $result);
	}

	public function delete() {
		if (!empty($this->request->named)) {
			if ($this->MainPage->delete($this->request->named['id'])) {
				$this->Session->setFlash('Eliminado con éxito!', 'success-dismissable', array(), 'success-dismissable');
			} else {
				$this->Session->setFlash('Ha ocurrido un error.', 'failure-dismissable', array(), 'failure-dismissable');
			}
		} else {
			$this->Session->setFlash('Ha ocurrido un error.', 'failure-dismissable', array(), 'failure-dismissable');
		}
		$this->redirect(array('action' => 'view'));
	}

	public function edit() {
		$this->layout = 'normal';
		$this->set('title_for_layout', 'Actualizar pagina');
		$this->set('name', $this->Session->read('User.name'));


		if (!empty($this->request->data)) {
			//echo $this->request->data['MainPage']['page_id'];
			$this->MainPage->read(null, $this->request->pass);
			$this->MainPage->set($this->request->data['MainPage']);
			if ($this->MainPage->save()) {
				$this->Session->setFlash('El periodo se ha actualizado exitosamente!', 'success-dismissable', array(), 'success-dismissable');
				$this->redirect(array('action' => 'view'));
			} else {
				$this->Session->setFlash('Ha ocurrido un error.', 'failure-dismissable', array(), 'failure-dismissable');
			}
			
		} else  { 
			$this->request->data = $this->MainPage->findBypage_id($this->request->pass);
		} 
	}

}
