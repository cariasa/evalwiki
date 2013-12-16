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
	</nav>
	<?php echo $this->fetch('content'); ?>

	<footer class="navbar navbar-default navbar-fixed-bottom">
	<?php echo $this->Html->link('Wiki Facultad Ingeniería | UNITEC', 'http://fi.unitec.edu/wiki') ?>
	</footer> 

	<?php echo $this->Html->script(array('https://code.jquery.com/jquery.min.js', 'bootstrap.min')); ?>
</body>
</html>