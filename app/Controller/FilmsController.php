<?php 
	class FilmsController extends AppController {
    public $helpers = array('Html', 'Form');

    public function index() {
        $this->set('films', $this->Film->find('all'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid films'));
        }

        $film = $this->Film->findById($id);
        if (!$film) {
            throw new NotFoundException(__('Invalid films'));
        }
        $this->set('film', $film);

        $options['joins']=array(
             array(
                'table' => 'films'),
            array(
                'table' => 'acteurs_films',
                'alias' => 'AF',
                'conditions' => array('AF.acteur_id = Acteur.id')
                ),
            array(
                'table' => 'films',
                'alias' => 'F',
                'conditions' => array('AF.film_id = F.id')
                )
            );
        $options['conditions'] = array(
            'F.id' => $id
            );
        $options['fields'] = array(
            'DISTINCT Acteur.id', 'Acteur.nom, Acteur.prenom, Acteur.biographie'
            );

        $optionsNote['conditions'] = array(
            'Note.film_id' => $id
            );
        $optionsDist['joins']=array(
             array(
                'table' => 'films'),
            array(
                'table' => 'films_distributeurs',
                'alias' => 'FD',
                'conditions' => array('FD.distributeur_id = Distributeur.id')
                ),
            array(
                'table' => 'films',
                'alias' => 'F',
                'conditions' => array('FD.film_id = F.id')
                )
            );
        $optionsDist['conditions'] = array(
            'F.id' => $id
            );
        $optionsDist['fields'] = array(
            'DISTINCT Distributeur.id', 'Distributeur.nom'
            );
         $optionsReal['joins'] = array(
           array(
                'table' => 'films'),
            array(
                'table' => 'films_realisateurs',
                'alias' => 'FR',
                'conditions' => array('FR.realisateur_id = Realisateur.id')
                ),
            array(
                'table' => 'films',
                'alias' => 'F',
                'conditions' => array('FR.film_id = F.id')
                )
            );
         $optionsReal['conditions'] = array(
            'F.id' => $id
            );
         $optionsReal['fields'] = array(
            'DISTINCT Realisateur.id', 'Realisateur.nom, Realisateur.prenom, Realisateur.biographie'
            );
         $optionsPays['joins'] = array(
           array(
                'table' => 'films'),
            array(
                'table' => 'films_pays',
                'alias' => 'FP',
                'conditions' => array('FP.pays_id = Pays.id')
                ),
            array(
                'table' => 'films',
                'alias' => 'F',
                'conditions' => array('FP.film_id = F.id')
                )
            );
         $optionsPays['conditions'] = array(
            'F.id' => $id
            );
         $optionsPays['fields'] = array(
            'DISTINCT Pays.id', 'Pays.pays'
            );

        $lesActeurs = $this->Film->Acteur->find('all',$options);
        $note = $this->Film->Note->find('all',$optionsNote);
        $dist = $this->Film->Distributeur->find('all',$optionsDist);
        $real = $this->Film->Realisateur->find('all',$optionsReal);
        $pays = $this->Film->Pays->find('all',$optionsPays);

        $this->set('acteursFilm',$lesActeurs);
        $this->set('note',$note);
        $this->set('dist',$dist); //distributeur
        $this->set('real',$real); //realisateur
        $this->set('pays',$pays);
    }

    public function classement(){
        $this->set('films', $this->Film->find('all',
            array(
                'order'=> 'note DESC',
                'limit'=> '5'
                )));
    }

    public function ajoutfilm(){
        if($this->request->is('post'))
        {
            $d = $this->request->data;
            $d['Film']['id'] = null;
            
            if($this->Film->save($d, true, array('nom','synopsis','budget','duree','date','nbSaisons', 'nbEpisodes', 'site')))
            {
                $this->Session->setFlash("Votre film a bien été créé", "notif");
                $film = $this->Film->findByNom($d['Film']['nom']);
                $this->redirect(array('controller' => 'Acteurs', 'action' => 'ajoutacteur', $film['Film']['id']));

            }
            else
            {
                $this->Session->setFlash("Merci de corriger vos erreurs", "notif");
            }
        }



    }


}

?>