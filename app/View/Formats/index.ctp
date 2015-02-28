<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Formats</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="SHORTCUT ICON" href="favicon.ico" /> 
    </head>

    <body>
    <h1>Format de films</h1>
    <nav>
        <ul>
    <?php foreach ($formats as $format): 
         echo '<li>'.$this->Html->link($format['Format']['format'],array('controller' => 'formats', 'action' => 'view', $format['Format']['id'])).'</li>'; 
        endforeach; 
        unset($format); ?>
    </ul>
    </body>
</html>
