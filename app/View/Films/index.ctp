<h1>Accueil</h1>
    <h3> A la une: </h3>
    <?php 
        echo '<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-4">';
        foreach ($films as $film): 
            echo    "<li>".$this->Html->link($this->Html->image(
                        "Films/".$film['Film']['nom'].".jpg", 
                            array(
                                "alt" => $film['Film']['nom']
                                )),
                    array(
                        'controller' => 'films', 
                        'action' => 'view', 
                        $film['Film']['id']),
                        array('escape' => false))."</li>"; 
        
        endforeach; 
        echo "</ul>";
        unset($film); ?>
    
    </body>
</html>

