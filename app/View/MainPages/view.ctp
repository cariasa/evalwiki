<main class="col-md-10 col-md-offset-1">
	<?php 
		echo $this->Session->flash('failure-dismissable');
		echo $this->Session->flash('success-dismissable');
	?>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Nombre de clase</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($main_pages as $main_page): ?>
				<tr>
					<td><?php echo $main_page['Page']['page_title']; ?></td>
					<td><?php echo $this->Html->link('Eliminar', array('action' => '', 'id' => $main_page['Page']['page_id']), array('class' => 'btn btn-danger')); ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</main>