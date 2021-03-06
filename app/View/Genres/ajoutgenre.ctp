<div class="row">
	<h2>Ajout du genre</h2>
</div>
<?php 
if (AuthComponent::user('Membre')['administrateur']) {
echo $this->Form->create('Genre'); ?>
	<div class="row">
	    <div class="large-4 columns">
			<?php //echo $this->Form->input('genre',array('label' =>"Genre", "type"=>"text", "maxlength"=>"30")); 
				$options=array();
				foreach ($genre as $g) {
					$options[$g['Genre']['genre']]=$g['Genre']['genre'];
				}

				echo $this->Form->select('genre', $options, ['escape' => false,'empty'=>false]);
			?>
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
	<?php 
}

else echo '<div data-alert class="alert-box alert radius">
  				Vous devez être administrateur pour modifier ou ajouter du contenu!
  				<a href="#" class="close">&times;</a>
			</div>';


	?>
