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
    }

    public function classement(){
        $this->set('films', $this->Film->find('all',
            array(
                'order'=> 'note DESC',
                'limit'=> '2'
                )));
    }
    public function recherche(){             
    }

    public function ajoutfilm(){
        if($this->request->is('post'))
        {
            debug($this->request->data);
            $d = $this->request->data;
            $d['Film']['id'] = null;
            
            if($this->Film->save($d, true, array('nom','synopsis','budget','duree','date','nbSaisons', 'nbEpisodes')))
            {
                $this->Session->setFlash("Votre film a bien été créé", "notif");
            }
            else
            {
                $this->Session->setFlash("Merci de corriger vos erreurs", "notif");
            }
        }
    }


    }

?>