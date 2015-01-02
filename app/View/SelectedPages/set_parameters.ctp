<main class="col-md-8 col-md-offset-2">
	<?php 
		echo $this->Session->flash('success-dismissable');
		echo $this->Session->flash('failure-dismissable');
		echo $this->Session->flash('failure');
	?>

	<h2>Parámetros de evaluación</h2>
	<?php 
		echo $this->Form->create('SelectedPages', array(
			'action' => 'evaluate', 
			'class' => 'form-horizontal', 
			'role' => 'form',
			'autocomplete' => 'off')); 
	?>

	<div class="well">
		<div class="form-group">
			<label class="col-sm-4 col-sm-offset-2 control-label">Puntos Oro</label>
			<div class="col-sm-2">
				<input type="text" class="form-control" 
						name="data[Parameters][goldPoints]" value="<?php isset($previous_parameters) ? print $previous_parameters['goldPoints'] : print 10; ?>" 
						data-validation="number" data-validation-allowing="range[1;100],float" 
						data-validation-error-msg="Puntaje del 1-100">
			</div>
		</div>
		<ul>
			<li>Los valores asignados a los pesos deberán sumar 100</li>
			<li>Puede dejar en blanco los pesos de criterios que no desea utilizar en la evaluación</li>
			<li>En los parámetros de evaluación grupal, si deja en blanco el campo <em>Nota</em> se utilizará el valor seleccionado en <em>Rúbrica</em>, si el campo <em>Nota</em> tiene algún valor se utilizará ese valor y no el de <em>Rúbrica</em></li>
		</ul>
	</div>

	<h3>Parámetros de evaluación Grupal</h3>
	<table class="table table-hover">
		<thead>
			<tr>
				<th class="col-sm-1">Criterio</th>
				<th class="col-sm-5	">Rúbrica</th>
				<th>Nota</th>
				<th>Peso</th>
			</tr>
		</thead>
		
		<tbody>
			<tr>
				<td>Contenido</td>
				<td>
					<select class="form-control col-sm-6" name="data[Parameters][contentRubric]">
						<?php if (isset($previous_parameters)) : ?>
							<option value="0" <?php if ($previous_parameters['contentRubric'] == 0) {echo "selected";} ?>>Nada</option>
							<option value="0.25" <?php if ($previous_parameters['contentRubric'] == 0.25) {echo "selected";} ?>>Esfuerzo mínimo</option>
							<option value="0.50" <?php if ($previous_parameters['contentRubric'] == 0.50) {echo "selected";} ?>>Información esencial</option>
							<option value="0.75" <?php if ($previous_parameters['contentRubric'] == 0.75) {echo "selected";} ?>>Muestra conocimiento del tema</option>
							<option value="1.0" <?php if ($previous_parameters['contentRubric'] == 1.0) {echo "selected";} ?>>Cubre el tema a profundidad, con ejemplos</option>
							<option value="1.2" <?php if ($previous_parameters['contentRubric'] == 1.2) {echo "selected";} ?>>Excede las espectativas (Extra)</option>
						<?php else : ?>
							<option value="0">Nada</option>
							<option value="0.25">Esfuerzo mínimo</option>
							<option value="0.50">Información esencial</option>
							<option value="0.75">Muestra conocimiento del tema</option>
							<option value="1.0">Cubre el tema a profundidad, con ejemplos</option>
							<option value="1.2">Excede las espectativas (Extra)</option>
						<?php endif; ?>
					</select>
				</td>
				<td>
					<div class="input-group">
						<input type="text" class="form-control" type="text" 
							   	data-validation="number" data-validation-allowing="range[1;100],float" 
							   	data-validation-error-msg="Puntaje del 1-100" data-validation-optional="true" 
							   	name="data[Parameters][contentGrade]" <?php isset($previous_parameters) ? print 'value="'.$previous_parameters['contentGrade'].'"' : ""; ?>>
						<!-- <span class="input-group-addon">%</span> -->
					</div>
				</td>
				<td>
					<div class="input-group">
						<input type="text" class="form-control weight-input sum_percent" type="text" 
								data-validation="number" data-validation-allowing="range[1;100],float" 
								data-validation-error-msg="Puntaje del 1-100" data-validation-optional="true" 
								name="data[Parameters][contentWeight]" id="contentW" <?php isset($previous_parameters) ? print 'value="'.$previous_parameters['contentWeight'].'"' : ""; ?>>
						<span class="input-group-addon">%</span>
					</div>
				</td>
			</tr>
			<tr>
				<td>Presentación</td>
				<td>
					<select class="form-control" name="data[Parameters][presentationRubric]">
						<?php if (isset($previous_parameters)) : ?>
							<option value="0" <?php if ($previous_parameters['presentationRubric'] == 0) {echo "selected";} ?>>Desorganizado</option>
							<option value="0.25" <?php if ($previous_parameters['presentationRubric'] == 0.25) {echo "selected";} ?>>Distrae</option>
							<option value="0.50" <?php if ($previous_parameters['presentationRubric'] == 0.50) {echo "selected";} ?>>Buen uso de atributos</option>
							<option value="0.75" <?php if ($previous_parameters['presentationRubric'] == 0.75) {echo "selected";} ?>>Calidad mejorada</option>
							<option value="1.0" <?php if ($previous_parameters['presentationRubric'] == 1.0) {echo "selected";} ?>>Ayuda a la comprensión</option>
							<option value="1.2" <?php if ($previous_parameters['presentationRubric'] == 1.2) {echo "selected";} ?>>Excede las espectativas (Extra)</option>
						<?php else : ?>
							<option value="0">Desorganizado</option>
							<option value="0.25">Distrae</option>
							<option value="0.50">Buen uso de atributos</option>
							<option value="0.75">Calidad mejorada</option>
							<option value="1.0">Ayuda a la comprensión</option>
							<option value="1.2">Excede las espectativas (Extra)</option>
						<?php endif; ?>
					</select>
				</td>
				<td>
					<div class="input-group">
						<input type="text" class="form-control" type="text" data-validation="number" 
								data-validation-allowing="range[1;100],float" data-validation-error-msg="Puntaje del 1-100" 
								data-validation-optional="true" name="data[Parameters][presentationGrade]" <?php isset($previous_parameters) ? print 'value="'.$previous_parameters['presentationGrade'].'"' : ""; ?>>
						<!-- <span class="input-group-addon">%</span> -->
					</div>
				</td>
				<td>
					<div class="input-group">
						<input type="text" class="form-control weight-input" type="text" 
								data-validation="number" data-validation-allowing="range[1;100],float" 
								data-validation-error-msg="Puntaje del 1-100" data-validation-optional="true" 
								name="data[Parameters][presentationWeight]" id="presentationW" <?php isset($previous_parameters) ? print 'value="'.$previous_parameters['presentationWeight'].'"' : ""; ?>>
						<span class="input-group-addon">%</span>
					</div>
				</td>
			</tr>
			<tr>
				<td>Colaboración</td>
				<td>
					<select class="form-control" name="data[Parameters][colaborationRubric]">
						<?php if (isset($previous_parameters)) : ?>
							<option value="0" <?php if ($previous_parameters['colaborationRubric'] == 0) {echo "selected";} ?>>No hubo</option>
							<option value="0.25" <?php if ($previous_parameters['colaborationRubric'] == 0.25) {echo "selected";} ?>>Un 25%</option>
							<option value="0.50" <?php if ($previous_parameters['colaborationRubric'] == 0.50) {echo "selected";} ?>>Un 50%</option>
							<option value="0.75" <?php if ($previous_parameters['colaborationRubric'] == 0.75) {echo "selected";} ?>>Un 75%</option>
							<option value="1.0" <?php if ($previous_parameters['colaborationRubric'] == 1.0) {echo "selected";} ?>>Todos colaboraron</option>
							<option value="1.2" <?php if ($previous_parameters['colaborationRubric'] == 1.2) {echo "selected";} ?>>Excede las espectativas (Extra)</option>
						<?php else : ?>
							<option value="0">No hubo</option>
							<option value="0.25">Un 25%</option>
							<option value="0.50">Un 50%</option>
							<option value="0.75">Un 75%</option>
							<option value="1.0">Todos colaboraron</option>
							<option value="1.2">Excede las espectativas (Extra)</option>
						<?php endif; ?>
					</select>
				</td>
				<td>
					<div class="input-group">
						<input type="text" class="form-control" type="text" data-validation="number" 
								data-validation-allowing="range[1;100],float" data-validation-error-msg="Puntaje del 1-100" 
								data-validation-optional="true" name="data[Parameters][colaborationGrade]" <?php isset($previous_parameters) ? print 'value="'.$previous_parameters['colaborationGrade'].'"' : ""; ?>>
						<!-- <span class="input-group-addon">%</span> -->
					</div>
				</td>
				<td>
					<div class="input-group">
						<input type="text" class="form-control weight-input weight-input" type="text" data-validation="number" 
								data-validation-allowing="range[1;100],float" data-validation-error-msg="Puntaje del 1-100" 
								data-validation-optional="true" name="data[Parameters][colaborationWeight]"
								id="colaborationW" <?php isset($previous_parameters) ? print 'value="'.$previous_parameters['colaborationWeight'].'"' : ""; ?>>
						<span class="input-group-addon">%</span>
					</div>
				</td>
			</tr>
			<tr>
				<td>Organización</td>
				<td>
					<select class="form-control" name="data[Parameters][organizationRubric]">
						<?php if (isset($previous_parameters)) : ?>
							<option value="0" <?php if ($previous_parameters['organizationRubric'] == 0) {echo "selected";} ?>>Desorganizado</option>
							<option value="0.25" <?php if ($previous_parameters['organizationRubric'] == 0.25) {echo "selected";} ?>>Usa secciones</option>
							<option value="0.50" <?php if ($previous_parameters['organizationRubric'] == 0.50) {echo "selected";} ?>>Tiene organización lógica</option>
							<option value="0.75" <?php if ($previous_parameters['organizationRubric'] == 0.75) {echo "selected";} ?>>Usa secciones, enumeraciones</option>
							<option value="1.0" <?php if ($previous_parameters['organizationRubric'] == 1.0) {echo "selected";} ?>>La organización es ideal</option>
							<option value="1.2" <?php if ($previous_parameters['organizationRubric'] == 1.2) {echo "selected";} ?>>Excede las espectativas (Extra)</option>
						<?php else : ?>
							<option value="0">Desorganizado</option>
							<option value="0.25">Usa secciones</option>
							<option value="0.50">Tiene organización lógica</option>
							<option value="0.75">Usa secciones, enumeraciones</option>
							<option value="1.0">La organización es ideal</option>
							<option value="1.2">Excede las espectativas (Extra)</option>
						<?php endif; ?>
					</select>
				</td>
				<td>
					<div class="input-group">
						<input type="text" class="form-control" type="text" 
								data-validation="number" data-validation-allowing="range[1;100],float" 
								data-validation-error-msg="Puntaje del 1-100" data-validation-optional="true" 
								name="data[Parameters][organizationGrade]" <?php isset($previous_parameters) ? print 'value="'.$previous_parameters['organizationGrade'].'"' : ""; ?>>
						<!-- <span class="input-group-addon">%</span> -->
					</div>
				</td>
				<td>
					<div class="input-group">
						<input type="text" class="form-control weight-input" type="text" data-validation="number"
								data-validation-allowing="range[1;100],float" data-validation-error-msg="Puntaje del 1-100" 
								data-validation-optional="true" name="data[Parameters][organizationWeight]"
								id="organizationW" <?php isset($previous_parameters) ? print 'value="'.$previous_parameters['organizationWeight'].'"' : ""; ?>>
						<span class="input-group-addon">%</span>
					</div>
				</td>
			</tr>
			<tr>
				<td>Referencias</td>
				<td>
					<select class="form-control" name="data[Parameters][referencesRubric]">
						<?php if (isset($previous_parameters)) : ?>
							<option value="0" <?php if ($previous_parameters['referencesRubric'] == 0) {echo "selected";} ?>>No hay referencias</option>
							<option value="0.25" <?php if ($previous_parameters['referencesRubric'] == 0.25) {echo "selected";} ?>>Son pocas</option>
							<option value="0.50" <?php if ($previous_parameters['referencesRubric'] == 0.50) {echo "selected";} ?>>Tiene algunas</option>
							<option value="0.75" <?php if ($previous_parameters['referencesRubric'] == 0.75) {echo "selected";} ?>>No siguen APA</option>
							<option value="1.0" <?php if ($previous_parameters['referencesRubric'] == 1.0) {echo "selected";} ?>>Siguen APA</option>
							<option value="1.2" <?php if ($previous_parameters['referencesRubric'] == 1.2) {echo "selected";} ?>>Excede las espectativas (Extra)</option>
						<?php else : ?>
							<option value="0">No hay referencias</option>
							<option value="0.25">Son pocas</option>
							<option value="0.50">Tiene algunas</option>
							<option value="0.75">No siguen APA</option>
							<option value="1.0">Siguen APA</option>
							<option value="1.2">Excede las espectativas (Extra)</option>
						<?php endif; ?>
					</select>
				</td>
				<td>
					<div class="input-group">
						<input type="text" class="form-control" type="text" data-validation="number" 
								data-validation-allowing="range[1;100],float" data-validation-error-msg="Puntaje del 1-100" 
								data-validation-optional="true" name="data[Parameters][referencesGrade]" <?php isset($previous_parameters) ? print 'value="'.$previous_parameters['referencesGrade'].'"' : ""; ?>>
						<!-- <span class="input-group-addon">%</span> -->
					</div>
				</td>
				<td>
					<div class="input-group">
						<input type="text" class="form-control weight-input" type="text"
								data-validation="number" data-validation-allowing="range[1;100],float" 
								data-validation-error-msg="Puntaje del 1-100" data-validation-optional="true" 
								name="data[Parameters][referencesWeight]" id="referencesW" <?php isset($previous_parameters) ? print 'value="'.$previous_parameters['referencesWeight'].'"' : ""; ?>>
						<span class="input-group-addon">%</span>
					</div>
				</td>
			</tr>
			<tr>
				<td>Lenguaje</td>
				<td>
					<select class="form-control" name="data[Parameters][languageRubric]">
						<?php if (isset($previous_parameters)) : ?>
							<option value="0" <?php if ($previous_parameters['languageRubric'] == 0) {echo "selected";} ?>>No la toman en cuenta</option>
							<option value="0.25" <?php if ($previous_parameters['languageRubric'] == 0.25) {echo "selected";} ?>>Hay errores diversos</option>
							<option value="0.50" <?php if ($previous_parameters['languageRubric'] == 0.50) {echo "selected";} ?>>Hay pocos errores</option>
							<option value="0.75" <?php if ($previous_parameters['languageRubric'] == 0.75) {echo "selected";} ?>>Nivel de documento aceptable</option>
							<option value="1.0" <?php if ($previous_parameters['languageRubric'] == 1.0) {echo "selected";} ?>>Es impecable</option>
							<option value="1.2" <?php if ($previous_parameters['languageRubric'] == 1.2) {echo "selected";} ?>>Excede las espectativas (Extra)</option>
						<?php else : ?>
							<option value="0">No la toman en cuenta</option>
							<option value="0.25">Hay errores diversos</option>
							<option value="0.50">Hay pocos errores</option>
							<option value="0.75">Nivel de documento aceptable</option>
							<option value="1.0">Es impecable</option>
							<option value="1.2">Excede las espectativas (Extra)</option>
						<?php endif; ?>
					</select>
				</td>
				<td>
					<div class="input-group">
						<input type="text" class="form-control weight-input" type="text" data-validation="number" 
								data-validation-allowing="range[1;100],float" data-validation-error-msg="Puntaje del 1-100" 
								data-validation-optional="true" name="data[Parameters][languageGrade]" <?php isset($previous_parameters) ? print 'value="'.$previous_parameters['languageGrade'].'"' : ""; ?>>
						<!-- <span class="input-group-addon">%</span> -->
					</div>
				</td>
				<td>
					<div class="input-group">
						<input type="text" class="form-control weight-input" type="text" data-validation="number" 
								data-validation-allowing="range[1;100],float" data-validation-error-msg="Puntaje del 1-100" 
								data-validation-optional="true" name="data[Parameters][languageWeight]" id="languageW" <?php isset($previous_parameters) ? print 'value="'.$previous_parameters['languageWeight'].'"' : ""; ?>>
						<span class="input-group-addon">%</span>
					</div>
				</td>
			</tr>
		</tbody>
	</table>

	<h3>Criterios de evaluación individual</h3>

	<table class="table table-hover">
		<thead>
			<tr>
				<th class="col-sm-6">Criterio</th>
				<th>Peso</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Consistencia en el tiempo</td>
				<td>
					<div class="input-group">
						<input class="form-control" type="text weight-input" data-validation="number" 
								data-validation-allowing="range[1;100],float" data-validation-error-msg="Puntaje del 1-100" 
								data-validation-optional="true" name="data[Parameters][consistencyWeight]"
								id="consistencyW" <?php isset($previous_parameters) ? print 'value="'.$previous_parameters['consistencyWeight'].'"' : ""; ?>>
						<span class="input-group-addon">%</span>
					</div>
				</td>
			</tr>
			<tr>
				<td>Contribución</td>
				<td>
					<div class="input-group">
						<input class="form-control" type="text weight-input" data-validation="number" 
								data-validation-allowing="range[1;100],float" data-validation-error-msg="Puntaje del 1-100" 
								data-validation-optional="true" name="data[Parameters][contributionWeight]"
								id="contributionW" <?php isset($previous_parameters) ? print 'value="'.$previous_parameters['contributionWeight'].'"' : ""; ?>>
						<span class="input-group-addon">%</span>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	<h3>Elección de método de ponderación</h3>
	<div class="form-group">
		<label class="col-sm-4 control-label">Consitencia temporal</label>
		<div class="col-sm-6">
			<select class="form-control" name="data[Parameters][consistencyAlgorithm]" id="consistency-algorihtm">
				<?php if (isset($previous_parameters)) : ?>
					<option value="1" <?php if ($previous_parameters['consistencyAlgorithm'] == 1) {echo "selected";} ?>>Por número máximo de participaciones</option>
					<option value="2" <?php if ($previous_parameters['consistencyAlgorithm'] == 2) {echo "selected";} ?>>Ṕor número establecido de participaciones</option>
					<option value="3" <?php if ($previous_parameters['consistencyAlgorithm'] == 3) {echo "selected";} ?>>Por número establecido de participaciones semanales</option>
				<?php else : ?>
					<option value="1">Por número máximo de participaciones</option>
					<option value="2">Ṕor número establecido de participaciones</option>
					<option value="3">Por número establecido de participaciones semanales</option>
				<?php endif; ?>
			</select>
		</div>
		<div class="col-sm-2">
			<?php if (isset($previous_parameters)) : ?>
				<input class="form-control" name="data[Parameters][maxParticipations]" <?php isset($previous_parameters['maxParticipations']) ? print 'value="'.$previous_parameters['maxParticipations'].'"' : print 'value="5"'; if ($previous_parameters['consistencyAlgorithm'] == 1) { echo ' disabled'; } ?> id="max-participation">
			<?php else : ?>
				<input class="form-control" name="data[Parameters][maxParticipations]" value="5" id="max-participation" disabled>
			<?php endif; ?>
		</div>
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<span class="help-block">Define cómo se calculará la evaluación de la consistencia dependiendo del criterio del profesor.</span>
			</div>
		</div>
	</div>
	<input type="hidden" name="data[Parameters][contributionAlgorithm]" value="2">
	

	<h3>Rango de fechas a evaluar</h3>

	<div class="radio">
		<label class="control-label">
			<?php if(isset($previous_parameters)) : ?>
				<input type="radio" name="data[Parameters][dates_or_range]" id="datesOrRange" <?php if ($previous_parameters['dates_or_range'] == 'periods') { echo "checked"; } ?> value="periods" class="dates-or-range" >
				Por trimestre
			<?php else : ?>
				<input type="radio" name="data[Parameters][dates_or_range]" id="datesOrRange" value="periods" class="dates-or-range" >
				Por trimestre
			<?php endif; ?>
		</label>
	</div>

	<div class="form-group">
		<label class="col-sm-4 control-label">Periodo</label>
		<div class="col-sm-8">
			<select class="form-control" name="data[Parameters][period_id]" id="period-selector">
				<?php if (isset($previous_parameters) and isset($previous_parameters['period_id'])) : ?>
					<?php foreach($periods as $period): ?>
						<option value=<?php echo '"'.$period['Period']['id'].'"'; if ($period['Period']['id'] == $previous_parameters['period_id']) { echo " selected"; } ?>><?php echo 'Semestre '.$period['Period']['semester'].' Periodo '.$period['Period']['period'].' Año '.$period['Period']['year']; ?></option>
					<?php endforeach; ?>
				<?php else : ?>
					<?php foreach($periods as $period): ?>
						<option value=<?php echo '"'.$period['Period']['id'].'"'; ?>><?php echo 'Semestre '.$period['Period']['semester'].' Periodo '.$period['Period']['period'].' Año '.$period['Period']['year']; ?></option>
					<?php endforeach; ?>
				<?php endif; ?>
			</select>
		</div>
	</div>

	<div class="radio">
		<label class="control-label">
		<?php if (isset($previous_parameters) and isset($previous_parameters['dates_or_range'])) : ?>
			<input type="radio" name="data[Parameters][dates_or_range]" id="datesOrRange" checked value="range" <?php if ($previous_parameters['dates_or_range'] == 'range') { echo "checked"; } ?> class="dates-or-range">
			Por rango de fechas
		<?php else : ?>
			<input type="radio" name="data[Parameters][dates_or_range]" id="datesOrRange" checked value="range" class="dates-or-range" >
			Por rango de fechas
		<?php endif; ?>
		</label>
	</div>

	<div class="form-group">
		<label class="control-label col-sm-4">Fecha de inicio</label>
		<div class="col-sm-8">
			<?php if (isset($previous_parameters) and isset($previous_parameters['start_date'])) :?>
				<input type="text" class="form-control calendar dates-rage" name="data[Parameters][start_date]" required data-validation="date" data-validation-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" data-validation-error-msg="Ingrese el formato correcto de fecha" id="StartDate" data-date-format="yyyy-mm-dd" value=<?php echo '"'.$previous_parameters['start_date'].'"'; ?>>
			<?php else : ?>
				<input type="text" class="form-control calendar dates-rage" name="data[Parameters][start_date]" required data-validation="date" data-validation-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" data-validation-error-msg="Ingrese el formato correcto de fecha" id="StartDate" data-date-format="yyyy-mm-dd" value=<?php echo '"'.date('Y-m-d').'"'; ?>>
			<?php endif; ?>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-sm-4">Fecha Final</label>
		<div class="col-sm-8">
			<?php if (isset($previous_parameters) and isset($previous_parameters['end_date'])) : ?>
				<input type="text" class="form-control calendar dates-rage" name="data[Parameters][end_date]" required data-validation="end_date date" data-validation-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" id="EndDate" data-date-format="yyyy-mm-dd" value=<?php echo '"'.$previous_parameters['end_date'].'"'; ?>>
			<?php else : ?>
				<input type="text" class="form-control calendar dates-rage" name="data[Parameters][end_date]" required data-validation="end_date date" data-validation-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" id="EndDate" data-date-format="yyyy-mm-dd" value=<?php echo '"'.date('Y-m-d', strtotime('+3 months')).'"'; ?>>
			<?php endif; ?>
		</div>
	</div>
	<?php echo $this->Form->end(array('label' => 'Evaluar','div' => 'row', 'class' => 'btn btn-primary')); ?>	 
</main>