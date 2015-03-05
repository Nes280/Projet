<h1><?php echo $genre['Genre']['genre']; ?></h1>
<ul>
<?php
	foreach ($filmsGenre as $f ):
         echo"<li>".$this->Html->link($f['Film']['nom'],array('controller' => 'films', 'action' => 'view', $f['Film']['id']))."</li>"; 
        endforeach;
 ?>
</ul>
