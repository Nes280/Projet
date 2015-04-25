<h1><?php echo $film['Film']['nom'];?></h1>

<div class="row" >
	<div class="medium-4 columns">
	    <div  >
	      <?php
	      	echo $this->Html->image("Films/".$film['Film']['nom'].".jpg",
				array(
					"alt"=>$film['Film']['nom'],
					"data-equalizer-watch"=>"foo"));
	      ?>
	    </div>
	</div>
	<div class="medium-4 columns">
	    <div>
	      <?php
	      	if($film['Film']['video'] !="")
			{
				echo "<a href='#' data-reveal-id='video' class='radius button' data-equalizer-watch='foo'>Voir la vidéo</a>	
						<div id='video' class='reveal-modal large' data-reveal aria-labelledby='videoTitre' aria-hidden='true' role='dialog'>
		  					<h2 id='videoTitre'>".$film['Film']['nom']."</h2>
		  					<div class='flex-video widescreen '>
		    					<iframe width='1280' height='720' src='".$film['Film']['video']."' framebordeer='0' ></iframe>"
		    					./*$this->Html->media(
								    array(
								        $film['Film']['nom'].'.mp4',  
								    ),
								    array(
								    	'controls',
								    	'name'=>'media',
								    	)).*/
		  					"</div>
		  				</div>";
			}
	      ?>
	    </div>
	</div>
	<div class="medium-4 columns">
	    <div>
	      <?php
	      	if($film['Film']['site'] !="")
			{
				$site =$film['Film']['site'];
		  		echo"<a href='http://$site' class='radius button' target='_blank' data-equalizer-watch='foo'>Aller sur le site officiel</a>";
			}
	      ?>
	    </div>
	</div>
	<div class="medium-4 columns">
	    <div class="callout panel">
	      <h3>Note:
	      	<?php
	      	$somme = 0;
	      	$tour = 0;
	      	foreach ($note as $n ):
         		$somme += $n['Note']['note'];
         		$tour ++;
			endforeach;
			if ($tour != 0) {
				$res = $somme / $tour;
			}
			else $res = 0;
			if($res==0){
				echo "-<h5>pas de note</h5>";
			}
			elseif($res<2){
				for ($i=1; $i <6 ; $i++) { 
					if ($i<2) echo $this->Html->image("etoile.png",
							array(
							"alt"=>"etoile",
							));
				else echo $this->Html->image("etoileG.png",
							array(
							"alt"=>"etoile",
							));
				}
				echo " <h5>mauvais</h5>";
			}
			elseif ($res<3){
				for ($i=1; $i <6 ; $i++) { 
					if ($i<3) echo $this->Html->image("etoile.png",
						array(
						"alt"=>"etoile",
						));
					else echo $this->Html->image("etoileG.png",
							array(
							"alt"=>"etoile",
							));
				}
				echo " <h5>moyen</h5>";
			}
			elseif ($res<4){
				for ($i=1; $i <6 ; $i++) { 
					if ($i<4) echo $this->Html->image("etoile.png",
						array(
						"alt"=>"etoile",
						));
					else echo $this->Html->image("etoileG.png",
							array(
							"alt"=>"etoile",
							));
				}
				echo " <h5>bon</h5>";
			}
			elseif ($res<5){
				for ($i=1; $i <6 ; $i++) { 
					if ($i<5) echo $this->Html->image("etoile.png",
						array(
						"alt"=>"etoile",
						));
					else echo $this->Html->image("etoileG.png",
							array(
							"alt"=>"etoile",
							));
				}
				echo " <h5>très bon</h5>";
			}
			elseif ($res==5){
				for ($i=1; $i <6 ; $i++) { 
					echo $this->Html->image("etoile.png",
						array(
						"alt"=>"etoile",
						));
				}
				echo " <h5>excelent</h5>";
			}
			
	      	if(AuthComponent::user('Membre')){
	      		if(!$dejaVote){
	      	?></h3>
	      	<a href="#" data-reveal-id="myModal">voter</a>
			<div id="myModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
			 <?php echo "<h2 id='modalTitle'>Voter pour ".$film['Film']['nom']." </h2>"?>
			 <?php echo $this->Form->create('Note'); ?>
				<div class="row">
				    <div class="large-4 columns">
						<?php 
							echo $this->Form->select('note',[
								'1'=>'mauvais',
								'2'=>'moyen',
								'3'=>'bon',
								'4'=>'très bon',
								'5'=>'excelent'
								],[
								'default'=>'3',
								'empty'=>false
								]);
							 ?>
					</div>
				</div>
				<div class="row">
					<?php echo $this->Form->end('Noter'); ?>
				</div>
			  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
			</div>
			</h3>
			<?php }
				else{
					echo "</br>";
					switch ($laNote) {
						case '1':
							echo "Vous considérez ce film comme mauvais.";
							break;
						case '2':
							echo "Vous considérez ce film comme moyen.";
							break;
						case '3':
							echo "Vous considérez ce film comme bon.";
							break;
						case '4':
							echo "Vous considérez ce film comme très bon.";
							break;
						case '5':
							echo "Vous considérez ce film comme excelent.";
							break;
						
						default:
							echo"Il y a un problème avec votre note";
							break;
					}
				}
			}
			 ?>	
	    </div>
	</div>
</div>


<?php
if ($acteursFilm!=NULL) {
	echo'<h5>Acteurs:</h5><ul class="inline-list">';
	foreach ($acteursFilm as $a ):
		if ($a['Acteur']['biographie']) {
			echo '<li>'.$this->Html->link(
	         	$a['Acteur']['prenom'].' '.$a['Acteur']['nom'],
	         	array(
	                'controller' => 'acteurs', 
	                'action' => 'view', 
	                $a['Acteur']['id']
	            )
	       	).'</li>';
		}
		else echo "<li>".$a['Acteur']['prenom']." ".$a['Acteur']['nom']."</li>";
	    // debug($a);
	endforeach;
	echo "</ul>";
}

foreach ($film['Film'] as $f => $v) {
	if ($v != '') 
	{	
		//$h5 = ucfirst($f);//on met une majuscule
		if($f=='synopsis')echo "<h5>Synopsis:</h5><p>$v</p>";
		elseif ($f=='duree') echo "<h5>Durée:</h5><p>$v minutes</p>";
		elseif ($f=='date')echo "<h5>Date:</h5><p>".ereg_replace("([0-9]{4})-([0-9]{2})-([0-9]{2})", "\\3/\\2/\\1",$v)."</>";
		elseif ($f=='nbSaisons') echo "<h5>Nombre de saisons:</h5><p>$v</p>";
		elseif ($f=='nbEpisodes') echo "<h5>Nombre d'épisodes:</h5><p>$v</p>";
		elseif ($f=='budget') echo "<h5>Budget:</h5><p>$v €</p>";
	}
}

if ($dist!=NULL) {
	echo '<h5>Distributeur:</h5><ul class="inline-list">';
	foreach ($dist as $d) {
		//debug($r);
		echo '<li>'.$d['Distributeur']['nom'].'</li>';
	}
}

if ($real!=NULL) {
	echo '</ul><h5>Realisateur:</h5><ul class="inline-list">';
	foreach ($real as $r) {
		//debug($r);
		if ($r['Realisateur']['biographie']!= NULL) {
		
			echo '<li>'.$this->Html->link($r['Realisateur']['prenom']." ".$r['Realisateur']['nom'],
				array(
		                        'controller' => 'Realisateurs', 
		                        'action' => 'view', 
		                        $r['Realisateur']['id']
		                        )
		                    ).'</li>';
		}
		else echo "<li>".$r['Realisateur']['prenom']." ".$r['Realisateur']['nom']."</li>";
	}
}

if ($pays!=NULL) {
	echo '</ul><h5>Pays:</h5><ul class="inline-list">';
	foreach ($pays as $p) {
			echo "<li><p>".$this->Html->image("Pays/".$p['Pays']['pays'].".png",
						array(
							"alt"=>$p['Pays']['pays'],
							"data-equalizer-watch"=>"foo"))." ".$p['Pays']['pays']."</p></li>";

	}
	echo "</ul>";
}

?>
<!--p><?php echo $film['Film']['synopsis']; ?></p>
<h5>Durée :</h5>
<p><?php echo $film['Film']['duree']." minutes"; ?></p>
<h5>Date de première diffusion :</h5>
<p><?php echo ereg_replace("([0-9]{4})-([0-9]{2})-([0-9]{2})", "\\3/\\2/\\1",$film['Film']['date']); ?></p>
<h5>Nombre de saison(s) :</h5> 
<p><?php echo $film['Film']['nbSaisons']; ?></p>
<h5>Nombre d'épisode(s) :</h5>
<p><?php echo $film['Film']['nbEpisodes']; ?></p>
<h5>Site web :</h5>
<p><?php echo "<a href='".$film['Film']['site']."'>".$film['Film']['site']."</a>" ?></p-->