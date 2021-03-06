<div class="row">
	<h2>Ajout du réalisateur</h2>
</div>
<?php 
if (AuthComponent::user('Membre')['administrateur']) {
echo $this->Form->create('Realisateur'); ?>
	<div class="row">
	    <div class="large-4 columns">
			<?php echo $this->Form->input('nom',array('label' =>"Nom", "type"=>"text", "maxlength"=>"30")); ?>
			<?php echo $this->Form->input('prenom',array('label' =>"Prénom", "type"=>"text", "maxlength"=>"30")); ?>
			<?php echo $this->Form->input('biographie',array('label' =>"Biographie", "type"=>"text", "maxlength"=>"100")); ?>

		</div>
	</div>
	<div class="row">
		<?php echo $this->Form->end('Enregistrer'); ?>
	</div>

	<?php echo $this->Html->link('Ajout du distributeur', array('controller' => 'Distributeurs','action'=>'ajoutdistributeur', $film['Film']['id']), array('class' => 'button success')); ?>

	<?php echo $this->Html->link('Ajout du genre', array('controller' => 'Genres','action'=>'ajoutgenre', $film['Film']['id']), array('class' => 'button success')); ?>

	<?php echo $this->Html->link('Ajout du format', array('controller' => 'Formats','action'=>'ajoutformat', $film['Film']['id']), array('class' => 'button success')); ?>

	<?php echo $this->Html->link('Ajout du pays', array('controller' => 'Pays','action'=>'ajoutpays', $film['Film']['id']), array('class' => 'button success')); ?>

	<?php echo $this->Html->link("Ajout d'acteur", array('controller' => 'Acteurs','action'=>'ajoutacteur', $film['Film']['id']), array('class' => 'button success')); ?>
<?php 
}

else echo '<div data-alert class="alert-box alert radius">
  				Vous devez être administrateur pour modifier ou ajouter du contenu!
  				<a href="#" class="close">&times;</a>
			</div>';


	?>
