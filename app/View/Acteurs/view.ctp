<h1><?php echo $acteur['Acteur']['prenom'],' ', $acteur['Acteur']['nom']?> </h1>
	<div class="row">
		   	<?php
		      	echo $this->Html->image("Acteurs/".$acteur['Acteur']['nom'].".jpg",
					array(	
						"alt"=>$acteur['Acteur']['nom'],
						"data-equalizer-watch"=>"foo"));
		    ?>
	</div>
	<p>
		<?php
			echo $acteur['Acteur']['biographie'];
		?>