<?php 

class UsersController extends AppController {

	protected function _isSysop($user_id) {
        $db = $this->User->getDataSource();
        $result = $db->fetchAll("SELECT user_name FROM user JOIN user_groups ON user_id=ug_user WHERE ug_group = 'sysop' and user_id = ".$user_id.";");
        return count($result) != 0 ? true : false;
	}

	protected function _isTeacher($user_id) {
		$this->loadModel('Teacher');

		if (count($this->Teacher->find('list', array('conditions' => array('Teacher.id' => $user_id)))) > 0) {
			return true;
		} else {
			return false;
		}
	}

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
				$this->Session->setFlash('El usuario y/o contraseña no son correctos.');
			} else {
				$pass_parts = preg_split('/[:]/', $correct_password['User']['user_password']);
				if ($pass_parts[3] == md5($pass_parts[2]."-".md5($pass))) {
					if ($this->_isSysop($correct_password['User']['user_id']) || $this->_isTeacher($correct_password['User']['user_id'])) {
						$this->Session->write('User.id', $correct_password['User']['user_id']);
						$this->redirect(array('action' => 'home'));
					} else {
						$this->Session->setFlash('Usted no posee permisos para entrar al sistema.');
					}
				} else {
					$this->Session->setFlash('El usuario y/o contraseña no son correctos.');
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