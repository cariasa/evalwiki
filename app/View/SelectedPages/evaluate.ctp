<main class="col-md-8 col-md-offset-2">
	<h2>Evaluación</h2>
	<div class="row">
		<h3>Nota Grupal</h3>
		<div class="well col-md-4">
			<table class="table table-striped">
				<thead>
					<tr>
						<th class="col-md-3">Variable</th>
						<th class="col-md-3">Nota</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($grades as $var => $grade): ?>
						<tr>
							<td><?php echo ucfirst($var); ?></td>
							<td><?php echo $grade.'%'; ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
	
	<div class="row">
		<h3>Notas individuales</h3>
		<div class="well">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Usuario</th>
						<th>Nota de Consistencia</th>
						<th>Nota de Contribución</th>
						<th>Nota total</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach($users as $user): ?>
						<tr>
							<td><?php echo $user; ?></td>
							<td><?php echo number_format($consistencyGrades[$user] * $data['consistencyWeight'], 2); ?></td>
							<td><?php echo number_format($contribucion_por_usuario[$user]*$data['contributionWeight'],2); ?></td>
							<?php 
								//(array_sum(array_values($grades)) esta es la nota grupal debería de modificarse para 
								//ser adaptada al 80% de dependencia con la nota individial mover todo esto
								//para el controller
								$current_grade = $final_grades_per_user[$user] / 100.0 * $data['goldPoints']; ?>
							<td><?php echo number_format($current_grade, 2); ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</main>