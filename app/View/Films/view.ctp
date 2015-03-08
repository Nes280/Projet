<h1><?php echo $film['Film']['nom']; ?></h1>
<?php echo"<img src='../../app/webroot/img/".$film['Film']['nom'].".jpg' height='740' width='500'>";?>
<h5>Synopsis :</h5>
<?php
	if($film['Film']['video'] !="")
	{
		echo "	<div>
					<iframe width='840' height='630' src='".$film['Film']['video']."' framebordeer='0' ></iframe>
				</div>";
	}
?>
<p><?php echo h($film['Film']['synopsis']); ?></p>
<h5>Durée :</h5>
<p><?php echo h($film['Film']['duree'])." minutes"; ?></p>
<h5>Date de première diffusion :</h5>
<p><?php echo ereg_replace("([0-9]{4})-([0-9]{2})-([0-9]{2})", "\\3/\\2/\\1",$film['Film']['date']); ?></p>
<h5>Nombre de saison(s) :</h5> 
<p><?php echo $film['Film']['nbSaisons']; ?></p>
<h5>Nombre d'épisode(s) :</h5>
<p><?php echo $film['Film']['nbEpisodes']; ?></p>
<h5>Site web :</h5>
<p><?php echo "<a href='".$film['Film']['site']."'>".$film['Film']['site']."</a>" ?></p>