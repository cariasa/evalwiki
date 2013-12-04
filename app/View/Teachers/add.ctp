<main class="col-md-10 col-md-offset-1">
	<?php if (!is_null($saved)): ?>
		<?php if ($saved): ?>
			<?php echo $this->Session->flash('flash', array('element' => 'success-dismissable')); ?>
		<?php else: ?>
			<?php echo $this->Session->flash('flash', array('element' => 'failure-dismissable')); ?>
		<?php endif; ?>
	<?php endif; ?>
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