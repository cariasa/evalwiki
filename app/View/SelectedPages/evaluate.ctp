<main class="col-md-9 col-md-offset-1">
	<h2>Evaluación</h2>
	
	<div class="row">
		<h3>Notas individuales</h3>
		<div class="well">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Usuario</th>
						<th>Nota grupal</th>
						<th>Nota de Consistencia</th>
						<th>Nota de Contribución</th>
						<th>Nota total</th>
						<th>Nota total (oro)</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach($users as $user): ?>
						<tr>
							<td><?php echo $user; ?></td>
							<td style="text-align:right"><?php echo number_format($final_grades_per_user[$user]['groupal_grade'],2).'%'; ?></td>
							<td style="text-align:right"><?php echo number_format($consistencyGrades[$user] * $data['consistencyWeight'], 2).'%'; ?></td>
							<td style="text-align:right"><?php echo number_format($contribucion_por_usuario[$user]*$data['contributionWeight'],2).'%'; ?></td>
							<?php
								$current_grade = $final_grades_per_user[$user]['final_grade'] / 100.0 * $data['goldPoints']; ?>
							<td style="text-align:right"><?php echo number_format($final_grades_per_user[$user]['final_grade'], 2).'%'; ?></td>
							<td style="text-align:right"><?php echo number_format($current_grade, 2).' oro'; ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</main>