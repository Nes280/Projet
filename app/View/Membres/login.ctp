<div class="row">
	<h2>Se connecter</h2>
</div>
<?php echo $this->Form->create('Membre'); ?>
	<div class="row">
	    <div class="large-4 columns">
			<?php echo $this->Form->input('username',array('label' =>"Login", "type"=>"text", "maxlength"=>"15")); ?>
			<?php echo $this->Form->input('mdp',array('label' =>"Mot de passe", "type"=>"password")); ?>
		</div>
	</div>
	<div class="row">
		<?php echo $this->Form->end('Se connecter'); ?>
	</div>
