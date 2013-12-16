<?php

class SelectedPagesController extends AppController {
	public function beforeFilter() {
		if (!$this->Session->check('User.id')) {
			$this->redirect(array('controller' => 'users', 'action' => 'logIn'));
		}
	}

	public function beforeRender() {
		$this->layout = 'normal';
		$this->set('title_for_layout', 'Profesores');
		$this->set('name', $this->Session->read('User.name'));
	}

	public function index() {
		$this->redirect(array('action' => 'view'));
	}

	public function view() {
		$this->loadModel('Page');
		$this->loadModel('MainPage');

		$current_page = -1;
		if (!empty($this->request->named)){
			$current_page = $this->request->named['id'];
		}

		$this->set('returnTo', $current_page);

		if ($current_page == -1) {
			$pages = $this->Page->getDataSource()->fetchAll('SELECT Page.page_id, Page.page_title FROM page Page JOIN main_pages MainPages ON Page.page_id = MainPages.page_id;');
			$this->set('pages', $pages);
			$this->set('father', null);
		}else {
			$pages = $this->Page->getDataSource()->fetchAll('SELECT Page.page_id, Page.page_title FROM page Page JOIN pagelinks PL ON PL.pl_title=Page.page_title WHERE PL.pl_from='.$current_page.';');
			$this->set('pages', $pages);
			$father = $this->Page->getDataSource()->fetchAll('SELECT pl_from FROM pagelinks JOIN page ON pl_title=page_title WHERE page_id='.$current_page.';');
			if ($father[0]['pagelinks']['pl_from'] == 1) {
				$this->set('father', -1);
			} else {
				$this->set('father', $father[0]['pagelinks']['pl_from']);
			}
		}

		if (count($pages) == 0) {
			$this->Session->setFlash('No hay paginas que mostrar.', 'failure', array(), 'failure');
		}
	}

	public function manage() {
		if (!$this->Session->check('SelectedPages.evaluate')) {
			$this->Session->setFlash('Debe seleccionar las paginas a evaluar.', 'failure-dismissable', array(), 'failure-dismissable');
			$this->redirect(array('action' => 'view'));
		} else {
			$this->loadModel('Page');
			$selected_pages = $this->Page->find('list', array(
				'fields' => array('Page.page_id', 'Page.page_title'),
				'conditions' => array('Page.page_id' => $this->Session->read('SelectedPages.evaluate'))
			));
			$this->set('selected_pages', $selected_pages);
		}
	}

	public function addPage() {
		if ($this->request->is('get') && !is_null($this->request->named)) {
			if (!$this->Session->check('SelectedPages.evaluate')) {
				$this->Session->write('SelectedPages.evaluate', array($this->request->named['id']));
				$this->Session->setFlash('Se ha añadido la página para calificar.', 'success-dismissable', array(), 'success-dismissable');
			} else {
				$evaluate_pages = $this->Session->read('SelectedPages.evaluate');
				
				if (!in_array($this->request->named['id'], $evaluate_pages)) {
					array_push($evaluate_pages, $this->request->named['id']);
					$this->Session->write('SelectedPages.evaluate', $evaluate_pages);
					$this->Session->setFlash('Se ha añadido la página para calificar.', 'success-dismissable', array(), 'success-dismissable');
				} else {
					$this->Session->setFlash('La página ya está en la lista.', 'failure-dismissable', array(), 'failure-dismissable');
				}

			}
		}
		$this->redirect(array('action' => 'view', 'id' => $this->request->named['returnTo']));
	}

	public function removePage() {

	}

	public function setParameters() {

	}

	public function evaluate() {

	}
}