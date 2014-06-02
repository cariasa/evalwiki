<!doctype html>

<html lang="es">
<head>
	<title><?php echo $title_for_layout ?></title>
	<?php 
		echo $this->Html->charset('utf-8');
		echo $this->Html->css(array('bootstrap.min', 'datepicker', 'main'));
	?>
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
	<meta http-equiv="pragma" content="no-cache" />
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-header">
	    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#">
	    		<span class="sr-only">Toggle navigation</span>
		    	<span class="icon-bar"></span>
		    	<span class="icon-bar"></span>
		    	<span class="icon-bar"></span>
		    </button>
		    <?php echo $this->Html->image('logofi.png', array('id' => 'filogo', 'alt' => 'Logo Facultad')); ?>
		    <?php echo $this->Html->link('Wiki-Eval', array('controller' => 'users', 'action' => 'home'), array('class' => 'navbar-brand')); ?>
		</div>
		<ul class="nav navbar-nav">
			<li><?php echo $this->Html->link('Wiki Facultad Ingeniería | UNITEC', 'http://fi.unitec.edu/wiki') ?></li>
		</ul>

		<div class="navbar-right">
			<?php echo $this->Html->link('Bienvenido '.$name.', cerrar sesión', array('controller' => 'users', 'action' => 'logout'), array('class' => 'btn btn-danger')); ?>
		</div>
	</nav>
	<?php echo $this->fetch('content'); ?>

	<?php echo $this->Html->script(array('https://code.jquery.com/jquery.min.js', 'bootstrap.min', 'http://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.1.27/jquery.form-validator.min.js', 'bootstrap-datepicker', 'main')); ?>
</body>
</html>