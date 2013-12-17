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
	</div>
</main>