<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Groupes</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="SHORTCUT ICON" href="favicon.ico" /> 
    </head>

    <body>
    <h1>Groupes</h1>
    <nav>
        <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-4">
    <?php foreach ($groupes as $groupe): 
         echo    "<li>".$this->Html->link(
                            $groupe['G']['nom'],
                            array('controller' => 'Groupes', 'action' => 'affichagegroupe', $groupe['G']['id'])
                        )
                        ."</li>";
        endforeach; 
        unset($groupe); ?>
    </ul>
    </body>
</html>