<main class="col-md-6 col-md-offset-3">
	<?php 
		echo $this->Session->flash('failure-dismissable');
		echo $this->Session->flash('success-dismissable');
	?>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Nombre de usuario</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($teachers as $teacher): ?>
				<tr>
					<td><?php echo $teacher['User']['user_name']; ?></td>
					<td><?php echo $this->Html->link('Eliminar', array('action' => 'delete', 'id' => $teacher['User']['user_id']), array('class' => 'btn btn-danger')); ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</main>