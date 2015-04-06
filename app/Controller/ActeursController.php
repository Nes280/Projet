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
                'alias' => 'F',
                'conditions' => array('AF.film_id = F.id')
                )
            );
        $options['conditions'] = array(
            'acteurs.id' => $id
            );
        $options['fields'] = array(
            'DISTINCT F.id', 'F.nom'
            );

        $lesFilms = $this->Acteur->Film->find('all',$options);

        $this->set('filmsActeur',$lesFilms);
	    }
   	}
?>