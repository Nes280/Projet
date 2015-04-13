<div class="row">
	<h2>Ajout d'un film</h2>
</div>
<?php echo $this->Form->create('Film'); ?>
	<div class="row">
	    <div class="large-4 columns">
			<?php echo $this->Form->input('nom',array('label' =>"Nom", "type"=>"text", "maxlength"=>"30")); ?>
			<?php echo $this->Form->input('synopsis',array('label' =>"Synopsis", "type"=>"text", "maxlength"=>"100")); ?>
			<?php echo $this->Form->input('budget',array('label' =>"Budget", "type"=>"number")); ?>
			<?php echo $this->Form->input('duree',array('label' =>"Durée", "type"=>"number")); ?>
			<?php echo $this->Form->input('date',array('label' =>"Date", "type"=>"date")); ?>
			<?php echo $this->Form->input('nbSaisons',array('label' =>"Nombre de saisons", "type"=>"number")); ?>
			<?php echo $this->Form->input('nbEpisodes',array('label' =>"Nombre d'épisodes", "type"=>"number")); ?>
			<?php echo $this->Form->input('site',array('label' =>"Site", "type"=>"text", "maxlength"=>"30")); ?>
		</div>
	</div>
	<div class="row">
		<?php echo $this->Form->end('Enregistrer'); ?>
	</div>