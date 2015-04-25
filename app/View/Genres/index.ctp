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
        <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-6">
    <?php foreach ($genres as $genre):
        if ($genre['Film']!=NULL) {
             echo    "<li><h4>".$this->Html->link($genre['Genre']['genre']/*$this->Html->image(
                            "Genres/".$genre['Genre']['genre'].".png", 
                                array(
                                    "alt" => $genre['Genre']['genre'],
                                      "width" => "50%",
                                    "height" => "50%"
                                    ))*/,
                        array(
                            'controller' => 'genres', 
                            'action' => 'view', 
                            $genre['Genre']['id']),
                            array('escape' => false))."</h4></li>";
        }
        endforeach; 
        unset($genre); ?>
    </ul>
    </body>
</html>
