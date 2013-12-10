<main class="col-md-6 col-md-offset-3">
	<?php 
		echo $this->Session->flash('failure-dismissable');
		echo $this->Session->flash('success-dismissable');
	?>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Periodo</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($periods as $period): ?>
				<tr>
					<td>
						<?php echo 'Semestre '.$period['Period']['semester'].' Periodo '.$period['Period']['period'].' Año '.$period['Period']['period']; ?>
					</td>
					<td>
						<?php echo $this->Html->link('Actualizar', array('action' => 'edit', 'id' => $period['Period']['id']), array('class' => 'btn btn-primary')); ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</main>