<div class="contain-to-grid">
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
            ?>
                <li class="has-dropdown">
                  <a href="#">Mon Compte</a>
                  <ul class="dropdown">
                    <?php echo "<li>".$this->Html->link('Modifier le profil', array('controller' => 'Membres','action'=>'modifier'))."</li>";
                          echo "<li>".$this->Html->link('Noter des films', array('controller' => 'Membres','action'=>''))."</li>";
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
                    <?php echo "<li>".$this->Html->link('Ajout de film', array('controller' => 'Membres','action'=>''))."</li>";
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
                echo "<li>".$this->Html->link('Recherche avancée', array('controller' => 'films','action'=>'recherche'))."</li>";
          ?>
        </ul>
      </li>
      <li>
          <?php
            echo $this->Html->link('Consulter le classement', array(
              'controller' => 'films',
              'action'=>'classement'));
          ?>
        </li>
        <!--li class="has-form">
          <div class="row collapse">
            <div class="large-8 columns">
              <input type="text" placeholder="Find Stuff">
            </div>
            <div class="large-4 columns">
              <a href="#" class="alert button expand">Search</a>
            </div>
          </div>
        </li-->
      </ul>
    </section>
  </nav>
</div>
