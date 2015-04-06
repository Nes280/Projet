<h1><?php echo $acteur['Acteur']['prenom'],' ', $acteur['Acteur']['nom']?> </h1>
	<div class="row">
		   	<?php
		      	echo $this->Html->image("Acteurs/".$acteur['Acteur']['nom'].".jpg",
					array(	
						"alt"=>$acteur['Acteur']['nom'],
						"data-equalizer-watch"=>"foo"));
		    ?>
	</div>
		<?php 
			if($acteur['Acteur']['biographie']!= NULL)
			{	
				echo '<h5>Biographie:</h5><p>'.$acteur['Acteur']['biographie'].'</p>';
			}
			echo'<h5>Films en relation avec '.$acteur['Acteur']['prenom'],' ', $acteur['Acteur']['nom'].':</h5>';
			// boucle qui affiche tt les films de l'acteur qui sont dans la BD.
			?>
			<ul>
			<?php
			foreach ($filmsActeur as $f ):
         echo '<li>'.$this->Html->link(
         				$f['F']['nom'],
         				array(
                        'controller' => 'films', 
                        'action' => 'view', 
                        $f['F']['id']
                        )
                    ).'</li>';
     //debug($f);
        endforeach;
        ?>
        	</ul>