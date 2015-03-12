<h1><?php echo $format['Format']['format']; ?></h1>
<ul>
<?php
	foreach ($filmsFormat as $f ):
         echo"<li>".$this->Html->link($f['Film']['nom'],array('controller' => 'films', 'action' => 'view', $f['Film']['id']))."</li>"; 
        endforeach;
 ?>
</ul>