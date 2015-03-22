<h1><?php echo $genre['Genre']['genre']; ?></h1>
<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-4">
<?php
	foreach ($filmsGenre as $f ):
         echo "<li>".$this->Html->link($this->Html->image(
                        "Films/".$f['F']['nom'].".jpg", 
                            array(
                                "alt" => $f['F']['nom']
                                )),
                    array(
                        'controller' => 'films', 
                        'action' => 'view', 
                        $f['F']['id']),
                        array('escape' => false))."</li>";
        endforeach;
       // debug($filmsGenre);
 ?>
</ul>
