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

        /*$lesFilms = $this->Genre->query('
            SELECT films.id, films.nom
            FROM films, genres, films_genres
            WHERE films_genres.film_id=films.id
            AND films_genres.genre_id=genres.id
            AND genres.id = $Genre["Genre"]["id"]'
            );*/

       $options['joins']=array(
             array(
                'table' => 'genres'),
            array(
                'table' => 'films_genres',
                'alias' => 'FG',
                'conditions' => array('FG.genre_id = genres.id')
                ),
            array(
                'table' => 'films',
                'alias' => 'F',
                'conditions' => array('FG.film_id = F.id')
                )
            );
        $options['conditions'] = array(
            'genres.id' => $id
            );
        $options['fields'] = array(
            'DISTINCT F.id', 'F.nom'
            );

        $lesFilms = $this->Genre->Film->find('all',$options);

        $this->set('filmsGenre',$lesFilms);
    }
}

?>