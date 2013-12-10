<main class="col-md-10 col-md-offset-2">
	<div class="row">
		<section class="col-md-4 home-option">
			<header>
				<h2>Paginas principales</h2>
			</header>
			<div class="home-option-body">
				<?php echo $this->Html->link('Agregar', array('controller' => 'main_pages', 'action' => 'add'), array('class' => 'btn btn-info')); ?>
				<?php echo $this->Html->link('Administrar', array('controller' => 'main_pages', 'action' => 'view'), array('class' => 'btn btn-info')); ?>
			</div>
		</section>
		<section class="col-md-4 col-md-offset-1 home-option">
			<header>
				<h2>Profesores</h2>
			</header>
			<div class="home-option-body">
				<?php echo $this->Html->link('Agregar', array('controller' => 'teachers', 'action' => 'add'), array('class' => 'btn btn-info')); ?>
				<?php echo $this->Html->link('Administrar', array('controller' => 'teachers', 'action' => 'view'), array('class' => 'btn btn-info')); ?>
			</div>
		</section>
	</div>
	<div class="row">
		<section class="col-md-4 home-option">
			<header>
				<h2>Periodos</h2>
			</header>
			<div class="home-option-body">
				<?php echo $this->Html->link('Agregar', array('controller' => 'periods', 'action' => 'add'), array('class' => 'btn btn-info')); ?>
				<?php echo $this->Html->link('Administrar', array('controller' => 'periods', 'action' => 'view'), array('class' => 'btn btn-info')); ?>
			</div>
		</section>
		<section class="col-md-4 col-md-offset-1  home-option">
			<header>
				<h2>Clases</h2>
			</header>
			<div class="home-option-body">
				<?php echo $this->Html->link('Listar', array('controller' => '', 'action' => ''), array('class' => 'btn btn-info')); ?>
			</div>
		</section>
	</div>
</main>