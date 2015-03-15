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
                $valeur = $this->request->data;
                $valeur['Membre']['administrateur'] = $d['Membre']['administrateur'];
                $valeur['Membre']['mdp'] = Security::hash($valeur['Membre']['mdp'], null,true);
                //print_r($valeur);

                if(!empty($d))
                { 
                    if($d['Membre']['mdp'] == $valeur['Membre']['mdp'])
                    {
                        if($this->Auth->login($valeur))
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

