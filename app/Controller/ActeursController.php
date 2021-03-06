<?php
	class ActeursController extends AppController {
	    public $helpers = array('Html', 'Form');

	    public function view($id = null) {
	        if (!$id) {
	            throw new NotFoundException(__('Acteur non trouvé'));
	        }

	        $acteur = $this->Acteur->findById($id);
	        if (!$acteur) {
	            throw new NotFoundException(__('Acteur non trouvé'));
	        }
	        $this->set('acteur', $acteur);

	        $options['joins']=array(
             array(
                'table' => 'acteurs'),
            array(
                'table' => 'acteurs_films',
                'alias' => 'AF',
                'conditions' => array('AF.acteur_id = acteurs.id')
                ),
            array(
                'table' => 'films',
                'conditions' => array('AF.film_id = Film.id')
                )
            );
        $options['conditions'] = array(
            'acteurs.id' => $id
            );
        $options['fields'] = array(
            'DISTINCT Film.id', 'Film.nom'
            );

        $lesFilms = $this->Acteur->Film->find('all',$options);

        $this->set('filmsActeur',$lesFilms);
	    }


        public function ajoutacteur($id=null){
            if (!$id) {
                throw new NotFoundException(__('Film non trouvé'));
            }
            $idfilm = $id;
            $film = $this->Acteur->Film->findById($idfilm);
            $this->set('film', $film);
            $this->set('acteurs', $this->Acteur->find('all'));
            $d = $this->request->data;

            if($this->request->is('post'))
            {
                $d['Acteur']['id'] = null;
                $valeur = 0;
                $resultat = $this->Acteur->query("SELECT id FROM acteurs WHERE nom='{$d['Acteur']['nom']}' AND prenom='{$d['Acteur']['prenom']}';");
                debug($resultat);

                if(empty($resultat))
                {
                    if($this->Acteur->save($d, true, array('nom','prenom','biographie')))
                    {
                        $valeur = 1;

                    }
                    else
                    {
                        $this->Session->setFlash("Merci de corriger vos erreurs", "notif");
                    }
                }
                else
                {
                    $valeur =1;
                }

                if($valeur == 1)
                {
                    $res = $this->Acteur->query("SELECT * FROM acteurs WHERE nom='{$d['Acteur']['nom']}' AND prenom='{$d['Acteur']['prenom']}';");
                    $val['film_id']=$idfilm;
                    $val['acteur_id'] = $res['0']['acteurs']['id'];
                    $this->loadModel('ActeursFilms');
                    $this->ActeursFilms->create();
                    if($this->ActeursFilms->save($val, true, array('film_id', 'acteur_id')))
                    {
                        $this->redirect(array('controller' => 'Acteurs', 'action' => 'ajoutacteur', $id));
                    }
                    else
                    {
                        $this->Session->setFlash("Merci de corriger vos erreurs", "notif");

                    }
                }
            }
        }
   	}
?>