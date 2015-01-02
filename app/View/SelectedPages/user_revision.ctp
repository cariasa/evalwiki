<div class="col-md-8 col-md-offset-2">
	<?php foreach ($user_revision as $revision): ?>
		<div class="panel panel-primary">
			<div class="panel-heading">Contrubución efectuada el <?php echo $revision['time']; ?></div>
			
			<div class="panel-body">
				<?php echo $this->Html->link("Ver", array('action' => 'userRevisionDetails', 'text' => $revision['text']), array('class' => 'btn btn-sm btn-default')); ?>
				
			</div>
		</div>
	<?php endforeach; ?>
</div>
