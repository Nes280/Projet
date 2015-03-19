<div class="row">
	<h2>Modifier le mot de passe</h2>
</div>
<?php echo $this->Form->create('Membre'); ?>
<div class="row">
    <div class="large-4 columns">
		<?php echo $this->Form->input('ancien_mdp',array('label' =>" Ancien mot de passe ", "type"=>"password")); ?>
		<?php echo $this->Form->input('mdp',array('label' =>" Nouveau mot de passe ", "type"=>"password")); ?>
	</div>
</div>
<div class="row">
	<?php echo $this->Form->end('Modifier'); ?>
</div>
