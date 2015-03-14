<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Genres</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="SHORTCUT ICON" href="favicon.ico" /> 
    </head>

    <body>
    <h1>Genres de films</h1>
    <nav>
        <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-4">
    <?php foreach ($genres as $genre): 
         echo    "<li>".$this->Html->link($this->Html->image(
                        "Genres/".$genre['Genre']['genre'].".png", 
                            array(
                                "alt" => $genre['Genre']['genre']
                                )),
                    array(
                        'controller' => 'genres', 
                        'action' => 'view', 
                        $genre['Genre']['id']),
                        array('escape' => false))."</li>";
        endforeach; 
        unset($genre); ?>
    </ul>
    </body>
</html>
