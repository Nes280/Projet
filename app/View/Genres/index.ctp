<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Genres</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="SHORTCUT ICON" href="favicon.ico" /> 
    </head>

    <body>
    <h1>Genre de films</h1>
    <nav>
        <ul>
    <?php foreach ($genres as $genre): 
         echo '<li>'.$this->Html->link($genre['Genre']['genre'],array('controller' => 'genres', 'action' => 'view', $genre['Genre']['id'])).'</li>'; 
        endforeach; 
        unset($genre); ?>
    </ul>
    </body>
</html>
