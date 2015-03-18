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

        //$uses=array('Genre','Film','Films_Genre');

        $lesFilms = $this->Genre->query("
            SELECT films.id, films.nom
            FROM films, genres, films_genres
            WHERE films_genres.film_id=films.id
            AND films_genres.genre_id=genres.id
            AND genres.id = 2"
            );
        $this->set('filmsGenre',$lesFilms);
    }
}

?>