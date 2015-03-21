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

            $d['membre_id']=$membre['Membre']['id'];
            $d['groupe_id']=$groupe['Groupe']['id'];

            $this->loadModel('MembresGroupes');
            $this->MembresGroupes->create();
            /*faire des modifications */
            
            if($this->MembresGroupes->save($d, true, array('membre_id','groupe_id')))
            {
                $this->Session->setFlash("Vous avez rejoint le groupe", "notif");
            }
            else
            {
                $this->Session->setFlash("Merci de corriger vos erreurs", "notif");
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
