<div class="row">
	<h2>Ajout d'un film</h2>
</div>
<?php 
if (AuthComponent::user('Membre')['administrateur']) {


	echo $this->Form->create('Film');?>
	<div class="row">
	    <div class="large-4 columns">
			<?php echo $this->Form->input('nom',array('label' =>"Nom", "type"=>"text", "maxlength"=>"100")); ?>
			<?php echo $this->Form->input('synopsis',array('label' =>"Synopsis", "type"=>"textarea")); ?>
			<?php echo $this->Form->input('budget',array('label' =>"Budget en €", "type"=>"number")); ?>
			<?php echo $this->Form->input('duree',array('label' =>"Durée en minutes", "type"=>"number")); ?>
			<?php echo $this->Form->input('date',array('label' =>"Date", "type"=>"date",'minYear' => 1900,'maxYear' =>date('Y'))); ?>
			<?php echo $this->Form->input('nbSaisons',array('label' =>"Nombre de saisons", "type"=>"number")); ?>
			<?php echo $this->Form->input('nbEpisodes',array('label' =>"Nombre d'épisodes", "type"=>"number")); ?>
			<?php echo $this->Form->input('site',array('label' =>"Site", "type"=>"text", "maxlength"=>"100")); ?>
		</div>
	</div>
	<div class="row">
		<?php echo $this->Form->end('Enregistrer');?>
	</div>
	<?php 
}

else echo '<div data-alert class="alert-box alert radius">
  				Vous devez être administrateur pour ajouter un film!
  				<a href="#" class="close">&times;</a>
			</div>';


	?>