<h1><?php echo $film['Film']['nom']; ?></h1>

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
		    					<iframe width='1280' height='720' src='".$film['Film']['video']."' framebordeer='0' ></iframe>
		  					</div>
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
			switch ($res) {
				case '1':
					echo "mauvais";
					break;
				case '2':
					echo "moyen";
					break;
				case '3':
					echo "bon";
					break;
				case '4':
					echo "très bon";
					break;
				case '5':
					echo "excelent";
					break;
				default:
					echo "pas de note";
					break;
			}
	      	?></h3>
	      	<a href="#" data-reveal-id="myModal">voter</a>
			<div id="myModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
			 <?php echo "<h2 id='modalTitle'>Voter pour ".$film['Film']['nom']." </h2>"?>
			  <form>
			  	<p>
			  		<label for="note">Choisissez une note</label>
			  		<select name="note" id="note">
			  			<option value="1">mauvais</option>
			  			<option value="2">moyen</option>
			  			<option value="3">bon</option>
			  			<option value="4">très bon</option>
			  			<option value="5">excelent</option>
			  		</select>
			  	</p>
			  	<input type="submit" value="Noter" />
			  </form>	
			  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
			</div>	
	    </div>
	</div>
</div>


<?php
echo"<h5>Acteurs:</h5><ul>";
foreach ($acteursFilm as $a ):
         		echo '<li>'.$this->Html->link(
         				$a['Acteur']['prenom'].' '.$a['Acteur']['nom'],
         				array(
                        'controller' => 'acteurs', 
                        'action' => 'view', 
                        $a['Acteur']['id']
                        )
                    ).'</li>';
    // debug($a);
endforeach;
echo "</ul>";
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
		elseif ($f== 'distributeur_id')
		{
			foreach ($dist as $d) {
				if ($d['Distributeur']['id'] == $v) echo "<h5>Distributeur:</h5><p>".$d['Distributeur']['nom']."</p> ";
			}
		}
	}
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