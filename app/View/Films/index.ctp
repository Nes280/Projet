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
    <nav>
        <ul>
    <?php 
        foreach ($films as $film): 
            echo '<li>'.$this->Html->link($film['Film']['nom'],
                array('controller' => 'films', 'action' => 'view', $film['Film']['id'])).'</li>'; 
        endforeach; 
        unset($film); ?>
    </ul>
    </body>
</html>
