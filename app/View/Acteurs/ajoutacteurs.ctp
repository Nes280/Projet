<div class="row">
	<h2>Ajout d'acteur</h2>
</div>
<?php echo $this->Form->create('Acteur'); ?>
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