<h1> Top 5 des films </h1>
<?php
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
 ?>