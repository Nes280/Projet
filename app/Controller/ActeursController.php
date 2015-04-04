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
	    }
   	}
?>