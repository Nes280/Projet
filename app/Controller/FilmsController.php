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
            'DISTINCT Acteur.id', 'Acteur.nom, Acteur.prenom'
            );

        $optionsNote['conditions'] = array(
            'Note.film_id' => $id
            );
        $optionsDist['join'] = array(
            array(  'table'=>'films',
                    'conditions' => array('films.distributeur_id = Distributeur.id')
                )
            );

        $lesActeurs = $this->Film->Acteur->find('all',$options);
        $note = $this->Film->Note->find('all',$optionsNote);
        $dist = $this->Film->Distributeur->find('all',$optionsDist);

        $this->set('acteursFilm',$lesActeurs);
        $this->set('note',$note);
        $this->set('dist',$dist);
    }

    public function classement(){
        $this->set('films', $this->Film->find('all',
            array(
                'order'=> 'note DESC',
                'limit'=> '2'
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
                $this->redirect(array('controller' => 'Acteurs', 'action' => 'ajoutacteurs', $film['Film']['id']));

            }
            else
            {
                $this->Session->setFlash("Merci de corriger vos erreurs", "notif");
            }
        }



    }


}

?>