<?php 

	class MembresController extends AppController {

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

        public function login()
        {
            if($this->request->is('post'))
            {

                $d = $this->Membre->findByUsername($this->request->data['Membre']['username']);
                //print_r($d);

                if(!empty($d))
                { 
                    if($d['Membre']['mdp'] == Security::hash($this->request->data['Membre']['mdp'], null,true))
                    {
                        if($this->Auth->login($this->request->data))
                        {
                            $this->Session->setFlash("Vous êtes maintenant connecté", "notif");
                            $this->redirect('/films');
                        }
                    }
                    else 
                    {
                        $this->Session->setFlash("Mot de passe incorrect", "notif");

                    }


                }
                else
                {
                    $this->Session->setFlash("Identifiants incorrects", "notif");
                }
     
            }


        }


        public function logout()
        {
            $this->Auth->logout();
            $this->redirect($this->referer());
        }

    
}

