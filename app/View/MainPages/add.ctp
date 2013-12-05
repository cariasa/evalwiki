<main class="col-md-10 col-md-offset-1">
	<?php
		echo $this->Session->flash('success-dismissable');
		echo $this->Session->flash('failure-dismissable');
	?>
	<h2>Agregar Paginas Principales</h2>
	<?php
		echo $this->Form->create('MainPage', array('class' => 'form-horizontal',
													'action' => 'add'));
		echo $this->Form->select('page_id', $main_pages, array('escape' => false, 'empty' => false, 'class' => 'form-control'));
	?>

	<div class="form-group">
		<label class="control-label">Nombre del Curso</label>
		<input type="text" class="form-control" name="data[MainPage][course_name]">
	</div>

	<div class="form-group">
		<label class="control-label">Codigo del Curso</label>
		<input type="text" class="form-control" name="data[MainPage][course_code]">
	</div>

	<?php
		echo $this->Form->submit('Agregar', array(
			'class' => 'btn btn-primary',
			'div' => 'row'));
		echo $this->Form->end();
	?>
</main>

