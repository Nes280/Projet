<?php 
	class FilmsController extends AppController {
    public $helpers = array('Html', 'Form');

    public function index() {
        $this->set('lesFilms', $this->Film->find('all'));
        
        $options['joins']=array(
             array(
                'table' => 'notes'),
            array(
                'table' => 'films',
                'alias' => 'F',
                'conditions' => array('notes.film_id = F.id')
                )
            );
        /*$options['conditions'] = array(
            'F.id' => $id

            );*/
        $options['fields'] = array(
            'DISTINCT notes.id','F.nom, F.id, notes.note, notes.film_id'
            );
        $top = $this->Film->Note->find('all',$options);
        $tableau=array();
        $tri = array();
        foreach ($top as $t) { //construction du tableau avec les films
            if(empty($tableau[$t['F']['nom']])){
                $tableau+=array($t['F']['nom']=>array(
                    'note'=>array(),
                    'volume'=>0,
                    'film_id'=>array(),
                    'nom'=>array()));
                $tri+=array($t['F']['nom']=>array(
                    'note'=>array(),
                    'volume'=>0,
                    'film_id'=>array(),
                    'nom'=>array()));
            }
           
        }
        foreach ($top as $t) { //remplissage
            //debug($t);
            if(empty($tableau[$t['F']['nom']]['note']))
            {
                $tableau[$t['F']['nom']]['note']=$t['notes']['note'];
                $tableau[$t['F']['nom']]['film_id']=$t['notes']['film_id'];
                $tableau[$t['F']['nom']]['nom']=$t['F']['nom'];
                $tableau[$t['F']['nom']]['volume']++;   
            }
            else 
            {
                $tableau[$t['F']['nom']]['note']=''.$tableau[$t['F']['nom']]['note']+$t['notes']['note'].'';
                $tableau[$t['F']['nom']]['volume']++;
            }
        
        }
        
        array_multisort($tableau,SORT_DESC);
         //debug($tableau);
        $this->set('films',$tableau);      
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
        $nom = AuthComponent::user('Membre');
        $nom = $nom['username'];
/***************OPTION********************/

//ACTEUR
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
//NOTE
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
//DISTRIBUTEUR
        $optionsDist['conditions'] = array(
            'F.id' => $id
            );
        $optionsDist['fields'] = array(
            'DISTINCT Distributeur.id', 'Distributeur.nom'
            );
//REALISATEUR
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
//PAYS
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
//MEMBRE ID NOTE
         $optionsNoteId['joins'] = array(
            array(
                'table' => 'notes',
                'alias' => 'Notes'),
            array(
                'table' => 'membres',
                'alias' => 'M',
                'conditions' => array('M.username' => $nom)
            ),
        );
        $optionsNoteId['fields'] = array(
            'DISTINCT M.id'
        );
/**********FIN OPTION**********/
        $lesActeurs = $this->Film->Acteur->find('all',$options);
        $note = $this->Film->Note->find('all',$optionsNote);
        $dist = $this->Film->Distributeur->find('all',$optionsDist);
        $real = $this->Film->Realisateur->find('all',$optionsReal);
        $pays = $this->Film->Pays->find('all',$optionsPays);
        $nomId = $this->Film->Note->find('all',$optionsNoteId);

        $this->set('acteursFilm',$lesActeurs);
        $this->set('note',$note);
        $this->set('dist',$dist); //distributeur
        $this->set('real',$real); //realisateur
        $this->set('pays',$pays);
        $this->set('membreId',$nomId);

        //debug($nomId[0]['M']['id']);
        $dejaVote=false;
        if (AuthComponent::user('Membre')) {   
            foreach ($note as  $n) {
                if($n['Note']['membre_id']==$nomId[0]['M']['id'])
                {
                    $dejaVote = true;
                    $laNote = $n['Note']['note'];
                }
                //echo $dejaVote;
            }
        }
        if ($dejaVote) {
            $this->set('dejaVote', $dejaVote);
            $this->set('laNote', $laNote);
        }
        else $this->set('dejaVote', $dejaVote);
        
        if($this->request->is('post'))
        {
            if ($dejaVote===false) {
               
                $d = $this->request->data;
                $d['Note']['film_id']=$id;
                $d['Note']['membre_id']=$nomId[0]['M']['id'];
                $d['Note']['date'] = date('Y-m-j');

                //debug($d);
                $succes = "<div data-alert class='alert-box success radius'>
                                Merci pour votre vote $nom !
                                <a href='#'' class='close'>&times;</a>
                            </div>";
                if($this->Film->Note->save($d, true, array('note','film_id', 'membre_id', 'date')))
                {
                    $this->Session->setFlash($succes, "notif");
                    $this->redirect("/films/view/$id");

                }
                else
                {
                    $this->Session->setFlash("Merci de corriger vos erreurs", "notif");
                }
            }
            else
            {
                $attention = "<div data-alert class='alert-box warning radius'>
                                $nom, vous avez déjà voté!
                                <a href='#'' class='close'>&times;</a>
                            </div>";
                $this->Session->setFlash("$attention", "notif");
            }
        }
    }

    public function classement(){
         $options['joins']=array(
             array(
                'table' => 'notes'),
            array(
                'table' => 'films',
                'alias' => 'F',
                'conditions' => array('notes.film_id = F.id')
                )
            );
        /*$options['conditions'] = array(
            'F.id' => $id

            );*/
        $options['fields'] = array(
            'DISTINCT notes.id','F.nom, F.id, notes.note, notes.film_id'
            );
        $top = $this->Film->Note->find('all',$options);
        $tableau=array();
        $tri = array();
        foreach ($top as $t) { //construction du tableau avec les films
            if(empty($tableau[$t['F']['nom']])){
                $tableau+=array($t['F']['nom']=>array(
                    'note'=>array(),
                    'volume'=>0,
                    'film_id'=>array(),
                    'nom'=>array()));
                $tri+=array($t['F']['nom']=>array(
                    'note'=>array(),
                    'volume'=>0,
                    'film_id'=>array(),
                    'nom'=>array()));
            }
           
        }
        foreach ($top as $t) { //remplissage
            //debug($t);
            if(empty($tableau[$t['F']['nom']]['note']))
            {
                $tableau[$t['F']['nom']]['note']=$t['notes']['note'];
                $tableau[$t['F']['nom']]['film_id']=$t['notes']['film_id'];
                $tableau[$t['F']['nom']]['nom']=$t['F']['nom'];
                $tableau[$t['F']['nom']]['volume']++;   
            }
            else 
            {
                $tableau[$t['F']['nom']]['note']=''.$tableau[$t['F']['nom']]['note']+$t['notes']['note'].'';
                $tableau[$t['F']['nom']]['volume']++;
            }
        
        }
        
        array_multisort($tableau,SORT_DESC);
         //debug($tableau);
        $this->set('films',$tableau);
           /* array(
                'order'=> 'note DESC',
                'limit'=> '5'
                )));*/
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