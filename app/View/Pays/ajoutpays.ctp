<div class="row">
	<h2>Ajout de pays</h2>
</div>
<?php 
if (AuthComponent::user('Membre')['administrateur']) {
echo $this->Form->create('Pays'); ?>
	<div class="row">
	    <div class="large-4 columns">
			<?php 
				/*foreach ($pays as $p) {
					$options[$p['pays']['pays']]=$p['pays']['pays'];
				}

				echo $this->Form->select('pays', $options, ['escape' => false,'empty'=>false]);*/

				echo $this->Form->input('pays',array('label' =>"Pays", "type"=>"text", "maxlength"=>"30")); 
					

			?>
		</div>
	</div>
	<div class="row">
		<?php echo $this->Form->end('Enregistrer'); ?>
	</div>

	<?php echo $this->Html->link("Ajout d'acteur", array('controller' => 'Acteurs','action'=>'ajoutacteur', $film['Films']['id']), array('class' => 'button success')); ?>

	<?php echo $this->Html->link('Ajout du distributeur', array('controller' => 'Distributeurs','action'=>'ajoutdistributeur', $film['Films']['id']), array('class' => 'button success')); ?>

	<?php echo $this->Html->link('Ajout du format', array('controller' => 'Formats','action'=>'ajoutformat', $film['Films']['id']), array('class' => 'button success')); ?>

	<?php echo $this->Html->link('Ajout du genre', array('controller' => 'Genres','action'=>'ajoutgenre', $film['Films']['id']), array('class' => 'button success')); ?>

	<?php echo $this->Html->link('Ajout du réalisateur', array('controller' => 'Realisateurs','action'=>'ajoutrealisateur', $film['Films']['id']), array('class' => 'button success')); ?>
<?php 
}

else echo '<div data-alert class="alert-box alert radius">
  				Vous devez être administrateur pour modifier ou ajouter du contenu!
  				<a href="#" class="close">&times;</a>
			</div>';


	?>
