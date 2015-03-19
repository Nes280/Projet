<?php 

	class GroupesController extends AppController 
	{

        public function index()
        {
            $this->set('groupe', $this->Groupe->find('all'));
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

	}

?>
