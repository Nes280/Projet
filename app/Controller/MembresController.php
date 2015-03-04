<?php 

    /*App::uses('AppController', 'Controller');
    App::uses('Rating','Lib');*/

	class MembresController extends AppController {
       // public $helpers = array('Html', 'Form');

        //public $components = array('Session'); //servira pour la suite


        public function enregistrer() {
            if($this->request->is('post'))
            {
                //debug($this->request->data);
                $d = $this->request->data;
                $d['Membre']['id'] = null;
                if(!empty($d['Membre']['mdp']))
                {
                    $d['Membre']['mdp'] = Security::hash($d['Membre']['mdp'],null,true);
                }
                //debug($d);
               /*$this->Membre->save($d, true, array('nom','prenom','username','mdp','age','administrateur'));
                debug($this->Membre->validationErrors); //show validationErrors
                debug($this->Membre->getDataSource()->getLog(false, false));*/
                if($this->Membre->save($d, true, array('nom','prenom','username','mdp','age','administrateur')))
                {
                    $this->Session->setFlash("Votre compte a bien été créé", "notif");
                }
                else
                {
                    $this->Session->setFlash("Merci de corriger vos erreurs", "notif");
                }
            }
        }

        function login()
        {
            if($this->request->is('post'))
            {

                $this->request->data['Membre']['mdp'] = Security::hash($this->request->data['Membre']['mdp'], null,true);
                debug($this->request->data);

               if($this->Auth->login())
                {
                    $this->Session->setFlash("Vous êtes maintenant connecté", "notif");
                    $this->redirect('/');
                }
                else
                {
                    $this->Session->setFlash("Identifiants incorrects", "notif");
                    //debug();


                }
            }


        }


        function logout()
        {
            $this->Auth->logout();
            $this->redirect($this->referer());
        }

    
}

