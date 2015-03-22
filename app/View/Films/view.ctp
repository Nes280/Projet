<h1><?php echo $film['Film']['nom']; ?></h1>
<?php //echo"<img src='../../app/webroot/img/".$film['Film']['nom'].".jpg' height='740' width='500'>";
	echo $this->Html->image("Films/".$film['Film']['nom'].".jpg",
		array(
			"alt"=>$film['Film']['nom'],
			"class"=>"imgTitre"));

	if($film['Film']['video'] !="")
	{
		echo "<a href='#'' data-reveal-id='video' class='radius button'>Voir la vidéo</a>";

		echo "	<div id='video' class='reveal-modal large' data-reveal aria-labelledby='videoTitre' aria-hidden='true' role='dialog'>
  					<h2 id='videoTitre'>".$film['Film']['nom']."</h2>
  					<div class='flex-video widescreen '>
    					<iframe width='1280' height='720' src='".$film['Film']['video']."' framebordeer='0' ></iframe>
  					</div>
  				</div>";
	}
?>

<?php
foreach ($film['Film'] as $f => $v) {
	if ($v != '') 
	{
		//$h5 = ucfirst($f);//on met une majuscule
		if($f=='synopsis')echo "<h5>Synopsis:</h5><p>$v</p>";
		elseif ($f=='duree') echo "<h5>Durée:</h5><p>$v minutes</p>";
		elseif ($f=='date')echo "<h5>Date:</h5><p>".ereg_replace("([0-9]{4})-([0-9]{2})-([0-9]{2})", "\\3/\\2/\\1",$v)."</>";
		elseif ($f=='note') echo "<h5>Note:</h5><p>$v</p>";
		elseif ($f=='nbSaisons') echo "<h5>Nombre de saisons:</h5><p>$v</p>";
		elseif ($f=='nbEpisodes') echo "<h5>Nombre d'épisodes:</h5><p>$v</p>";
		elseif ($f=='site') echo "<h5>Site web:</h5><p><a href='$v'>$v</a></p>";
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