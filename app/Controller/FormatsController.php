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
}

?>