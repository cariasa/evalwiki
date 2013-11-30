<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */

class AppController extends Controller {
	protected function _isSysop($user_id) {
        $db = ConnectionManager::getDataSource('default');
        $db->rawQuery("SELECT user_name FROM user JOIN user_groups ON user_id=ug_user WHERE ug_group = 'sysop' and user_id = ".$user_id.";");
        return $db->hasResult();
	}

	protected function _isTeacher($user_id) {
		pr($this->Teacher->find('count', array('conditions' => array('Teacher.id', $user_id))));
		
		if ($this->Teacher->find('count', array('conditions' => array('Teacher.id', $user_id))) == 1) {
			return true;
		} else {
			return false;
		}
	}	
}
