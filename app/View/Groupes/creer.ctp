<div class="row">
	<h2>Créer un groupe</h2>
</div>
<?php echo $this->Form->create('Groupe'); ?>
	<div class="row">
	    <div class="large-4 columns">
			<?php echo $this->Form->input('nom',array('label' =>"Nom", "type"=>"text", "maxlength"=>"30")); ?>
		</div>
		<div class="large-12 columns">
			<?php echo $this->Form->input('description',array('label' =>"Description", "type"=>"text", "maxlength"=>"100")); ?>
		</div>
	</div>
	<div class="row">
		<?php echo $this->Form->end('Créer'); ?>
	</div>

