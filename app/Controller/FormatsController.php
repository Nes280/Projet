<?php 
	class FormatsController extends AppController {
    public $helpers = array('Html', 'Form');

    public function index() {
        $this->set('formats', $this->Format->find('all'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid formats'));
        }

        $format = $this->Format->findById($id);
        if (!$format) {
            throw new NotFoundException(__('Invalid formats'));
        }
        $this->set('format', $format);
        /*
        $lesFilms = $this->Format->Film->find('all',array(
            'fields'=>array('nom','id','format_id'),
            'conditions'=>array('format_id'=>$format['Format']['id'])));
        $this->set('filmsFormat',$lesFilms);*/

        $options['joins']=array(
             array(
                'table' => 'formats'),
            array(
                'table' => 'films_formats',
                'alias' => 'FF',
                'conditions' => array('FF.format_id = formats.id')
                ),
            array(
                'table' => 'films',
                'conditions' => array('FF.film_id = Film.id')
                )
            );
        $options['conditions'] = array(
            'formats.id' => $id
            );
        $options['fields'] = array(
            'DISTINCT Film.id', 'Film.nom'
            );

        $lesFilms = $this->Format->Film->find('all',$options);

        $this->set('filmsFormat',$lesFilms);

    }


        public function ajoutformat($id=null){
        if (!$id) {
            throw new NotFoundException(__('Film non trouvé'));
        }
        $idfilm = $id;
        $film = $this->Format->Film->findById($idfilm);
        $this->set('film', $film);
        $d = $this->request->data;

        if($this->request->is('post'))
        {
            $d['Format']['id'] = null;
            $valeur = 0;
            $resultat = $this->Format->query("SELECT id FROM formats WHERE format='{$d['Format']['format']}';");

            if(empty($resultat))
            {
                if($this->Format->save($d, true, array('format')))
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
                $res = $this->Format->query("SELECT * FROM formats WHERE format='{$d['Format']['format']}';");
                $val['film_id']=$idfilm;
                $val['format_id'] = $res['0']['formats']['id'];
                $this->loadModel('FilmsFormats');
                $this->FilmsFormats->create();
                if($this->FilmsFormats->save($val, true, array('film_id', 'format_id')))
                {
                    $this->redirect(array('controller' => 'Formats', 'action' => 'ajoutformat', $id));
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