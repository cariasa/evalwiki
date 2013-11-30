<!doctype html>

<html lang="es">
<head>
	<title><?php echo $title_for_layout ?></title>
	<?php 
		echo $this->Html->charset('utf-8');
		echo $this->Html->css(array('bootstrap.min', 'main'));
	?>
</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="navbar-header">
	    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#">
	    		<span class="sr-only">Toggle navigation</span>
		    	<span class="icon-bar"></span>
		    	<span class="icon-bar"></span>
		    	<span class="icon-bar"></span>
		    </button>
		    <?php echo $this->Html->image('logofi.png', array('id' => 'filogo', 'alt' => 'Logo Facultad')); ?>
		    <?php echo $this->Html->link('Wiki-Eval', '#', array('class' => 'navbar-brand')); ?>
		</div>
		<div class="navbar-right">
			<?php echo $this->Html->link('Cerrar Sesion', array('controller' => 'users', 'action' => 'logout'), array('class' => 'btn btn-danger')); ?>
		</div>
	</nav>
	<?php echo $this->fetch('content'); ?>

	<footer class="navbar navbar-default navbar-fixed-bottom">
	<?php echo $this->Html->link('Wiki Facultad Ingeniería | UNITEC', 'http://fi.unitec.edu/wiki') ?>
	</footer> 

	<?php echo $this->Html->script(array('bootstrap.min', 'jquery.min')); ?>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>