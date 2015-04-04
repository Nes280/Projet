<?php 

	class MembresController extends AppController {

        public function enregistrer() {
            if($this->request->is('post'))
            {
                $d = $this->request->data;
                $d['Membre']['id'] = null;
                if(!empty($d['Membre']['mdp']))
                {
                    $d['Membre']['mdp'] = Security::hash($d['Membre']['mdp'],null,true);
                }
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
                $valeur = $this->request->data;
                $valeur['Membre']['administrateur'] = $d['Membre']['administrateur'];
                $valeur['Membre']['mdp'] = Security::hash($valeur['Membre']['mdp'], null,true);

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
            $this->redirect('/films');
        }


        public function modifier()
        {
            $val = AuthComponent::user('Membre');
            $membre = $this->Membre->findByUsername($val['username']);
            $this->set('membre', $membre);
            if($this->request->is('post'))
            {
                $this->Membre->updateAll(
                        array('nom' => "'{$this->request->data['Membre']['nom']}'" ,
                                'prenom' => "'{$this->request->data['Membre']['prenom']}'",
                                'age' => $this->request->data['Membre']['age'],
                                'administrateur' => $this->request->data['Membre']['administrateur']
                         ),
                        array('username' => $membre['Membre']['username'] )
                );
                if($val['administrateur'] != $this->request->data['Membre']['administrateur'])
                {
                    $d['Membre']['username'] = $val['username'];
                    $d['Membre']['mdp'] = $val['mdp'];
                    $d['Membre']['administrateur'] = $this->request->data['Membre']['administrateur'];
                    if($this->Auth->login($d))
                    {
                        $this->Session->setFlash("Vous avez modifier vos informations", "notif");
                        $this->redirect('/films');
                    }
                }
                else
                {
                    $this->Session->setFlash("Vous avez modifier vos informations", "notif");
                    $this->redirect('/films');
                }
            }
        }


        public function modifiermdp()
        {
            $val = AuthComponent::user('Membre');
            $membre = $this->Membre->findByUsername($val['username']);
            $this->set('membre', $membre);
            if($this->request->is('post'))
            {
                $d=$this->request->data;
                $d['Membre']['ancien_mdp']= Security::hash($d['Membre']['ancien_mdp'], null,true);
                $d['Membre']['mdp']= Security::hash($d['Membre']['mdp'], null,true);
                if($membre['Membre']['mdp'] == $d['Membre']['ancien_mdp'])
                {
                    $this->Membre->updateAll(
                        array('mdp' => "'{$d['Membre']['mdp']}'"),
                        array('username' => $membre['Membre']['username'] )
                    );
                }
                else
                {
                     $this->Session->setFlash("Ancien mot de passe incorrect", "notif");
                }
                  
                $valeur['Membre']['username'] = $val['username'];
                $valeur['Membre']['mdp'] = $d['Membre']['mdp'];
                $valeur['Membre']['administrateur'] =$val['administrateur'] ;
                if($this->Auth->login($valeur))
                {
                    $this->Session->setFlash("Vous avez modifier votre mot de passe", "notif");
                    $this->redirect('/films');
                }
                
            }
        }

    }
?>

