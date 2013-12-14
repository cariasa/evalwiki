<main class="col-md-10 col-md-offset-1">		
	<?php
		echo $this->Session->flash('success-dismissable');
		echo $this->Session->flash('failure-dismissable');
	?>
	<h2>Actualizar Pagina</h2>

	<?php
		echo $this->Form->create('MainPage', array('class' => 'form-horizontal'));
		echo $this->Form->input('MainPage.course_name', array( 'label' => 'Nombre del Curso', 'class'=>'form-control'));
		echo $this->Form->input('MainPage.course_code', array('label' => 'Code del Curso', 'class'=>'form-control'));

		echo $this->Form->end(array('label' => 'Guardar','div' => 'row', 'class' => 'btn btn-primary'));
	?>
</main>