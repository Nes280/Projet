<?php 

    /*App::uses('AppController', 'Controller');
    App::uses('Rating','Lib');*/

	class MembresController extends AppController {
       // public $helpers = array('Html', 'Form');

        //public $components = array('Session'); //servira pour la suite


        public function enregistrer() {
            if($this->request->is('post'))
            {
                debug($this->request->data);
                $d = $this->request->data;
                $d['Membre']['id'] = null;
               /*$this->Membre->save($d, true, array('nom','prenom','username','mdp','age','administrateur'));
                debug($this->Membre->validationErrors); //show validationErrors
                debug($this->Membre->getDataSource()->getLog(false, false));*/
                if($this->Membre->save($d, true, array('nom','prenom','username','mdp','age','administrateur')))
                {
                    die("success");
                }
                else
                {
                    die("error");
                }
                

            }
        }

    
}

