<div class="row">
	<h2>Modifier</h2>
</div>
<?php echo $this->Form->create('Membre'); ?>
	<div class="row">
	    <div class="large-4 columns">
			<?php echo $this->Form->input('nom',array('label' =>"Nom", "type"=>"text", "maxlength"=>"30", "value"=>$membre['Membre']['nom'])); ?>
			<?php echo $this->Form->input('prenom',array('label' =>"Prenom", "type"=>"text", "maxlength"=>"30", "value"=>$membre['Membre']['prenom'])); ?>
			<?php echo $this->Form->input('mdp',array('label' =>"Mot de passe", "type"=>"password")); ?>
			<?php echo $this->Form->input('age',array('label' =>"Age", "type"=>"number", "min"=>"10", "max"=>"110", "value"=>$membre['Membre']['age'])); ?>
		</div>
	</div>
	<div class="row">
		<div class="large-6 columns">
			<?php $attributes['value'] = $membre['Membre']['administrateur']; echo $this->Form->radio('administrateur',array("non", "oui"), $attributes); ?>
		</div>
	</div>
	<div class="row">
		<?php echo $this->Form->end('Modifier'); ?>
	</div>

