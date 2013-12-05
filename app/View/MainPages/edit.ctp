<main class="col-md-10 col-md-offset-1">
	<?php
		echo $this->Session->flash('success-dismissable');
		echo $this->Session->flash('failure-dismissable');
	?>
	<h2>Actualizar Pagina</h2>
	<?php
		echo $this->Form->create('MainPage', array('class' => 'form-horizontal',
													'action' => 'update'.$id));
		echo $this->Form->input('MainPage.course_name', array('default'=>$name, 'label' => 'Nombre del Curso', 'class'=>'form-control'));
		echo $this->Form->input('MainPage.course_code', array('default'=> $code,'label' => 'Code del Curso', 'class'=>'form-control'));

		//echo $this->Form->submit('Agregar', array(
		//	'class' => 'btn btn-primary',
		//	'div' => 'row'));
		echo $this->Form->end();
	?>
</main>

