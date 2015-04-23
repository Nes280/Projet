<div class="sticky"><!--<div class="contain-to-grid"-->
  <nav class="top-bar" data-topbar>
    <ul class="title-area">
      <li class="name">
        <h1><?php echo $this->Html->link('Film\'O Tech', array('controller' => 'films','action'=>'index'));?></h1>
      </li>
    </ul>

    <section class="top-bar-section">
      <!-- Right Nav Section -->
      <ul class="right">
          
            <?php
              if(AuthComponent::user('Membre'))
              {
                $nom = AuthComponent::user('Membre');
                $nom = $nom['username'];
            ?>
                <li class="has-dropdown">
                  <a href="#"><?php echo $nom?></a>
                  <ul class="dropdown">
                    <?php echo "<li>".$this->Html->link('Modifier le profil', array('controller' => 'Membres','action'=>'modifier'))."</li>";
                          //echo "<li>".$this->Html->link('Noter des films', array('controller' => 'Membres','action'=>''))."</li>";
                          echo "<li>".$this->Html->link('Mes Groupes', array('controller' => 'Groupes','action'=>'mesgroupes'))."</li>";
                    ?>
                  </ul>
                </li>
            <?php
                $val = AuthComponent::user('Membre');
                if($val['administrateur'] == true)
                {
            ?>
                <li class="has-dropdown">
                  <a href="#">Administration</a>
                  <ul class="dropdown">
                    <?php echo "<li>".$this->Html->link('Ajout de film', array('controller' => 'Films','action'=>'ajoutfilm'))."</li>";
                          echo "<li>".$this->Html->link('Création de groupe', array('controller' => 'Groupes','action'=>'creer'))."</li>";
                    ?>
                  </ul>
                </li>

              <?php
                }
                echo "<li>".$this->Html->link('Groupes', array('controller' => 'Groupes','action'=>'index'))."</li>";
                echo "<li class='active'>".$this->Html->link('Déconnexion', array('controller' => 'Membres','action'=>'logout'))."</li>";
              }
              else
              {
                echo "<li class='active'>".$this->Html->link('Inscription', array('controller' => 'Membres','action'=>'enregistrer'))."</li>";
                echo "<li class='active'>".$this->Html->link('Connexion ', array('controller' => 'Membres','action'=>'login'))."<li>";
              }
          ?>
      </ul>

      <!-- Left Nav Section -->
      <ul class="left">
        <li class="has-dropdown">
        <a href="#">Films</a>
        <ul class="dropdown">
          <?php echo "<li>".$this->Html->link('Genre de films', array('controller' => 'genres','action'=>'index'))."</li>";
                echo "<li>".$this->Html->link('Format de films', array('controller' => 'formats','action'=>'index'))."</li>";
                
          ?>
        </ul>
      </li>
      <li>
          <?php
            echo $this->Html->link('Classement', array(
              'controller' => 'films',
              'action'=>'classement'));
          ?>
        </li>
        <li>
         <?php echo$this->Html->link('Recherche', array('controller' => 'recherches','action'=>'index')); ?>
        <!-- class="has-form">
          <div class="row collapse">
            <div class="large-8 columns">
              <input type="text" id="q" placeholder="film, acteur...">
            </div>
            <div class="large-4 columns">
              <?php echo $this->Html->link(
                  'Rechercher',
                  ['controller' => 'recherches','action'=>'index'],
                  ['class'=>'alert button expand']
              );?>
            </div>
          </div>
        </li-->
      </ul>
    </section>
  </nav>
</div>
