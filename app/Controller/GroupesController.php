<?php 

	class GroupesController extends AppController 
	{

        public function index()
        {
            $this->set('groupes', $this->Groupe->find('all'));
        }

        public function view($id = null) {
            if (!$id) {
                throw new NotFoundException(__('Invalid groupe'));
            }

            $groupe = $this->Groupe->findById($id);
            if (!$groupe) {
                throw new NotFoundException(__('Invalid groupe'));
            }
            $this->set('groupe', $groupe);
        }



		public function creer() 
		{
            if($this->request->is('post'))
            {
                //debug($this->request->data);
                $d = $this->request->data;
                $d['Groupe']['id'] = null;
                if($this->Groupe->save($d, true, array('nom','description')))
                {
                    $this->Session->setFlash("Le groupe a bien été créé", "notif");
                }
                else
                {
                    $this->Session->setFlash("Merci de corriger vos erreurs", "notif");
                }
            }
        }


        public function rejoindregroupe($id=null)
        {

            if (!$id) {
                throw new NotFoundException(__('Invalid groupe'));
            }

            $groupe = $this->Groupe->findById($id);
            if (!$groupe) {
                throw new NotFoundException(__('Invalid groupe'));
            }

            $val = AuthComponent::user('Membre');
            $membre = $this->Groupe->Membre->findByUsername($val['username']);

            $this->set('groupe', $groupe);
            $this->set('membre', $membre);

            /*memoriser l'id de l'utilisateur et l'id du groupe*/
            $d['membre_id']=$membre['Membre']['id'];
            $d['groupe_id']=$groupe['Groupe']['id'];

            $this->loadModel('MembresGroupes');
            $this->MembresGroupes->create();

            /*recherche dans la table membres_groupes*/
            /*$options['joins']=array(
            array(
                'table' => 'groupes',
                'alias' => 'G',
                'conditions' => array('MembresGroupes.groupe_id = G.id')
                ),
            array(
                'table' => 'membres',
                'alias' => 'M',
                'conditions' => array('MembresGroupes.membre_id = M.id')
                )
            );
            $options['conditions'] = array(
            'MembresGroupes.membre_id' => $d['membre_id'],
            'MembresGroupes.groupe_id' => $d['groupe_id']
            );
           $options['fields'] = array(
            'MembresGroupes.membre_id', 'MembresGroupes.groupe_id'
            );
            $mg = $this->MembresGroupes->find('all',$options);*/
            $mg = $this->MembresGroupes->query("
                SELECT *
                FROM membres_groupes
                WHERE membre_id = {$d['membre_id']} AND groupe_id = {$d['groupe_id']};"
            );
            debug($mg);
            if(empty($mg))
            {
                if($this->MembresGroupes->save($d, true, array('membre_id','groupe_id')))
                {
                    $this->Session->setFlash("Vous avez rejoint le groupe", "notif");
                }
                else
                {
                    $this->Session->setFlash("Merci de corriger vos erreurs", "notif");
                }
            }
            else
            {
                $this->Session->setFlash("Vous êtes déjà membre", "notif");
            }
            


            /*$options['joins']=array(
             array(
                'table' => 'groupes'),
            array(
                'table' => 'membres_groupes',
                'alias' => 'MG',
                'conditions' => array('MG.groupe_id = groupes.id')
                ),
            array(
                'table' => 'membres',
                'alias' => 'M',
                'conditions' => array('MG.membres_id = M.id')
                )
            );*/
        }

	}

?>
