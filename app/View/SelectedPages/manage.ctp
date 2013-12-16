<main class="col-md-8 col-md-offset-2">
	<h2>Páginas a evaluar</h2>
	<?php 
		echo $this->Session->flash('failure-dismissable');
		echo $this->Session->flash('success-dismissable');
		echo $this->Session->flash('failure');
	?>

	<table class="table table-hover">
		<thead>
			<tr>
				<th>Pagina</th>
				<th>Acción</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($selected_pages as $page_id => $page_title): ?>
				<tr>
					<td><?php echo str_replace("_", " ", $page_title); ?></td>
					<td><?php echo $this->Html->link('Eliminar', array('action' => 'removePage', 'id' => $page_id), array('class' => 'btn btn-danger confirmation')); ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<div class="row">
		<div class="btn-group">
			<?php 
				echo $this->Html->link('<- Volver', array('action' => 'view'), array('class' => 'btn btn-info'));
				echo $this->Html->link('Eliminar todas', array('action' => 'removeAll'), array('class' => 'btn btn-danger confirmation'));
				echo $this->Html->link('Definir rubrica', array('action' => 'setParameters'), array('class' => 'btn btn-success'));
			?>
		</div>
	</div>
</main>