<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Accueil</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="SHORTCUT ICON" href="favicon.ico" /> 
    </head>

    <body>
    <h1>Accueil</h1>
        
    <?php 
        echo "<table>";
        foreach ($films as $film): 
            echo    "<td>".$this->Html->link($this->Html->image(
                        $film['Film']['nom'].".jpg", 
                            array(
                                "alt" => $film['Film']['nom'],
                                "height" => "200",
                                "width" => "150")),
                    array(
                        'controller' => 'films', 
                        'action' => 'view', 
                        $film['Film']['id']),
                        array('escape' => false))."</td>"; 
        
        endforeach; 
        echo "</table>";
        unset($film); ?>
    
    </body>
</html>

