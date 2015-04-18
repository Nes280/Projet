<div class="row">
	<h2>Ajout du genre</h2>
</div>
<?php echo $this->Form->create('Genre'); ?>
	<div class="row">
	    <div class="large-4 columns">
			<?php echo $this->Form->input('genre',array('label' =>"Genre", "type"=>"text", "maxlength"=>"30")); ?>
		</div>
	</div>
	<div class="row">
		<?php echo $this->Form->end('Enregistrer'); ?>
	</div>

	<?php echo $this->Html->link("Ajout d'acteur", array('controller' => 'Acteurs','action'=>'ajoutacteur', $film['Film']['id']), array('class' => 'button success')); ?>

	<?php echo $this->Html->link('Ajout du distributeur', array('controller' => 'Distributeurs','action'=>'ajoutdistributeur', $film['Film']['id']), array('class' => 'button success')); ?>

	<?php echo $this->Html->link('Ajout du format', array('controller' => 'Formats','action'=>'ajoutformat', $film['Film']['id']), array('class' => 'button success')); ?>

	<?php echo $this->Html->link('Ajout du pays', array('controller' => 'Pays','action'=>'ajoutpays', $film['Film']['id']), array('class' => 'button success')); ?>

	<?php echo $this->Html->link('Ajout du réalisateur', array('controller' => 'Realisateurs','action'=>'ajoutrealisateur', $film['Film']['id']), array('class' => 'button success')); ?>
