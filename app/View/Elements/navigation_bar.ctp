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
          <li class="active">
            <?php
              if(AuthComponent::user('id'))
              {
                echo $this->Html->link('Mon compte', array('controller' => 'Mashes','action'=>'add'));
                echo $this->Html->link('Deconnexion', array('controller' => 'Membres','action'=>'logout'));

              }
              else
              {
                echo $this->Html->link('Inscription', array('controller' => 'Membres','action'=>'enregistrer'));
                echo $this->Html->link('Connexion ', array('controller' => 'Membres','action'=>'login'));
              }
          ?>
        </li>
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
          <?php
            /*echo $this->Html->link('Genre de films', array(
              'controller' => 'genres',
              'action'=>'index'));*/
          ?>
        </li>
        <li>
          <?php
            echo $this->Html->link('Consulter le classement', array(
              'controller' => 'Mashes',
              'action'=>'facemash_scores'));
          ?>
        </li>
        
      </ul>
    </section>
  </nav>
</div>
