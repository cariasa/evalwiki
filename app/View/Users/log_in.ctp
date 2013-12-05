<?php 
	echo $this->Session->flash('flash', array('element' => 'failure')); 
?>

<section class="col-sm-6 col-sm-offset-3 jumbotron">
	<?php 
	echo $this->Form->create('User', array('class' => 'form-horizontal',
												'action' => 'logIn'));
	echo $this->Form->input('User.name', array(
		'div' => 'form-group',
		'label' => 'Usuario',
		'class' => 'form-control',
		'placeholder' => 'Usuario del wiki',
		'autofocus'));
	echo $this->Form->input('User.password', array(
		'div' => 'form-group',
		'type' => 'password',
		'label' => 'Contraseña',
		'class' => 'form-control',
		'placeholder' => 'Contraseña del wiki'));
	echo $this->Form->submit('Entrar', array(
		'class' => 'btn btn-primary',
		'div' => false));
	echo $this->Form->end(); 
	?>
</section>