<h1> Top 5 des films </h1>
<?php
echo ' <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-5">';
$i = 1;
//echo"<h2>";
for($i=1;$i<6;$i++)
{
            switch ($i) {
                case '1':
                    echo "<li> 1er </li>";
                    break;
                case '2':
                    echo "<li> 2nd </li>";
                    break;
                case '3':
                    echo "<li> 3ème </li>";
                    break;
                case '4':
                    echo "<li> 4ème </li>";
                    break;
                case '5':
                    echo "<li> 5ème </li>";
                    break;
                
                default:
                    echo"<li> Non classé </li>";                    
                    break;
            }
            
        
}
//echo "</h2>";
foreach ($films as $film): 
    //debug($film);
            echo    "<li>".$this->Html->link($this->Html->image(
                        "Films/".$film['F']['nom'].".jpg", 
                            array(
                                "alt" => $film['F']['nom'],
                                "height" => "200",
                                "width" => "150")),
                    array(
                        'controller' => 'films', 
                        'action' => 'view', 
                        $film['F']['id']),
                        array('escape' => false))."</li>"; 
        
endforeach; 
echo "</ul>";
 ?>