<main class="col-md-6 col-md-offset-3">
	<?php
		echo $this->Session->flash('success-dismissable');
		echo $this->Session->flash('failure-dismissable');
	?>
	<h2>Agregar Profesor</h2>
	<?php
		echo $this->Form->create('Teacher', array('class' => 'form-horizontal',
													'action' => 'add'));
		echo $this->Form->select('id', $users, array('escape' => false, 'empty' => false, 'class' => 'form-control'));
		echo $this->Form->submit('Agregar', array(
			'class' => 'btn btn-primary',
			'div' => 'row'));
		echo $this->Form->end();
	?>
</main>