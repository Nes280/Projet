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
                'conditions' => array('FG.film_id = Film.id')
                )
            );
        $options['conditions'] = array(
            'genres.id' => $id
            );
        $options['fields'] = array(
            'DISTINCT Film.id', 'Film.nom'
            );

        $lesFilms = $this->Genre->Film->find('all',$options);

        $this->set('filmsGenre',$lesFilms);
    }


    public function ajoutgenre($id=null){
        if (!$id) {
            throw new NotFoundException(__('Film non trouvé'));
        }
        $idfilm = $id;
        $film = $this->Genre->Film->findById($idfilm);
        $this->set('film', $film);
        $d = $this->request->data;

        if($this->request->is('post'))
        {
            $d['Genre']['id'] = null;
            $valeur = 0;
            $resultat = $this->Genre->query("SELECT id FROM genres WHERE genre='{$d['Genre']['genre']}';");

            if(empty($resultat))
            {
                if($this->Genre->save($d, true, array('genre')))
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
                $res = $this->Genre->query("SELECT * FROM genres WHERE genre='{$d['Genre']['genre']}';");
                $val['film_id']=$idfilm;
                $val['genre_id'] = $res['0']['genres']['id'];
                $this->loadModel('FilmsGenres');
                $this->FilmsGenres->create();
                if($this->FilmsGenres->save($val, true, array('film_id', 'genre_id')))
                {
                    $this->redirect(array('controller' => 'Genres', 'action' => 'ajoutgenre', $id));
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