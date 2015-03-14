<h1>Format de films</h1>
    <nav>
        <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-4">
    <?php foreach ($formats as $format): 
          echo    "<li>".$this->Html->link($this->Html->image(
                        "Formats/".$format['Format']['format'].".png", 
                            array(
                                "alt" => $format['Format']['format']
                                )),
                    array(
                        'controller' => 'formats', 
                        'action' => 'view', 
                        $format['Format']['id']),
                        array('escape' => false))."</li>"; 
        endforeach; 
        unset($format); ?>
    </ul>

