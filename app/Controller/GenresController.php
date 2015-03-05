<?php 
	class GenresController extends AppController {
    public $helpers = array('Html', 'Form');

    public function index() {
        $this->set('genres', $this->Genre->find('all'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid genre'));
        }

        $genre = $this->Genre->findById($id);
        if (!$genre) {
            throw new NotFoundException(__('Invalid genre'));
        }
        $this->set('genre', $genre);
        $lesFilms = $this->Genre->Film->find('all',array(
            'fields'=>array('nom','id','genre_id'),
            'conditions'=>array('genre_id'=>$genre['Genre']['id'])));
        $this->set('filmsGenre',$lesFilms);
    }
}

?>