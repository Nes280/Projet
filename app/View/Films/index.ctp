<h1>Accueil</h1>
    <h3> A la une: </h3>
<?php 
    //echo '<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-3">';
    echo'<div class="row"><div class="panel">';
    $i=false;
    foreach ($films as $film): 
        //debug($film);
        if ($i!=true) {
            foreach ($lesFilms as $l) {
                 //debug($l);
                if ($l['Film']['id']==$film['film_id']) {
                    echo '<div class="medium-4 columns">'.$tableau[$i]=$this->Html->link($this->Html->image(
                        "Films/".$l['Film']['nom'].".jpg", 
                        array(
                            "alt" => "slide $i",
                            "height"=>"80%",
                            "width"=>"80%"
                       )),
                        array(
                            'controller' => 'films', 
                            'action' => 'view', 
                            $l['Film']['id']),
                            array('escape' => false)).'</div>';
                    echo '<div class="medium-8 columns"><h2>'.$l['Film']['nom'].'</h2>';
                    $res=$film['note']/$film['volume'];
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
                        
                    }
                    elseif ($res==5){
                        for ($i=1; $i <6 ; $i++) { 
                            echo $this->Html->image("etoile.png",
                                array(
                                "alt"=>"etoile",
                                ));
                        }
                        
                    }
                    echo "</div>";
                    echo "<p>".$l['Film']['synopsis']."</p>";
                    echo"<p>";
                    echo $this->Html->link('Voir ce film!',
                         array(
                            'controller' => 'films', 
                            'action' => 'view', 
                            $l['Film']['id']),
                            array(
                                'escape' => false,
                                'class'=>'radius button'
                            ));
                    echo "</p>";
                    $i=true;
                    }
                }
            }
              
    endforeach;
    echo "</div></div>";
    //if (!AuthComponent::user('Membre')) {
        echo '<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-5">';
        foreach ($lesFilms as $f) {
            echo '<li>'.$tableau[$i]=$this->Html->link($this->Html->image(
                            "Films/".$f['Film']['nom'].".jpg", 
                            array(
                                "alt" => $f['Film']['nom'],
                                "height"=>"70%",
                                "width"=>"70%"
                           )),
                            array(
                                'controller' => 'films', 
                                'action' => 'view', 
                                $f['Film']['id']),
                                array('escape' => false)).'</li>';
        }
    //}
    unset($film); ?>
    
    </body>
</html>

