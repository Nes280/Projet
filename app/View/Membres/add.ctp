
<?php echo $this->Form->create('Membres'); ?>
	<?php echo $this->Form->input('nom',array('label' =>"nom", "type"=>"text", "maxlength"=>"30")); ?>
	<?php echo $this->Form->input('prenom',array('label' =>"prenom", "type"=>"text", "maxlength"=>"30")); ?>
	<?php echo $this->Form->input('pseudo',array('label' =>"pseudo", "type"=>"text", "maxlength"=>"15")); ?>
	<?php echo $this->Form->input('login',array('label' =>"login", "type"=>"password")); ?>
	<?php echo $this->Form->input('age',array('label' =>"age", "type"=>"number", "min"=>"10", "max"=>"110")); ?>
	<?php echo $this->Form->radio('admin',array("oui", "non")); ?>
<?php echo $this->Form->end('Envoyer'); ?>

