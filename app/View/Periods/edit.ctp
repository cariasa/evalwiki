<main class="col-md-6 col-md-offset-3">
	<?php
		echo $this->Session->flash('success-dismissable');
		echo $this->Session->flash('failure-dismissable');
	?>
	<h2>Agregar Periodo</h2>
	<?php 
		echo $this->Form->create('Period', array('class' => 'form-horizontal', 'action' => 'edit'));
		
		$periods = array(
			1 => 'Primer Periodo', 
			2 => 'Segundo Periodo',
			4 => 'Tercer Periodo',
			5 => 'Cuarto Periodo'
		);

		$semester = array(
			1 => 'Primer Semestre',
			2 => 'Segundo Semestre' 
		);
		
		echo $this->Form->input('id', array(
								'default' => $period['Period']['id'],
								'hiddenField' => true
		));

		echo $this->Form->input('semester', array(
								'options' => $semester, 
								'empty' => false,
								'default' => $period['Period']['semester'], 
								'class' => 'form-control',
								'div' => 'form-group',
								'label' => 'Semestre'
		));
		
		echo $this->Form->input('period', array(
								'options' => $periods, 
								'empty' => false,
								'default' => $period['Period']['period'], 
								'class' => 'form-control',
								'div' => 'form-group',
								'label' => 'Periodo'
		));
	?>

	<div class="form-group">
		<label class="control-label">Año</label>
		<input type="text" class="form-control" name="data[Period][year]" required data-validation="custom" data-validation-regexp="[0-9]{4}" placeholder="2013" value=<?php echo '"'.$period['Period']['year'].'"'; ?>>
	</div>

	<div class="form-group">
		<label class="control-label">Fecha de inicio</label>
		<input type="text" class="form-control" name="data[Period][start_date]" required data-validation="date" data-validation-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" data-validation-error-msg="Ingrese el formato correcto de fecha"
		value=<?php echo '"'.$period['Period']['start_date'].'"'; ?>>
	</div>

	<div class="form-group">
		<label class="control-label">Fecha Final</label>
		<input type="text" class="form-control" name="data[Period][end_date]" required data-validation="date" data-validation-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" data-validation-error-msg="Ingrese el formato correcto de fecha"
		value=<?php echo '"'.$period['Period']['end_date'].'"'; ?>>
	</div>

	<?php
		echo $this->Form->end(array('label' => 'Guardar','div' => 'row', 'class' => 'btn btn-primary'));
	?>
</main>