<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Accueil</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="SHORTCUT ICON" href="favicon.ico" /> 
    </head>

    <body>
    <h1>Liste des films</h1>
    <p> GENRE : </p>
    <?php foreach ($genres as $genre): 
         echo '<p>'.$this->Html->link($genre['Genre']['genre'],array('controller' => 'genres', 'action' => 'view', $genre['Genre']['id'])).'</p>'; 
        endforeach; 
        unset($genre); ?>
    </body>
</html>
