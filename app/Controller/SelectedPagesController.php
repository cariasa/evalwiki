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
		if ($this->request->is('get') && !empty($this->request->named)) {
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
		if ($this->request->is('get') && !empty($this->request->named) && $this->Session->check('SelectedPages.evaluate')) {
			$evaluate = $this->Session->read('SelectedPages.evaluate');
			unset($evaluate[array_search($this->request->named['id'], $this->Session->read('SelectedPages.evaluate'))]);
			$this->Session->write('SelectedPages.evaluate', $evaluate);
			$this->Session->setFlash('La página ha sido removida de la lista de evaluación.', 'success-dismissable', array(), 'success-dimissable');
		}

		$this->redirect(array('action' => 'manage'));
	}

	public function removeAll() {
		if ($this->Session->check('SelectedPages.evaluate')) {
			$this->Session->delete('SelectedPages.evaluate');
			$this->Session->setFlash('Se han removido todas las páginas a evaluar.', 'success-dismissable', array(), 'success-dismissable');
		}
		$this->redirect(array('action' => 'view'));
	}

	public function setParameters() {
		$this->loadModel('Period');
		$periods = $this->Period->find('all', array('fields' => array('Period.id', 'Period.period', 'Period.semester', 'Period.year')));
		$this->set('periods', $periods);
		if ($this->Session->check('Parameters.all')) {
			$this->set('previous_parameters', $this->Session->read('Parameters.all'));	
		}
	}

	public function consistencyAlgorithmMaxParticipation($tabla_principal, $usuarios, $fechas) {
		$max_participation = 0;
		foreach ($usuarios as $usuario) {
			$current_participation = 0;
			foreach($fechas as $fecha) {
				if(!$tabla_principal[$usuario][$fecha] == 0) {
					$current_participation++;
				}
			}

			if ($current_participation > $max_participation) {
				$max_participation = $current_participation;
			}
		}

		$consistencyGrades = array();

		foreach($usuarios as $usuario) {
			$current_participation = 0;
			foreach($fechas as $fecha) {
				if($tabla_principal[$usuario][$fecha] != 0) {
					$current_participation++;
				}
			}
			$consistencyGrades[$usuario] = (float) $current_participation / (float) $max_participation;
		}

		return $consistencyGrades;
	}

	public function consistencyAlgorithmParticipationsSet($tabla_principal, $usuarios, $fechas, $max) {
		$max_participation = $max;
		$consistencyGrades = array();

		foreach($usuarios as $usuario) {
			$current_participation = 0;
			foreach($fechas as $fecha) {
				if(!$tabla_principal[$usuario][$fecha] != 0) {
					$current_participation++;
				}
			}

			$grade = (float) $current_participation / (float) $max_participation;
			$consistencyGrades[$usuario] =  $grade > 1.0 ? 1.0 : $grade;
		}

		return $consistencyGrades;
	}

	public function consistencyAlgorithmSemanalParticipations($tabla_principal, $usuarios, $fechas, $max, $start_date, $end_date) {
		$max_participation = $max;
		$consistencyGrades = array();
		$d_start = new DateTime($start_date);
		$d_end = new DateTime($end_date);
		
		//Creando el arreglo de semanas por usuario
		$weeks_diff = ceil(intval($d_start->diff($d_end)->format('%a')) / 7);
		$participaciones_usuarios_semanas = array();
		foreach($usuarios as $usuario) {
			$participaciones_usuarios_semanas[$usuario] = array();
			for ($i = 0; $i < $weeks_diff; $i++) {
				$participaciones_usuarios_semanas[$usuario][$i] = 0;
			}
		}

		//Llenando en que semana estoy
		foreach ($usuarios as $usuario) {
			foreach($fechas as $fecha) {
				if ($tabla_principal[$usuario][$fecha] != 0) {
					$current_diff = (int) (intval($d_start->diff(new DateTime($fecha))->format('%a')) / 7);
					$participaciones_usuarios_semanas[$usuario][$current_diff]++; 
				}
			}
			//Falta contar las participaciones por semana
			$user_acum = 0;
			for ($i = 0; $i < $weeks_diff; $i++) {
				$user_acum += $participaciones_usuarios_semanas[$usuario][$i] / $max_participation > 1 ? 1 : $participaciones_usuarios_semanas[$usuario][$i] / $max_participation;
			}

			$consistencyGrades[$usuario] = $user_acum / $weeks_diff;
		}

		return $consistencyGrades;
	}

	public function contributionAlgorithmNormalize($totales_por_usuario, $usuarios, $fechas) {
		$total_contribucion=0;
		foreach ($usuarios as $usuario){
			$total_contribucion+=$totales_por_usuario[$usuario];
		}
		$contribucion_entre_usuarios=$total_contribucion/count($usuarios);

		$total_usuario_contribucion=array();
		foreach ($usuarios as $usuario){
			$total_usuario_contribucion[$usuario]=abs($totales_por_usuario[$usuario])/$contribucion_entre_usuarios;
		}
		$contribucion_por_usuario=array();
		$maximo_contribucion=max($total_usuario_contribucion);
		foreach ($usuarios as $usuario){
			$contribucion_por_usuario[$usuario]=$total_usuario_contribucion[$usuario]/$maximo_contribucion;
		}

		return $contribucion_por_usuario;
	}

	public function contributionAlgorithmSmoothNormalize($totales_por_usuario, $usuarios, $fechas) {
		//Parámetros necesarios
		$variable_alpha=100;
		$variable_tao=0.6;
		$variable_init=0;
		$total_contribucion=0;

		foreach ($usuarios as $usuario){
			$total_contribucion+=$totales_por_usuario[$usuario];
		}
		$contribucion_entre_usuarios=$total_contribucion/count($usuarios);

		$total_usuario_contribucion=array();
		foreach ($usuarios as $usuario){
			$total_usuario_contribucion[$usuario]=abs($totales_por_usuario[$usuario])/$contribucion_entre_usuarios;
		}

		$si_por_usuario=array();
		foreach ($usuarios as $usuario){
			$si_por_usuario[$usuario]= $variable_alpha-($variable_alpha-$variable_init)*pow(M_E,-$total_usuario_contribucion[$usuario]/$variable_tao);
		}
		$maximo_si=max($si_por_usuario);

		$contribucion_por_usuario=array();
		foreach ($usuarios as $usuario){
			$contribucion_por_usuario[$usuario]=$si_por_usuario[$usuario]/$maximo_si;
		}

		return $contribucion_por_usuario;
	}	

	public function evaluate() {
		if($this->request->is('post') && !empty($this->request->data)) {
			$data = $this->request->data['Parameters'];
			$this->Session->write('Parameters.all', $data);
			$this->set('data', $data);

			$sum_percent = (float) $data['contentWeight'] +
			(float) $data['presentationWeight'] + 
			(float) $data['colaborationWeight'] +
			(float) $data['organizationWeight'] +
			(float) $data['referencesWeight'] +
			(float) $data['languageWeight'] +
			(float) $data['consistencyWeight'] +
			(float) $data['contributionWeight'];

			if ($sum_percent != (float) 100) {
				$this->Session->setFlash('La suma de los pesos no es igual a 100%', 'failure-dismissable', array(), 'failure-dismissable');
				$this->redirect(array('action' => 'setParameters'));
			} else {
				$correct_grades = true;

				if (!empty($data['contentGrade'])) {
					if ((float) $data['contentGrade'] > (float) $data['contentWeight']) {
						$correct_grades = false;
					}
				}

				if (!empty($data['presentationGrade'])) {
					if ((float) $data['presentationGrade'] > (float) $data['presentationWeight']) {
						$correct_grades = false;
					}
				}

				if (!empty($data['colaborationGrade'])) {
					if ((float) $data['colaborationGrade'] > (float) $data['colaborationWeight']) {
						$correct_grades = false;
					}
				}

				if (!empty($data['organizationGrade'])) {
					if ((float) $data['organizationGrade'] > (float) $data['organizationWeight']) {
						$correct_grades = false;
					}
				}

				if (!empty($data['referencesGrade'])) {
					if ((float) $data['referencesGrade'] > (float) $data['referencesWeight']) {
						$correct_grades = false;
					}
				}

				if (!empty($data['languageGrade'])) {
					if ((float) $data['languageGrade'] > (float) $data['languageWeight']) {
						$correct_grades = false;
					}
				}

				if (!$correct_grades) {
					$this->Session->setFlash('Una(s) notas son mayores que sus pesos.', 'failure-dismissable', array(), 'failure-dismissable');
					$this->redirect(array('action' => 'setParameters'));
				}
			}

			$grades = array();
			if (!empty($data['contentGrade'])) {
				$grades['contenido'] = (float) $data['contentGrade'];
			} else {
				$grades['contenido'] = (float) $data['contentWeight'] * (float) $data['contentRubric'];
			}

			if (!empty($data['presentationGrade'])) {
				$grades['presentación'] = (float) $data['presentationGrade'];
			} else {
				$grades['presentación'] = (float) $data['presentationWeight'] * (float) $data['presentationRubric'];
			}

			if (!empty($data['colaborationGrade'])) {
				$grades['colaboración'] = (float) $data['colaborationGrade'];
			} else {
				$grades['colaboración'] = (float) $data['colaborationWeight'] * (float) $data['colaborationRubric'];
			}

			if (!empty($data['organizationGrade'])) {
				$grades['organización'] = (float) $data['organizationGrade'];
			} else {
				$grades['organización'] = (float) $data['organizationWeight'] * (float) $data['organizationRubric'];
			}

			if (!empty($data['referencesGrade'])) {
				$grades['referencias'] = (float) $data['referencesGrade'];
			} else {
				$grades['referencias'] = (float) $data['referencesWeight'] * (float) $data['referencesRubric'];
			}

			if (!empty($data['languageGrade'])) {
				$grades['lenguaje'] = (float) $data['languageGrade'];
			} else {
				$grades['lenguaje'] = (float) $data['languageWeight'] * (float) $data['languageRubric'];
			}

			$this->set('grades', $grades);

			//Grupales
			$this->loadModel('Page');
			$start_date = null;
			$end_date = null;

			if ($data['dates_or_range'] == 'periods') {
				$this->loadModel('Period');
				$period = $this->Period->find('first', array(
					'fields' => array('Period.start_date', 'Period.end_date'),
					'conditions' => array('Period.id' => $data['period_id'])
					));
				$start_date = $period['Period']['start_date'];
				$end_date = $period['Period']['end_date'];
			} else {
				$start_date = $data['start_date'];
				$end_date = $data['end_date'];
			}
			$start_date_format = date_format(date_create($start_date), 'YmdHis');
			$end_date_format = date_format(date_create($end_date), 'YmdHis');
			$teachers_result = $this->Page->getDataSource()->fetchAll("select * from teachers");
			$teachers_array = array();
			// Teachers array
			foreach ($teachers_result as $teacher) {
				$teachers_array[] = $teacher['teachers']['id'];
			}
			$teachers_array[] = 1; // Adding Sysop

			$query = 'SELECT rev_timestamp, rev_len, user_name FROM page JOIN revision ON page.page_id=revision.rev_page JOIN user ON revision.rev_user=user.user_id WHERE page.page_id IN ('.implode($this->Session->read('SelectedPages.evaluate'), ",").") AND revision.rev_timestamp BETWEEN '".$start_date_format."' AND '".$end_date_format."' and user.user_id not in (".implode($teachers_array, ",").")";
			//pr($query);
			$individual_contributions = $this->Page->getDataSource()->fetchAll($query);

			$datos = array();
			foreach ($individual_contributions as $ind_contribution) {
				$datos[] = array(
					'user_name' => $ind_contribution['user']['user_name'],
					'rev_len' => $ind_contribution['revision']['rev_len'],
					'rev_timestamp' => $ind_contribution['revision']['rev_timestamp']
					);
			}

			$fechas = array();
			$usuarios = array();

			foreach ($datos as $registro) {
				$fecha_actual = substr($registro['rev_timestamp'], 0, 8);
				$usuario = $registro['user_name'];

				if (!in_array($fecha_actual, $fechas)) {
					$fechas[] = $fecha_actual;
				}

				if (!in_array($usuario, $usuarios)) {
					$usuarios[] = $usuario;
				}
			}

			sort($usuarios);

			$tabla_principal;

			foreach($usuarios as $usuario) {
				foreach($fechas as $fecha) {
					$datos_por_fecha[$fecha] = 0;
				}
				$tabla_principal[$usuario] = $datos_por_fecha;
			}

			$dato_anterior = 0;
			foreach ($datos as $dato) {
				$tabla_principal[$dato['user_name']][substr($dato['rev_timestamp'], 0, 8)] += $dato['rev_len'] - $dato_anterior;
				$dato_anterior = $dato['rev_len'];
			}

			$totales_por_usuario = array();

			foreach($usuarios as $usuario) {
				$totales_por_usuario[$usuario] = 0;
			}

			foreach ($usuarios as $usuario) {
				foreach ($fechas as $fecha) {
					$totales_por_usuario[$usuario] += $tabla_principal[$usuario][$fecha];
				}
			}

			$this->set('users', $usuarios);

			if (!isset($tabla_principal)) {
				$this->Session->setFlash('No hay usuarios que evaluar en ese rango de fechas.', 'failure', array(), 'failure');
				return $this->redirect(array('controller' => 'SelectedPages', 'action' => 'setParameters'));
			}

			if ($data['consistencyAlgorithm'] == 1) {
				$consistencyGrades = $this->consistencyAlgorithmMaxParticipation($tabla_principal, $usuarios, $fechas);
				$this->set('consistencyGrades', $consistencyGrades);

			} elseif ($data['consistencyAlgorithm'] == 2) {
				$consistencyGrades = $this->consistencyAlgorithmParticipationsSet($tabla_principal, $usuarios, $fechas, $data['maxParticipations']);
				$this->set('consistencyGrades', $consistencyGrades);

			} else {
				$consistencyGrades = $this->consistencyAlgorithmSemanalParticipations($tabla_principal, $usuarios, $fechas, $data['maxParticipations'], $start_date, $end_date);
				$this->set('consistencyGrades', $consistencyGrades);

			}

			if($data['contributionAlgorithm']==1){
				$contribucion_por_usuario = $this->contributionAlgorithmNormalize($totales_por_usuario, $usuarios, $fechas);
				$this->set('contribucion_por_usuario',$contribucion_por_usuario);
			}
			elseif ($data['contributionAlgorithm']==2) {
				$contribucion_por_usuario = $this->contributionAlgorithmSmoothNormalize($totales_por_usuario, $usuarios, $fechas);
				$this->set('contribucion_por_usuario',$contribucion_por_usuario);
			}

			//Deducción de la nota grupal: 80% depende de las participaciones individuales
			$nota_grupal = array_sum(array_values($grades));
			$final_grades_per_user = array();
			foreach ($usuarios as $usuario) {
				$current_grades_array = array();
				$nota_individual = ($consistencyGrades[$usuario] * $data['consistencyWeight']) + ($contribucion_por_usuario[$usuario]*$data['contributionWeight']);
				if ($data['contributionWeight'] != 0 || $data['consistencyWeight'] != 0) {
					$current_grades_array['groupal_grade'] = $nota_grupal * 0.2 + $nota_grupal * 0.8 * ($nota_individual / ($data['consistencyWeight'] + $data['contributionWeight']));
					$current_grades_array['final_grade'] = $nota_individual + $nota_grupal * 0.2 + $nota_grupal * 0.8 * ($nota_individual / ($data['consistencyWeight'] + $data['contributionWeight']));
				} else {
					$current_grades_array['groupal_grade'] = $nota_grupal;
					$current_grades_array['final_grade'] = $nota_individual + $nota_grupal;
				}
				$final_grades_per_user[$usuario] = $current_grades_array;
			}
			$this->set('final_grades_per_user', $final_grades_per_user);
		}	
	}

	public function userRevision() {
		if ($this->request->is('get') && !empty($this->request->named) && $this->Session->check('Parameters.all') && $this->Session->check('SelectedPages.evaluate')) {
			// Cargando datos y creando variables necesarias;
			$this->loadModel('User');
			$this->loadModel('Page');
			$db = $db = $this->User->getDataSource();
			$date_parameters = $this->Session->read('Parameters.all');
			$evaluated_pages_ids = $this->Session->read('SelectedPages.evaluate');

			$user_revision = array();
			$start_date = null;
			$end_date = null;

			if ($date_parameters['dates_or_range'] == 'periods') {
				$this->loadModel('Period');
				$period = $this->Period->find('first', array(
					'fields' => array('Period.start_date', 'Period.end_date'),
					'conditions' => array('Period.id' => $date_parameters['period_id'])
					));
				$start_date = $period['Period']['start_date'];
				$end_date = $period['Period']['end_date'];
			} else {
				$start_date = $date_parameters['start_date'];
				$end_date = $date_parameters['end_date'];
			}
			$start_date_format = date_format(date_create($start_date), 'YmdHis');
			$end_date_format = date_format(date_create($end_date), 'YmdHis');

			$query = "select T.old_text, U.user_name, R.rev_page, R.rev_timestamp from revision R join user U on U.user_id = R.rev_user join text T on R.rev_text_id = T.old_id where R.rev_timestamp between ". $start_date_format . " and ". $end_date_format ." and R.rev_page in (".implode($this->Session->read('SelectedPages.evaluate'), ",").") order by rev_page, rev_timestamp;";
			$user_revision_gross = $db->fetchAll($query);
			$prev_revision = "";
			$prev_page = -1;
			//pr($user_revision_gross);

			foreach ($user_revision_gross as $current_revision) {
				if ($prev_page != $current_revision['R']['rev_page']) {
					$prev_revision = "";
				}

				if ($current_revision['U']['user_name'] == $this->request->named['user_name']) {
					list($y, $m, $d, $h, $mi, $s) = sscanf($current_revision['R']['rev_timestamp'], '%4d%02d%02d%02d%02d%02d');

					$user_revision[] = array(
						'text' => Diff::toHTML(Diff::compare($prev_revision, $current_revision['T']['old_text'])),
						'time' => sprintf("%02d/%02d/%4d a las %02d:%02d:%02d", $d, $m, $y, $h, $mi, $s),
					);
				}

				$prev_revision = $current_revision['T']['old_text'];
				$prev_page = $current_revision['R']['rev_page'];
			}

			$this->set('user_revision', $user_revision);
		}
	}
}