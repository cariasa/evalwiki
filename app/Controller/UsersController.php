<?php 

class UsersController extends AppController {

	public function index() {
		$this->redirect(array('action' => 'logIn'));
	}

	public function login() {
		if ($this->Session->check('User.id')) {
			$this->redirect(array('action' => 'home'));
		}

		$this->layout = 'only_bar';
		$this->set('title_for_layout', 'Log In');

		if (!empty($this->request->data)) {
			$user = $this->request->data['User']['name'];
			$pass = $this->request->data['User']['password'];

			$correct_password = $this->User->find('first', array(
				'fields' => array('User.user_id', 'User.user_password'),
				'conditions' => array('User.user_name' => $user)
				));
			
			if (!$correct_password) {
				$this->Session->setFlash('El usuario y/o contraseña no son correctos');
			} else {
				$pass_parts = preg_split('/[:]/', $correct_password['User']['user_password']);
				if ($pass_parts[3] == md5($pass_parts[2]."-".md5($pass))) {
					$this->Session->write('User.id', $correct_password['User']['user_id']);
					$this->redirect(array('action' => 'home'));
				} else {
					$this->Session->setFlash('El usuario y/o contraseña no son correctos');
				}
			}
		}
	}

	public function home() {
		if (!$this->Session->check('User.id')) {
			$this->redirect(array('action' => 'logIn'));
		}
		$this->layout = 'normal';
	}

	public function logout() {
		if ($this->Session->check('User.id')) {
			$this->Session->destroy();
			$this->redirect(array('action' => 'logIn'));
		}
	}
}