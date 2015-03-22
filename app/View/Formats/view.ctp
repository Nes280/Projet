<h1><?php echo $format['Format']['format']; ?></h1>
<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-4">
<?php
	foreach ($filmsFormat as $f ):
         echo "<li>".$this->Html->link($this->Html->image(
                        "Films/".$f['Film']['nom'].".jpg", 
                            array(
                                "alt" => $f['Film']['nom']
                                )),
                    array(
                        'controller' => 'films', 
                        'action' => 'view', 
                        $f['Film']['id']),
                        array('escape' => false))."</li>";
        endforeach;
 ?>
</ul>