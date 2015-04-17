<h1><?php echo $realisateur['Realisateur']['prenom'],' ', $realisateur['Realisateur']['nom']?> </h1>
	<div class="row">
		   	<?php
		      	echo $this->Html->image("Realisateurs/".$realisateur['Realisateur']['nom'].".jpg",
					array(	
						"alt"=>$realisateur['Realisateur']['nom'],
						"data-equalizer-watch"=>"foo"));
		    ?>
	</div>
		<?php 
			if($realisateur['Realisateur']['biographie']!= NULL)
			{	
				echo '<h5>Biographie:</h5><p>'.$realisateur['Realisateur']['biographie'].'</p>';
			}
			echo'<h5>Films en relation avec '.$realisateur['Realisateur']['prenom'],' ', $realisateur['Realisateur']['nom'].':</h5>';
			// boucle qui affiche tt les films du realisateur qui sont dans la BD.
			?>
			<ul>
			<?php
			foreach ($filmsReal as $f ):
         		echo '<li>'.$this->Html->link(
         				$f['Film']['nom'],
         				array(
                        'controller' => 'films', 
                        'action' => 'view', 
                        $f['Film']['id']
                        )
                    ).'</li>';
     //debug($f);
        endforeach;
        ?>
        	</ul>