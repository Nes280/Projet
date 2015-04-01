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
        }

?>