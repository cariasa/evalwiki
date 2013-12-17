<main class="col-md-8 col-md-offset-2">
	<?php 
		echo $this->Session->flash('success-dismissable');
		echo $this->Session->flash('failure-dismissable');
		echo $this->Session->flash('failure');
	?>

	<h2>Parámetros de evaluación</h2>
	<?php echo $this->Form->create('Parameters', array('action' => 'evaluate', 'class' => 'form-horizontal', 'role' => 'form')); ?>

	<div class="well">
		<div class="form-group">
			<label class="col-sm-4 col-sm-offset-2 control-label">Puntos Oro</label>
			<div class="col-sm-2">
				<input type="text" class="form-control" name="data[Parameters][goldPoints]" value="10">
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
				<th>Criterio</th>
				<th>Rúbrica</th>
				<th>Nota</th>
				<th>Peso</th>
			</tr>
		</thead>
		
		<tbody>
			<tr>
				<td>Contenido</td>
				<td>
					<select class="form-control" name="data[Parameters][contentRubric]">
						<option value="0">Nada</option>
						<option value="0.25">Esfuerzo mínimo</option>
						<option value="0.50">Información esencial</option>
						<option value="0.75">Muestra conocimiento del tema</option>
						<option value="1.0">Cubre el tema a profundidad, con ejemplos</option>
					</select>
				</td>
				<td>
					<input type="text" class="form-control" type="text" name="data[Parameters][contentGrade]">
				</td>
				<td>
					<input type="text" class="form-control" type="text" name="data[Parameters][contentWeight]">
				</td>
			</tr>
			<tr>
				<td>Presentación</td>
				<td>
					<select class="form-control" name="data[Parameters][presentationRubric]">
						<option value="0">Desorganizado</option>
						<option value="0.25">Distrae</option>
						<option value="0.50">Buen uso de atributos</option>
						<option value="0.75">Calidad mejorada</option>
						<option value="1.0">Ayuda a la comprensión</option>
					</select>
				</td>
				<td>
					<input type="text" class="form-control" type="text" name="data[Parameters][presentationGrade]">
				</td>
				<td>
					<input type="text" class="form-control" type="text" name="data[Parameters][presentationWeight]">
				</td>
			</tr>
			<tr>
				<td>Colaboración</td>
				<td>
					<select class="form-control" name="data[Parameters][colaborationRubric]">
						<option value="0">No hubo</option>
						<option value="0.25">Un 25%</option>
						<option value="0.50">Un 50%</option>
						<option value="0.75">Un 75%</option>
						<option value="1.0">Todos colaboraron</option>
					</select>
				</td>
				<td>
					<input type="text" class="form-control" type="text" name="data[Parameters][colaborationGrade]">
				</td>
				<td>
					<input type="text" class="form-control" type="text" name="data[Parameters][colaborationWeight]">
				</td>
			</tr>
			<tr>
				<td>Organización</td>
				<td>
					<select class="form-control" name="data[Parameters][organizationRubric]">
						<option value="0">Desorganizado</option>
						<option value="0.25">Usa secciones</option>
						<option value="0.50">Tiene organización lógica</option>
						<option value="0.75">Usa secciones, enumeraciones</option>
						<option value="1.0">La organización es ideal</option>
					</select>
				</td>
				<td>
					<input type="text" class="form-control" type="text" name="data[Parameters][organizationGrade]">
				</td>
				<td>
					<input type="text" class="form-control" type="text" name="data[Parameters][organizationWeight]">
				</td>
			</tr>
			<tr>
				<td>Referencias</td>
				<td>
					<select class="form-control" name="data[Parameters][referencesRubric]">
						<option value="0">No hay referencias</option>
						<option value="0.25">Son pocas</option>
						<option value="0.50">Tiene algunas</option>
						<option value="0.75">No siguen APA</option>
						<option value="1.0">Siguen APA</option>
					</select>
				</td>
				<td>
					<input type="text" class="form-control" type="text" name="data[Parameters][referencesGrade]">
				</td>
				<td>
					<input type="text" class="form-control" type="text" name="data[Parameters][referencesWeight]">
				</td>
			</tr>
			<tr>
				<td>Lenguaje</td>
				<td>
					<select class="form-control" name="data[Parameters][languageRubric]">
						<option value="0">No la toman en cuenta</option>
						<option value="0.25">Hay errores diversos</option>
						<option value="0.50">Hay pocos errores</option>
						<option value="0.75">Nivel de documento aceptable</option>
						<option value="1.0">Es impecable</option>
					</select>
				</td>
				<td>
					<input type="text" class="form-control" type="text" name="data[Parameters][languageGrade]">
				</td>
				<td>
					<input type="text" class="form-control" type="text" name="data[Parameters][languageWeight]">
				</td>
			</tr>
		</tbody>
	</table>

	<h3>Criterios de evaluación individual</h3>

	<table class="table table-hover">
		<thead>
			<tr>
				<th>Criterio</th>
				<th>Peso</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Consistencia en el tiempo</td>
				<td>
					<input class="form-control" type="text" name="data[Parameters][consistencyWeight]">
				</td>
			</tr>
			<tr>
				<td>Contribución</td>
				<td>
					<input class="form-control" type="text" name="data[Parameters][contributionWeight]">
				</td>
			</tr>
		</tbody>
	</table>
	<h3>Elección de método de ponderación</h3>
	<div class="form-group">
		<label class="col-sm-4 control-label">Consitencia temporal</label>
		<div class="col-sm-4">
			<select class="form-control" name="data[Parameters][consistencyAlgorithm]">
				<option value="1">Por número máximo de participaciones</option>
				<option value="2">Ṕor número establecido de participaciones</option>
			</select>
		</div>
		<div class="col-sm-4">
			<input class="form-control" name="data[Parameters][maxParticipations]" value="5">
		</div>
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<span class="help-block">Define cómo se calculará la evaluación de la consistencia dependiendo del criterio del profesor.</span>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4 control-label">Contribución</label>
		<div class="col-sm-8">
			<select class="form-control" name="data[Parameters][contributionAlgorithm]">
				<option value="1">Normalizar con respecto al total de contribuciones</option>
				<option value="2">Suavizar y luego normalizar</option>
			</select>
		</div>
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<span class="help-block">Define cómo se calculará la evaluación de las contribuciones, la suavización se hace por medio de una función exponencial con asíntota.</span>
			</div>
		</div>
	</div>
	<?php echo $this->Form->end(array('label' => 'Evaluar','div' => 'row', 'class' => 'btn btn-primary')); ?>	 
</main>