
<h2>s'enregistrer</h2>
<?php echo $this->Form->create('Membre'); ?>
	<div class="row">
	    <div class="large-4 columns">
			<?php echo $this->Form->input('nom',array('label' =>"Nom", "type"=>"text", "maxlength"=>"30")); ?>
			<?php echo $this->Form->input('prenom',array('label' =>"Prenom", "type"=>"text", "maxlength"=>"30")); ?>
			<?php echo $this->Form->input('username',array('label' =>"Login :", "type"=>"text", "maxlength"=>"15")); ?>
			<?php echo $this->Form->input('mdp',array('label' =>"Mot de passe", "type"=>"password")); ?>
			<?php echo $this->Form->input('age',array('label' =>"Age", "type"=>"number", "min"=>"10", "max"=>"110")); ?>
		</div>
	</div>
			<?php $attributes['value'] = 0; echo $this->Form->radio('administrateur',array("non", "oui"), $attributes); ?>
<?php echo $this->Form->end('enregistrer'); ?>

