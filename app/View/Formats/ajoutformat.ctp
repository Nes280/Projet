<div class="row">
	<h2>Ajout du format</h2>
</div>
<?php echo $this->Form->create('Format'); ?>
	<div class="row">
	    <div class="large-4 columns">
			<?php //echo $this->Form->input('format',array('label' =>"Format", "type"=>"text", "maxlength"=>"30")); 
			 
				$options=array();
				foreach ($format as $f) {
					$options[$f['Format']['format']]=$f['Format']['format'];
				}

				echo $this->Form->select('format', $options, ['escape' => false,'empty'=>false]);
			?>
		</div>
	</div>
	<div class="row">
		<?php echo $this->Form->end('Enregistrer'); ?>
	</div>

	<?php echo $this->Html->link("Ajout d'acteur", array('controller' => 'Acteurs','action'=>'ajoutacteur', $film['Film']['id']), array('class' => 'button success')); ?>

	<?php echo $this->Html->link('Ajout du distributeur', array('controller' => 'Distributeurs','action'=>'ajoutdistributeur', $film['Film']['id']), array('class' => 'button success')); ?>

	<?php echo $this->Html->link('Ajout du genre', array('controller' => 'Genres','action'=>'ajoutgenre', $film['Film']['id']), array('class' => 'button success')); ?>

	<?php echo $this->Html->link('Ajout du pays', array('controller' => 'Pays','action'=>'ajoutpays', $film['Film']['id']), array('class' => 'button success')); ?>

	<?php echo $this->Html->link('Ajout du réalisateur', array('controller' => 'Realisateurs','action'=>'ajoutrealisateur', $film['Film']['id']), array('class' => 'button success')); ?>
