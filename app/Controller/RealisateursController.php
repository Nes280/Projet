<?php
	class RealisateursController extends AppController {
	    public $helpers = array('Html', 'Form');

        public function ajoutrealisateur($id=null){
            if (!$id) {
                throw new NotFoundException(__('Film non trouvé'));
            }
            $idfilm = $id;
            $film = $this->Realisateur->Film->findById($idfilm);
            $this->set('film', $film);
            $d = $this->request->data;

            if($this->request->is('post'))
            {

                $d['Realisateur']['id'] = null;
                debug($d);
                $valeur = 0;
                $resultat = $this->Realisateur->query("SELECT id FROM realisateurs WHERE nom='{$d['Realisateur']['nom']}' AND prenom='{$d['Realisateur']['prenom']}';");

                if(empty($resultat))
                {
                    if($this->Realisateur->save($d, true, array('nom','prenom')))
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
                    $res = $this->Realisateur->query("SELECT id FROM realisateurs WHERE nom='{$d['Realisateur']['nom']}' AND prenom='{$d['Realisateur']['prenom']}';");
                    debug($res);
                    $val['film_id']=$idfilm;
                    $val['realisateur_id'] = $res['0']['realisateurs']['id'];
                    debug($val);
                    $this->loadModel('FilmsRealisateurs');
                    $this->FilmsRealisateurs->create();
                    if($this->FilmsRealisateurs->save($val, true, array('film_id', 'realisateur_id')))
                    {
                        $this->redirect(array('controller' => 'Realisateurs', 'action' => 'ajoutrealisateur', $id));
                    }
                    else
                    {
                        $this->Session->setFlash("Merci de corriger vos erreurs", "notif");

                    }
                }
            }
        }

        public function view($id = null) {
            if (!$id) {
                throw new NotFoundException(__('Realisateur non trouvé'));
            }

            $realisateur = $this->Realisateur->findById($id);
            if (!$realisateur) {
                throw new NotFoundException(__('Realisateur non trouvé'));
            }
            $this->set('realisateur', $realisateur);

            $options['joins']=array(
             array(
                'table' => 'realisateurs'),
            array(
                'table' => 'films_realisateurs',
                'alias' => 'FR',
                'conditions' => array('FR.realisateur_id = realisateurs.id')
                ),
            array(
                'table' => 'films',
                'conditions' => array('FR.film_id = Film.id')
                )
            );
        $options['conditions'] = array(
            'realisateurs.id' => $id
            );
        $options['fields'] = array(
            'DISTINCT Film.id', 'Film.nom'
            );

        $lesFilms = $this->Realisateur->Film->find('all',$options);

        $this->set('filmsReal',$lesFilms);
        }
   	}
?>