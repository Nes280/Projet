<div class="row">
	<h1><?php echo $groupe['Groupe']['nom']; ?></h1>
	<h5>Description:</h5>
	<p><?php echo h($groupe['Groupe']['description']); ?></p>
	<?php echo $this->Html->link('Se désinscrire du groupe', array('controller' => 'Groupes','action'=>'desinscriregroupe', $groupe['Groupe']['id']), array('class' => 'button success')); ?>
</div>
