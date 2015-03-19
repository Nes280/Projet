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
            //$this->redirect($this->referer());
            $this->redirect('/films');

        }


        public function modifier()
        {

            $val = AuthComponent::user('Membre');
            $membre = $this->Membre->findByUsername($val['username']);
            $this->set('membre', $membre);
            if($this->request->is('post'))
            {
                //debug($this->request->data);
                $this->Membre->updateAll(
                        array('nom' => "'{$this->request->data['Membre']['nom']}'" ,
                                'prenom' => "'{$this->request->data['Membre']['prenom']}'",
                                'age' => $this->request->data['Membre']['age'],
                                'administrateur' => $this->request->data['Membre']['administrateur']
                         ),
                        array('username' => $membre['Membre']['username'] )
                );
                /*if($val['administrateur'] != $this->request->data['Membre']['administrateur'])
                {
                    probleme si on modifie l'administration, dans le tableau AuthComponent::user('Membre') ca ne va pas changer donc on aura toujours l'onglet d'administration
                }*/
            }
        }

        public function modifiermdp()
        {
            $val = AuthComponent::user('Membre');
            $membre = $this->Membre->findByUsername($val['username']);
            $this->set('membre', $membre);
            if($this->request->is('post'))
            {
                //debug($this->request->data);
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
                
                /*if($val['administrateur'] != $this->request->data['Membre']['administrateur'])
                {
                    probleme si on modifie le mot de passe, dans le tableau AuthComponent::user('Membre') ca ne va pas changer
                }*/
            }
        }

        /*public function rejoindregroupe()
        {

        }*/

    }
?>

